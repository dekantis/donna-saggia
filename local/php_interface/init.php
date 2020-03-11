<?
use \Bitrix\Main\EventManager;
CModule::AddAutoloadClasses(
        '', 
        array(
                'DiscountChecker' => '/local/php_interface/classes/DiscountChecker.php',
                'NewProductChecker' => '/local/php_interface/classes/NewProductChecker.php',
        )
);

EventManager::getInstance()->addEventHandler("sale", "DiscountonAfterAdd", Array("DiscountChecker", "AddDiscountProperty"));
EventManager::getInstance()->addEventHandler("sale", "DiscountonBeforeUpdate", Array("DiscountChecker", "UpdateDiscountProperty"));
EventManager::getInstance()->addEventHandler("sale", "DiscountonDelete", Array("DiscountChecker", "DeleteDiscountProperty"));


?>