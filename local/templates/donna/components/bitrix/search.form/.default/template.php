<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true); ?>

<form action="<?= $arResult["FORM_ACTION"] ?>">
	<fieldset>
		<div class="search">
			<? if ($arParams["USE_SUGGEST"] === "Y") : ?>
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:search.suggest.input",
					"",
					array(
						"NAME" => "q",
						"VALUE" => "",
						"INPUT_SIZE" => 15,
						"DROPDOWN_SIZE" => 10,
					),
					$component,
					array("HIDE_ICONS" => "Y")
				);
				?>
			<? else : ?>
				<input type="text" name="q" maxlength="50" placeholder="<?= GetMessage("SEARCH_BY_NAME_AND_ARTNUMBER") ?>" value="" />
			<? endif; ?>
			<input type="submit" name="submit" value="" />
		</div>
	</fieldset>
</form>
