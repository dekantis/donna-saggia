<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog.comments",
	"",
	Array(
		"BLOG_TITLE" => "Комментарии",
		"BLOG_URL" => "catalog_comments",
		"BLOG_USE" => "Y",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMMENTS_COUNT" => "5",
		"ELEMENT_CODE" => "",
		"ELEMENT_ID" => "11",
		"EMAIL_NOTIFY" => "N",
		"FB_USE" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"PATH_TO_SMILE" => "/bitrix/images/blog/smile/",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_RATING" => "N",
		"SHOW_SPAM" => "Y",
		"TEMPLATE_THEME" => "blue",
		"URL_TO_COMMENT" => "",
		"VK_USE" => "N",
		"WIDTH" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>