<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? if ($arResult["NavShowAlways"] || $arResult["NavPageCount"] > 1) : ?>
  <div class="page-navigation">
    <? if ($arResult["bShowAll"]) : ?>
      <a href="<?= $arResult["sUrlPathParams"] ?>SHOWALL_<?= $arResult["NavNum"] ?>=1" class="see-all-nav"><?=GetMessage("SHOW_ALL")?></a>
    <? endif; ?>
    <? if ($arResult["NavPageNomer"] == 1) : ?>
      <a>&lt;</a>
    <? else : ?>
      <a href="<?= $arResult["sUrlPathParams"] ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageNomer"] - 1 ?>">&lt;</a>
    <? endif; ?>

    <? for ($pageNumber = $arResult["nStartPage"]; $pageNumber <= $arResult["nEndPage"]; $pageNumber++) : ?>
      <? if ($arResult["NavPageNomer"] == $pageNumber) : ?>
        <span><?= $pageNumber ?></span>
      <? else : ?>
        <a href="<?= $arResult["sUrlPathParams"] ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $pageNumber ?>"><?= $pageNumber ?></a>
      <? endif; ?>
    <? endfor; ?>

    <? if ($arResult["NavPageNomer"] == $arResult["NavPageCount"]) : ?>
      <a>&gt;</a>
    <? else : ?>
      <a href="<?= $arResult["sUrlPathParams"] ?>PAGEN_<?= $arResult["NavNum"] ?>=<?= $arResult["NavPageNomer"] + 1 ?>">&gt;</a>
    <? endif; ?>
  </div>
<? endif; ?>
