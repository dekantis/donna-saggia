<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)) : ?>
  <h3><?=GetMessage("COMPANY")?></h3>
  <? foreach (array_chunk($arResult, $arParams["CHUNK_SIZE"]) as $arChunk) : ?>
    <ul>
      <?
      foreach ($arChunk as $arItem) :
        if ($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1)
          continue;
      ?>
        <li><a href="<?= $arItem["LINK"] ?>"><?= $arItem["TEXT"] ?></a></li>
      <? endforeach ?>
    </ul>
  <? endforeach; ?>
<? endif ?>
