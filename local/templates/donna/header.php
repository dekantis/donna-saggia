<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	

	<?$APPLICATION->ShowHead();?>
	<?Asset::getInstance()->addJs("https://code.jquery.com/jquery-1.11.3.min.js");?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/jquery.flexslider.js");?>
	<?Asset::getInstance()->addJs("http://code.jquery.com/ui/1.11.4/jquery-ui.js");?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/slick.min.js");?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/jquery.fancybox.js");?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/jquery.zoom.min.js");?>
	<?Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/scripts.js");?>

	<!--[if lt IE 9]>
		<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

	<![endif]-->


	<title><?$APPLICATION->ShowTitle();?></title>
</head>

<body>
<section id="wrapper">
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		<header id="header">	
			<div class="inner">
				<div id="logo">
					<a title="<?=GetMessage('SITE_NAME')?>"></a>
				</div>
						
						
							
			<?$APPLICATION->IncludeComponent(
				"bitrix:search.title", 
				".default", 
				array(
					"CATEGORY_0" => array(
						0 => "iblock_catalog",
					),
					"CATEGORY_0_TITLE" => "Товары",
					"CATEGORY_0_iblock_catalog" => array(
						0 => "1",
					),
					"CHECK_DATES" => "N",
					"CONTAINER_ID" => "title-search",
					"INPUT_ID" => "title-search-input",
					"NUM_CATEGORIES" => "1",
					"ORDER" => "date",
					"PAGE" => "#SITE_DIR#search/index.php",
					"SHOW_INPUT" => "Y",
					"SHOW_OTHERS" => "N",
					"TOP_COUNT" => "5",
					"USE_LANGUAGE_GUESS" => "Y",
					"COMPONENT_TEMPLATE" => ".default"
				),
				false
			);?>
								
											
									
					
				<?
				$APPLICATION->IncludeFile(
					SITE_DIR."include/phones1.html",
					Array(),
					Array("MODE"=>"html")
				);
				?>
				<div class="acount-info">
					<div class="login">
					<?if(!$USER->IsAuthorized()):?>
						<a href="<?=SITE_DIR."auth/"?>">Зарегистрироваться</a>
						<a href="<?=SITE_DIR."login/"?>">Войти</a>
					<?endif;?>
					</div>
	
					<div class="bag">
						<?
						$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "", Array(
								"PATH_TO_BASKET" => SITE_DIR . "bag/",	// Страница корзины
								"PATH_TO_ORDER" => SITE_DIR."bag/",	// Страница оформления заказа
								"SHOW_NUM_PRODUCTS" => "Y",	// Показывать количество товаров
								"SHOW_TOTAL_PRICE" => "Y",	// Показывать общую сумму по товарам
								"SHOW_EMPTY_VALUES" => "Y",	// Выводить нулевые значения в пустой корзине
								"SHOW_PERSONAL_LINK" => "N",	// Отображать персональный раздел
								"PATH_TO_PERSONAL" => SITE_DIR."bag/",	// Страница персонального раздела
								"SHOW_AUTHOR" => "N",	// Добавить возможность авторизации
								"PATH_TO_AUTHORIZE" => "",	// Страница авторизации
								"SHOW_REGISTRATION" => "N",	// Добавить возможность регистрации
								"PATH_TO_REGISTER" => SITE_DIR."login/",	// Страница регистрации
								"PATH_TO_PROFILE" => SITE_DIR."personal/",	// Страница профиля
								"SHOW_PRODUCTS" => "N",	// Показывать список товаров
								"POSITION_FIXED" => "N",	// Отображать корзину поверх шаблона
								"HIDE_ON_BASKET_PAGES" => "N",	// Не показывать на страницах корзины и оформления заказа
								"COMPONENT_TEMPLATE" => ".default"
							),
							false
						);
						?>
					</div>
				</div>

				<div class="mobile-menu"><span></span><div>МЕНЮ</div></div>
			</div>			
		</header>
		<?$APPLICATION->IncludeComponent(
			"bitrix:menu", 
			"horizontal_multilevel_top", 
			array(
				"ALLOW_MULTI_SELECT" => "N",
				"CHILD_MENU_TYPE" => "left",
				"DELAY" => "N",
				"MAX_LEVEL" => "2",
				"MENU_CACHE_GET_VARS" => array(
				),
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"ROOT_MENU_TYPE" => "top",
				"USE_EXT" => "Y",
				"COMPONENT_TEMPLATE" => "horizontal_multilevel_top"
			),
			false
		);?>
		<?if($APPLICATION->GetCurPage() == "/")
		{
			$APPLICATION->IncludeComponent(
				"bitrix:news.detail", 
				"slider.main", 
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_ELEMENT_CHAIN" => "N",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"BROWSER_TITLE" => "-",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"CHECK_DATES" => "Y",
					"COMPONENT_TEMPLATE" => "slider.main",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "N",
					"DISPLAY_DATE" => "N",
					"DISPLAY_NAME" => "N",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "N",
					"DISPLAY_TOP_PAGER" => "N",
					"ELEMENT_CODE" => "slider_main",
					"ELEMENT_ID" => "",
					"FIELD_CODE" => array(
						0 => "DETAIL_PICTURE",
						1 => "",
					),
					"IBLOCK_ID" => "4",
					"IBLOCK_TYPE" => "news",
					"IBLOCK_URL" => "",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"MESSAGE_404" => "",
					"META_DESCRIPTION" => "-",
					"META_KEYWORDS" => "-",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_TEMPLATE" => ".default",
					"PAGER_TITLE" => "Страница",
					"PROPERTY_CODE" => array(
						0 => "UF_WIDTH",
						1 => "UF_HEIGHT",
						2 => "UF_RIGHT_NAME",
						3 => "UF_RIGHT_DESCRIPTION",
						4 => "UF_PICS",
						5 => "UF_RIGHT_FILE",
						6 => "UF_RIGHT_DOWN_FILE",
						7 => "",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_CANONICAL_URL" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"STRICT_SECTION_CHECK" => "N",
					"USE_PERMISSIONS" => "N",
					"USE_SHARE" => "N"
				),
				false
			);
		}?>
		<section id="container">