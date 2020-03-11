<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?><?$APPLICATION->IncludeComponent("bitrix:catalog.comments", "detail.view.element", Array(
	"BLOG_TITLE" => "Комментарии",	// Надпись на вкладке
		"BLOG_URL" => "catalog_comments",	// Название блога латинскими буквами
		"BLOG_USE" => "Y",	// Использовать комментарии
		"CACHE_TIME" => "0",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CHECK_DATES" => "Y",	// Показывать коментарии только для активных на данный момент элементов
		"COMMENTS_COUNT" => "5",	// Количество показываемых комментариев
		"ELEMENT_CODE" => "",	// Код товара
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],	// Идентификатор товара
		"EMAIL_NOTIFY" => "N",	// Уведомление по электронной почте
		"FB_USE" => "N",	// Использовать Facebook
		"IBLOCK_ID" => "1",	// Идентификатор инфоблока
		"IBLOCK_TYPE" => "catalog",	// Тип инфоблока
		"PATH_TO_SMILE" => "/bitrix/images/blog/smile/",	// Путь к улыбкам
		"SHOW_DEACTIVATED" => "N",	// Показывать комментарии к деактивированным товарам
		"SHOW_RATING" => "Y",	// Включить рейтинг
		"SHOW_SPAM" => "Y",	// Показывать администраторам ссылку на все комментарии пользователя
		"TEMPLATE_THEME" => "blue",	// Цветовая тема
		"URL_TO_COMMENT" => "",	// Путь к комментируемому товару
		"VK_USE" => "N",	// Использовать Вконтакте
		"WIDTH" => "",	// Ширина
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>