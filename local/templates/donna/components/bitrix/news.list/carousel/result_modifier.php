<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult["ITEMS"])) {
	$size = array(
        "width" => $arParams["RESIZE_IMAGE_WEIGHT"],
        "height" => $arParams["RESIZE_IMAGE_HEIGHT"]
      );
  foreach ($arResult["ITEMS"] as &$item) {
    if (!empty($item["PREVIEW_PICTURE"])) {
      $imageFileArray = CFile::GetFileArray($item["PREVIEW_PICTURE"]["ID"]);     

      $imageResized = CFile::ResizeImageGet($imageFileArray, $size);

      $item["PREVIEW_PICTURE"]["SRC"] = $imageResized["src"];
    }
  }
  unset($item, $imageResized, $imageFileArray);
}
