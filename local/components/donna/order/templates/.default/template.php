<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

?>
<? if (!$arResult["BASKET_EMPTY"]) : ?>
<form action="<?= POST_FORM_ACTION_URI ?>" method="POST">
	<div class="contact-form">
		<div class="title-section"><?= Loc::getMessage("TITLE") ?></div>

		<?= bitrix_sessid_post() ?>

		<form action="<?= $arResult["ACTION"] ?>">
			<div class="form-line">
				<label><?= Loc::getMessage("LABEL_NAME") ?></label>
				<fieldset>
					<div class="row"><input type="text" name="name" value="<?= $arResult["USER"]["INFO"]["NAME"] ?>"></div>
				</fieldset>
			</div>

			<div class="form-line">
				<label><?= Loc::getMessage("LABEL_PHONE") ?></label>
				<fieldset>
					<div class="row"><input type="tel" name="phone" value="<?= $arResult["USER"]["INFO"]["PERSONAL_PHONE"] ?>">
						<p><?= Loc::getMessage("LABEL_PHONE_INFO") ?></p>
					</div>
				</fieldset>
			</div>

			<div class="form-line">
				<label><?= Loc::getMessage("LABEL_MAIL") ?></label>
				<fieldset>
					<div class="row"><input type="email" name="email" value="<?= $arResult["USER"]["INFO"]["EMAIL"] ?>">
						<p><?= Loc::getMessage("LABEL_MAIL_INFO") ?></p>
					</div>
				</fieldset>
			</div>

			<div class="form-line">
				<label><?= Loc::getMessage("LABEL_ADDRESS") ?></label>
				<fieldset>
					<div class="row"><textarea name="address"></textarea>
						<p><?= Loc::getMessage("LABEL_ADDRESS_INFO") ?></p>
					</div>
				</fieldset>
			</div>

			<input type="submit" name="confirmorder" value="<?= Loc::getMessage("SUBMIT") ?>">
		</form>
	</div>
</form>
<? endif; ?>
