<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult["ITEMS"])) {
  foreach ($arResult["ITEMS"] as &$item) {
    if (!empty($item["PREVIEW_PICTURE"])) {
      $imageFileArray = CFile::GetFileArray($item["PREVIEW_PICTURE"]["ID"]);

      $size = array(
        "width" => "155",
        "height" => "238"
      );

      $imageResized = CFile::ResizeImageGet($imageFileArray, $size);

      $item["PREVIEW_PICTURE"]["SRC"] = $imageResized["src"];
      $item["PREVIEW_PICTURE"]["WIDTH"] = $imageResized["width"];
      $item["PREVIEW_PICTURE"]["HEIGHT"] = $imageResized["height"];
      $item["PREVIEW_PICTURE"]["SIZE"] = $imageResized["size"];
    }
  }
  unset($item);
}
?>
