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
					<a href="<?=SITE_DIR?>" title="Название"></a>
				</div>
				<div class="search-section">
					<form action="" method="post">			
						<fieldset>
							<div class="search">
								<input type="text" name="search-input" placeholder="Поиск по названию и номеру артикула" value="" />
								<input type="submit" name="submit" value="" />
							</div>					
						</fieldset>				
					</form>
				</div>
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
			"top_menu",
			Array(
				"ALLOW_MULTI_SELECT" => "N",
				"CHILD_MENU_TYPE" => "left",
				"DELAY" => "N",
				"MAX_LEVEL" => "1",
				"MENU_CACHE_GET_VARS" => array(0=>"",),
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"ROOT_MENU_TYPE" => "top",
				"USE_EXT" => "N"
			)
		);?>
		<section id="container">
			<div class="breadcrumbs">
				<?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"catalog.breadcrumbs", 
	array(
		"COMPONENT_TEMPLATE" => "catalog.breadcrumbs",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1"
	),
	false
);?>
			</div>
			<div class="inner">