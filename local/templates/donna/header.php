<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<!DOCTYPE html>

<head>
  <title><? $APPLICATION->ShowTitle(); ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <? $APPLICATION->ShowHead(); ?>
  <!--[if lt IE 9]>
	<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?

  use Bitrix\Main\Page\Asset;

  Asset::getInstance()->addJs("https://code.jquery.com/jquery-1.11.3.min.js");
  Asset::getInstance()->addJs("http://code.jquery.com/ui/1.11.4/jquery-ui.js");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/jquery.flexslider.js");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/slick.min.js");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/jquery.fancybox.js");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/jquery.zoom.min.js");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/jquery.zoom.min.js");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/jquery.fancybox-media.js");
  Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/scripts/scripts.js");
  ?>
</head>

<body class="body">
  <div id="panel"><? $APPLICATION->ShowPanel(); ?></div>
  <section id="wrapper">

    <header id="header">
      <div class="inner">
        <div id="logo">
          <!-- TODO: title-->
          <a href="/" title=""></a>
        </div>

        <div class="search-section">
          <?
          $APPLICATION->IncludeComponent(
            "bitrix:search.form",
            ".default",
            array(
              "PAGE" => "#SITE_DIR#search/index.php",
              "USE_SUGGEST" => "N",
            ),
            false
          );
          ?>
        </div>

        <div class="phones">
          <?
          $APPLICATION->IncludeFile(
            SITE_DIR . "/include/phones.php",
            array("MODE" => "HTML")
          );
          ?>
        </div>

        <div class="acount-info">

          <?
          $APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	".default", 
	array(
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_PERSONAL_LINK" => "Y",
		"PATH_TO_PERSONAL" => SITE_DIR."bag/",
		"SHOW_AUTHOR" => "Y",
		"PATH_TO_AUTHORIZE" => "",
		"SHOW_REGISTRATION" => "Y",
		"PATH_TO_REGISTER" => SITE_DIR."login/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"SHOW_PRODUCTS" => "N",
		"POSITION_FIXED" => "N",
		"HIDE_ON_BASKET_PAGES" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
          ?>
        </div>

        <div class="mobile-menu"><span></span>
          <div><?= GetMessage("MENU") ?></div>
        </div>
      </div>
    </header>

    <?
    $APPLICATION->IncludeComponent(
      "bitrix:menu",
      "top_menu",
      array(
        "ROOT_MENU_TYPE" => "top",
        "CHILD_MENU_TYPE" => "left",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "MENU_CACHE_GET_VARS" => array(),
        "MAX_LEVEL" => "1",
        "USE_EXT" => "N",
        "DELAY" => "N",
        "COMPONENT_TEMPLATE" => "top_menu"
      ),
      false
    );
    ?>
