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
$this->setFrameMode(true);
$first = true;
?>
<? foreach ($arResult["ITEMS"] as $arItem) : ?>
  <?
  $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
  $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
  ?>
  <div class="news-item<? if ($first) echo " first"?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
  <?$first = false;?>
    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])) : ?>
      <div class="news-image">
        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) : ?>
          <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
            <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" />
          </a>
        <? else : ?>
          <img src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>" alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>" title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>" />
        <? endif; ?>
      </div>
    <? endif ?>
    <div class="news-description">
      <? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]) : ?>
        <div class="date"><?= $arItem["DISPLAY_ACTIVE_FROM"] ?></div>
      <? endif ?>
      <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]) : ?>
        <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) : ?>
          <h3><a href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= $arItem["NAME"] ?></a></h3>
        <? else : ?>
          <h3><?= $arItem["NAME"] ?></h3>
        <? endif; ?>
      <? endif; ?>
      <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]) : ?>
        <p><?= $arItem["PREVIEW_TEXT"]; ?></p>
      <? endif; ?>
      <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) : ?>
        <a class="more" href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?= GetMessage("LEARN_MORE") ?></a>
      <? endif; ?>
    </div>
  </div>
<? endforeach; ?>
