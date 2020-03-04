<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

if (Bitrix\Main\Loader::includeModule("iblock")) {
  $rsProducts = CIBlockElement::GetList(
    array(),
    array(
      "IBLOCK_ID" => $arResult["IBLOCK_ID"],
      "PROPERTY_ARTNUMBER_GROUP" => $arResult["PROPERTIES"]["ARTNUMBER_GROUP"]
    ),
    false,
    false,
    array(
      "ID",
      "CODE",
      "NAME",
      "PREVIEW_PICTURE",
      "DETAIL_PAGE_URL",
    )
  );

  while ($arProduct = $rsProducts->GetNext()) {
    $previewPictureFile = CFile::GetFileArray($arProduct["PREVIEW_PICTURE"]);
    $size = array(
      "width" => "69",
      "height" => "105"
    );
    $previewPictureResized = CFile::ResizeImageGet($previewPictureFile, $size);
    $arProduct["PREVIEW_PICTURE"] = $previewPictureResized;
    $arResult["COLORS"][] = $arProduct;
  }
}

$sizeMini = array(
  "width" => "73",
  "height" => "112"
);
$sizeBig = array(
  "width" => "440",
  "height" => "676"
);

switch ($arResult["PRODUCT"]["TYPE"]) {
  case 1:
    foreach ($arResult["MORE_PHOTO"] as &$photo) {
      $imageFile = CFile::GetFileArray($photo["ID"]);

      $imageMini = CFile::ResizeImageGet($imageFile, $sizeMini);
      $imageBig = CFile::ResizeImageGet($imageFile, $sizeBig);

      $photo["SRC_MINI"] = $imageMini["src"];
      $photo["SRC_BIG"] = $imageBig["src"];
    }
    unset($photo);
    break;
  case 3:
    foreach ($arResult["JS_OFFERS"] as &$offer) {
      foreach ($offer["SLIDER"] as &$photo) {
        $imageFile = CFile::GetFileArray($photo["ID"]);
  
        $imageMini = CFile::ResizeImageGet($imageFile, $sizeMini);
        $imageBig = CFile::ResizeImageGet($imageFile, $sizeBig);
  
        $photo["SRC_MINI"] = $imageMini["src"];
        $photo["SRC_BIG"] = $imageBig["src"];
      }
    }
    unset($photo, $offer);
    break;
}
?>
