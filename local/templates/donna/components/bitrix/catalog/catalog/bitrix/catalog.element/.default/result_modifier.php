<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */
$arFilter = Array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"IBLOCK_SECTION_ID" => $arResult["IBLOCK_SECTION_ID"], 	
	"!ID"=> $arParams["ELEMENT_ID"],
	"ACTIVE"=>"Y",
	"PROPERTY_PRODUCT_COLORS_CODE" => $arResult["PROPERTIES"]["PRODUCT_COLORS_CODE"]["VALUE"],	
);
$arSelect = array("DETAIL_PAGE_URL", "PREVIEW_PICTURE", "PROPERTY_COLOR", "ID");
$products = CIBlockElement::GetList(
	array(),
	$arFilter,
	false,
	false,
	$arSelect
);
while ($product = $products->GetNext())
{
	if(!empty($product["PREVIEW_PICTURE"]))
	{		
		$resizeImage = CFile::ResizeImageGet($product["PREVIEW_PICTURE"], array('width'=>80, 'height'=>110), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$product["PREVIEW_PICTURE"] = $resizeImage["src"];
		$arResult["PRODUCT_COLORS"][] = $product;
	}
}
if(!empty($arResult["PROPERTIES"]["IMAGES"]) && is_array($arResult["PROPERTIES"]["IMAGES"]["VALUE"]))
{
	foreach($arResult["PROPERTIES"]["IMAGES"]["VALUE"] as $imageID)
	{
		$image = CFile::ResizeImageGet($imageID, array('width'=>350, 'height'=>550), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arResult["SLIDER_IMAGES"][] = $image;
	}
	unset($image, $imageID);
}
$arFilter = Array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],	
	"!ID"=> $arParams["ELEMENT_ID"],
	"ACTIVE"=>"Y",
	"ID" => $arResult["PROPERTIES"]["RECOMEND"]["VALUE"],	
);
$arSelect = array("ID", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "NAME");
$products = CIBlockElement::GetList(
	array(),
	$arFilter,
	false,
	false,
	$arSelect
);
while ($product = $products->GetNext())
{
	$resizeImage = CFile::ResizeImageGet($product["PREVIEW_PICTURE"], array('width'=>80, 'height'=>110), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$product["PREVIEW_PICTURE"] = $resizeImage["src"];
	$price = CPrice::GetBasePrice($product["ID"]);
	$product["PRICE"] = CurrencyFormat($price["PRICE"], $price["CURRENCY"]);
	$arResult["RECOMENDED"][] = $product;		
}
$component = $this->getComponent();
$component->arResultCacheKeys = array_merge($component->arResultCacheKeys, array("SLIDER_IMAGES", "PRODUCT_COLORS", "RECOMENDED"));
$arParams = $component->applyTemplateModifications();