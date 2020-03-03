<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true);
?>

<div class="carousel">
	<ul class="slides">
		<? foreach ($arResult["ITEMS"] as $arItem) : ?>
			<li id="<? $this->GetEditAreaId($arItem["ID"]) ?>" style="background-image: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>);"></li>
		<? endforeach; ?>
	</ul>
</div>
