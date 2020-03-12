<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
if(CModule::IncludeModule("iblock"))
{
	$IBLOCK_ID = 1; 
	$itemsSection = GetIBlockSectionList($IBLOCK_ID);
	while($arItem = $itemsSection->GetNext()) { 

	$aMenuLinks[] = Array(
			$arItem["NAME"],
			$arItem["SECTION_PAGE_URL"],
			Array(),
			Array(),
			""
			);
	}
}   
?>