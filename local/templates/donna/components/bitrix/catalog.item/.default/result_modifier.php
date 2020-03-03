<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


if (!function_exists("setResizeImage")) {
  function setResizeImage($image, $width, $height)
  {
    $imageFileArray = CFile::GetFileArray($image["ID"]);
	global $arParams;
    $size = array(
      "width" => $width,
      "height" => $height,
    );

    $imageResized = CFile::ResizeImageGet($imageFileArray, $size);

    $image["SRC"] = $imageResized["src"];
    return $image;
  }
}

if (!empty($arResult["ITEM"])) {
  $item = &$arResult["ITEM"];

  if (!empty($item["PREVIEW_PICTURE"])) {
    $item["PREVIEW_PICTURE"] = setResizeImage($item["PREVIEW_PICTURE"], $arParams["RESIZE_IMAGE_WIDTH"], $arParams["RESIZE_IMAGE_HEIGHT"]);
	
  }
  if (!empty($item["PREVIEW_PICTURE_SECOND"])) {
    $item["PREVIEW_PICTURE_SECOND"] = setResizeImage($item["PREVIEW_PICTURE_SECOND"], $arParams["RESIZE_IMAGE_WIDTH"], $arParams["RESIZE_IMAGE_HEIGHT"]);
  }
  if (!empty($item["MORE_PHOTO"])) {
    foreach ($item["MORE_PHOTO"] as &$photo) {
      $photo = setResizeImage($photo, $arParams["RESIZE_IMAGE_WIDTH"], $arParams["RESIZE_IMAGE_HEIGHT"]);
    }
    unset($photo);
  }
  if (!empty($item["JS_OFFERS"])) {
    foreach ($item["JS_OFFERS"] as &$offer) {
      if (!empty($item["PREVIEW_PICTURE"])) {
        $offer["PREVIEW_PICTURE"] = setResizeImage($offer["PREVIEW_PICTURE"], $arParams["RESIZE_IMAGE_WIDTH"], $arParams["RESIZE_IMAGE_HEIGHT"]);
      }
      if (!empty($item["PREVIEW_PICTURE_SECOND"])) {
        $offer["PREVIEW_PICTURE_SECOND"] = setResizeImage($offer["PREVIEW_PICTURE_SECOND"], $arParams["RESIZE_IMAGE_WIDTH"], $arParams["RESIZE_IMAGE_HEIGHT"]);
      }
      foreach ($offer["MORE_PHOTO"] as &$photo) {
        $photo = setResizeImage($photo, $arParams["RESIZE_IMAGE_WIDTH"], $arParams["RESIZE_IMAGE_HEIGHT"]);
      }
    }
    unset($offer, $photo);
  }
  unset($item);
}
?>
