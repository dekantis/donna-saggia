<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
if (intval($arParams["SHOW_COUNT"]) > 0) {
  $arResult["SECTIONS"] = array_slice($arResult["SECTIONS"], 0, $arParams["SHOW_COUNT"]);
  $arResult["SECTIONS_COUNT"] = count($arResult["SECTIONS"]);
}
$size = array(
    "width" => $arParams["RESIZE_IMAGE_WEIGHT"],
    "height" => $arParams["RESIZE_IMAGE_HEIGHT"]
  );
foreach ($arResult["SECTIONS"] as &$section) {
	$imageFileArray["first"] = CFile::GetFileArray($section["PICTURE"]["ID"]);
	$imageResized = CFile::ResizeImageGet($imageFileArray["first"], $size);
	$section["PICTURE"]["SRC"] = $imageResized["src"];
	$imageFileArray["last"] = CFile::GetFileArray($section["DETAIL_PICTURE"]);
	$imageResized = CFile::ResizeImageGet($imageFileArray["last"], $size);
	$section["DETAIL_PICTURE_SRC"] = $imageResized["src"];
}
unset($imageResized, $imageFileArray, $section);
?>
