<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"DISPLAY_DATE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_DATE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_NAME" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_NAME"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PICTURE" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_PICTURE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	"DISPLAY_PREVIEW_TEXT" => Array(
		"NAME" => GetMessage("T_IBLOCK_DESC_NEWS_TEXT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
	'IMAGE_WIDTH' => Array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_IMAGE_WIDTH'),
		'TYPE' => 'STRING',
		'DEFAULT' => '300'
	),
	'IMAGE_HEIGHT' => Array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_IMAGE_HEIGHT'),
		'TYPE' => 'STRING',
		'DEFAULT' => '400'
	)
);
?>
