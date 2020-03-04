<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<div class="account-info">
	<? if (!$compositeStub && $arParams['SHOW_AUTHOR'] == 'Y') : ?>
		<div class="login">
			<? if ($USER->IsAuthorized()) :
				$name = trim($USER->GetFullName());
				if (!$name)
					$name = trim($USER->GetLogin());
				if (strlen($name) > 15)
					$name = substr($name, 0, 12) . '...';
			?>
				<a href="<?= $arParams['PATH_TO_PROFILE'] ?>"><?= htmlspecialcharsbx($name) ?></a>
				&nbsp;
				<a href="?logout=yes"><?= GetMessage('TSB1_LOGOUT') ?></a>
				<? else :
				$arParamsToDelete = array(
					"login",
					"login_form",
					"logout",
					"register",
					"forgot_password",
					"change_password",
					"confirm_registration",
					"confirm_code",
					"confirm_user_id",
					"logout_butt",
					"auth_service_id",
					"clear_cache",
					"backurl",
				);

				$currentUrl = urlencode($APPLICATION->GetCurPageParam("", $arParamsToDelete));
				if ($arParams['AJAX'] == 'N') {
				?>
					<script type="text/javascript">
						<?= $cartId ?>.currentUrl = '<?= $currentUrl ?>';
					</script>
				<?
				} else {
					$currentUrl = '#CURRENT_URL#';
				}

				$pathToAuthorize = $arParams['PATH_TO_AUTHORIZE'];
				$pathToAuthorize .= (stripos($pathToAuthorize, '?') === false ? '?' : '&');
				$pathToAuthorize .= 'login=yes&backurl=' . $currentUrl;
				?>
				
				<?
				if ($arParams['SHOW_REGISTRATION'] === 'Y') {
					$pathToRegister = $arParams['PATH_TO_REGISTER'];
					$pathToRegister .= (stripos($pathToRegister, '?') === false ? '?' : '&');
					$pathToRegister .= 'register=yes&backurl=' . $currentUrl;
				?>
					<a href="<?= $pathToRegister ?>">
						<?= GetMessage('TSB1_REGISTER') ?>
					</a>
				<?
				}
				?>
				<a href="<?= $pathToAuthorize ?>">
					<?= GetMessage('TSB1_LOGIN') ?>
				</a>
			<? endif ?>
		</div>
	<? endif ?>
	<div class="bag">
	<? if ($arParams['SHOW_PERSONAL_LINK'] == 'Y') : ?>
		<a class="personal" href="<?= $arParams['PATH_TO_PERSONAL'] ?>">
	<? endif ?>
		<?
		if (!$arResult["DISABLE_USE_BASKET"]) {
		?>
			<?= GetMessage('TSB1_CART') ?>
			<?
		}

		if (!$compositeStub) {
			if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y')) {
				echo $arResult['NUM_PRODUCTS'] . ' ' . $arResult['PRODUCT(S)'];

				if ($arParams['SHOW_TOTAL_PRICE'] == 'Y') {
			?>
					<br />
					<?= GetMessage('TSB1_TOTAL_PRICE') ?> <?= $arResult['TOTAL_PRICE'] ?>
			<?
				}
			}
		}
		?>
		
		<? if ($arParams['SHOW_PERSONAL_LINK'] == 'Y') : ?>
			</a>
		<? endif ?>
	</div>
</div>
