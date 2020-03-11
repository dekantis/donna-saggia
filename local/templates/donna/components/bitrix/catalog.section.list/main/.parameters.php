<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
$arTemplateParameters = array(
	"SHOW_COUNT" => array(
		"PARENT" => "DATA_SOURCE",
		"NAME" => GetMessage("SHOW_COUNT"),
		"TYPE" => "STRING",
		"DEFAULT" => "5"
	),
	"RESIZE_IMAGE_WEIGHT" => array(
		"PARENT" => "DATA_SOURCE",
		"NAME" => GetMessage("IMAGES_WEIGHT"),
		"TYPE" => "STRING",
		"DEFAULT" => "221"
	),
	"RESIZE_IMAGE_HEIGHT" => array(
		"PARENT" => "DATA_SOURCE",
		"NAME" => GetMessage("IMAGES_HEIGHT"),
		"TYPE" => "STRING",
		"DEFAULT" => "340"
	)
);
?>
