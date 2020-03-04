<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;
use Bitrix\Sale;

if (!Main\Loader::includeModule("sale")) {
  ShowError(Main\Localization\Loc::getMessage("SALE_MODULE_NOT_INSTALLED"));
  return;
}

class BagOrderComponent extends CBitrixComponent
{
  private $user;
  private $order;
  private $isSessionChecked = false;
  private $isOrderConfirmed = false;

  public function initUser()
  {
    global $USER;

    if ($this->isOrderConfirmed && !$USER->IsAuthorized()) {
      $userId = $this->registerUser();
    } else {
      $userId = $USER->GetId();
    }

    if (!$userId) {
      $userId = CSaleUser::GetAnonymousUserID();
    }

    $this->user = array(
      "ACTIVE" => $userId != CSaleUser::GetAnonymousUserID(),
      "ID" => $userId
    );

    if ($this->user["ACTIVE"]) {
      $user = $USER->GetById($this->user["ID"])->Fetch();

      $this->user["INFO"] = $user;
    }
    $this->arResult["USER"] = $this->user;

  }
  public function generateUserFields()
  {
    global $USER;

    $email = $this->request->get("email") ? trim((string) $this->request->get("email")) : "";
    $name = $this->request->get("name") ?: "";

    if (empty($email)) {
      $email = false;
      $login = Main\UserPhoneAuthTable::normalizePhoneNumber($this->request->get("phone")) ?: "";
    } else {
      $login = $email;
    }

    if (empty($login)) {
      $login = randString(5) . mt_rand(0, 99999);
    }

    $pos = strpos($login, "@");
    if ($pos !== false) {
      $login = substr($login, 0, $pos);
    }

    $dbUserLogin = CUser::GetByLogin($login);

    if ($userLoginResult = $dbUserLogin->Fetch()) {
      do {
        $newLoginTmp = $login . mt_rand(0, 99999);
        $dbUserLogin = CUser::GetByLogin($newLoginTmp);
      } while ($userLoginResult = $dbUserLogin->Fetch());

      $login = $newLoginTmp;
    }

    $groupIds = [];
    $defaultGroups = Option::get("main", "new_user_registration_def_group", "");

    if (!empty($defaultGroups)) {
      $groupIds = explode(",", $defaultGroups);
    }

    $policy = $USER->GetGroupPolicy($groupIds);

    $passwordMinLength = (int) $policy["PASSWORD_LENGTH"];
    if ($passwordMinLength <= 0) {
      $passwordMinLength = 6;
    }

    $passwordChars = array(
      "abcdefghijklnmopqrstuvwxyz",
      "ABCDEFGHIJKLNMOPQRSTUVWXYZ",
      "0123456789",
    );
    if ($policy['PASSWORD_PUNCTUATION'] === 'Y') {
      $passwordChars[] = ",.<>/?;:'\"[]{}\|`~!@#\$%^&*()-_+=";
    }

    $password = $passwordConfirm = randString($passwordMinLength + 2, $passwordChars);

    return array(
      "EMAIL" => $email,
      "LOGIN" => $login,
      "NAME" => $name,
      "PASSWORD" => $password,
      "PASSWORD_CONFIRM" => $passwordConfirm,
      "GROUP_ID" => $groupIds
    );
  }
  public function registerUser()
  {
    global $USER;

    $user = new CUser;
    $userId = false;
    $fields = $this->generateUserFields();
    $addResult = $user->Add($fields);

    if (intval($addResult) <= 0) {
      $this->addError(Loc::getMessage("USER_REGISTRATION_ERROR") . ": " . $user->LAST_ERROR);
    } else {
      $userId = intval($addResult);
      $USER->Authorize($addResult);

      if ($USER->IsAuthorized()) {
        CUser::SendUserInfo($USER->GetId(), $this->getSiteId(), Loc::getMessage("USER_REGISTRATION_SUCCESSFUL"), true);
      }
    }

    return $userId;
  }
  public function addError($error)
  {
    $this->arResult["ERRORS"][] = $error;
  }
  public function processOrder()
  {
	\Bitrix\Sale\Compatible\DiscountCompatibility::stopUsageCompatible();
    $this->initUser();

    $this->order = $this->createOrder($this->user["ID"]);

    $isBasketEmpty = !($this->order->getBasket()->count() > 0);
    $isActiveUser = $this->user["ACTIVE"];

    $this->arResult["BASKET_EMPTY"] = $isBasketEmpty;

    if (!$isBasketEmpty && $isActiveUser && $this->isOrderConfirmed && $this->isSessionChecked) {
      $this->setOrderProperties();
      $this->saveOrder();
      if (empty($this->arResult["ERRORS"])) {
        LocalRedirect("/");
      }
    }
  }
  public function saveOrder()
  {	
    $saveResult = $this->order->save();

    if ($saveResult->isSuccess()) {
      $fUserId = Sale\Fuser::getId();
			$siteId = $this->getSiteId();
			Sale\BasketComponentHelper::clearFUserBasketPrice($fUserId, $siteId);
			Sale\BasketComponentHelper::clearFUserBasketQuantity($fUserId, $siteId);
    } else {
      $this->addError($saveResult->getErrors());
    }
  }
  public function createOrder($userId)
  {
    $registry = Sale\Registry::getInstance(Sale\Registry::REGISTRY_TYPE_ORDER);

    $orderClassName = $registry->getOrderClassName();

    $order = $orderClassName::create($this->getSiteId(), $userId);

    $order->isStartField();
	
    $basketStorage = Sale\Basket\Storage::getInstance(Sale\Fuser::getId(), $this->getSiteId());
	
    $basket = $basketStorage->getBasket();	
	$discount = $order->getDiscount();
	$discount->calculate();
	$discountResult  =  $discount->getApplyResult(); 
    $order->setPersonTypeId(1);
    $order->setBasket($basket->getOrderableItems());
	echo "<pre>";
	var_dump($basket);


    return $order;
  }
  public function setOrderProperties()
  {
    $props = $this->order->getPropertyCollection();

    $props->getAddress()->setField("VALUE", $this->request->get("address") ?: "");
    $props->getUserEmail()->setField("VALUE", $this->request->get("email") ?: "");
    $props->getPayerName()->setField("VALUE", $this->request->get("name") ?: "");
    $props->getPhone()->setField("VALUE", $this->request->get("phone") ?: "");

    $props->getDeliveryLocationZip()->setField("VALUE", "");
    $props->getDeliveryLocation()->setField("VALUE", "");

    $cityPropId = 5;
    $props->getItemByOrderPropertyId($cityPropId)->setField("VALUE", "");
  }
  public function onPrepareComponentParams($params)
  {
    return $params;
  }
  public function executeComponent()
  {
    $this->isSessionChecked = check_bitrix_sessid();
    $this->isOrderConfirmed = $this->request->isPost() && $this->request->get("confirmorder");
	
    $this->processOrder();
	
    $this->includeComponentTemplate();
  }
}
