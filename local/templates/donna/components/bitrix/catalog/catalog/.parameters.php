<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?
$arTemplateParameters = array(
	"SHOW_OFFER" => array(
		"NAME" => GetMessage("SHOW_OFFER"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y"
	),
	"OFFER_LINK" => array(
		"NAME" => GetMessage("OFFER_LINK"),
		"TYPE" => "STRING",
		"DEFAULT" => "/opt"
	),
	"SAVE_SORT_IN_SESSION" => array(
		"PARENT" => "LIST_SETTINGS",
		"NAME" => GetMessage("SAVE_SORT_IN_SESSION"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y"
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
