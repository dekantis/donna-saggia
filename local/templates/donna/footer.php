<footer id="footer">
  <div class="inner">
    <div class="footer-phones">
      <?
      $APPLICATION->IncludeFile(
        SITE_DIR . "/include/footer_phones.php",
        array("MODE" => "HTML")
      );
      ?>
    </div>

    <div class="info-menu">
      <?
      $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "info_menu",
        array(
          "ROOT_MENU_TYPE" => "info",
          "ALLOW_MULTI_SELECT" => "N",
          "COMPONENT_TEMPLATE" => "info_menu",
          "MENU_CACHE_TYPE" => "N",
          "MENU_CACHE_TIME" => "3600",
          "MENU_CACHE_USE_GROUPS" => "Y",
          "MENU_CACHE_GET_VARS" => array(),
          "MAX_LEVEL" => "1",
          "USE_EXT" => "N",
          "DELAY" => "N"
        ),
        false
      );
      ?>
    </div>

    <div class="company-menu">
      <?
      $APPLICATION->IncludeComponent(
        "bitrix:menu",
        "company_menu",
        array(
          "ROOT_MENU_TYPE" => "company",
          "ALLOW_MULTI_SELECT" => "N",
          "COMPONENT_TEMPLATE" => "company_menu",
          "MENU_CACHE_TYPE" => "N",
          "MENU_CACHE_TIME" => "3600",
          "MENU_CACHE_USE_GROUPS" => "Y",
          "MENU_CACHE_GET_VARS" => array(),
          "MAX_LEVEL" => "1",
          "USE_EXT" => "N",
          "DELAY" => "N",
          "CHILD_MENU_TYPE" => "left",
          "CHUNK_SIZE" => "3"
        ),
        false
      );
      ?>
    </div>

    <div class="social">

      <?
      $APPLICATION->IncludeFile(
        SITE_DIR . "/include/social.php"
      );
      ?>

      <div class="subscribe-section">
        <?
        $APPLICATION->IncludeComponent(
          "bitrix:sender.subscribe",
          ".default",
          array(),
          false
        );
        ?>
      </div>
    </div>
    <div class="copyright">
      <?
      $APPLICATION->IncludeFile(
        SITE_DIR . "include/copyright.php"
      );
      ?>
    </div>
  </div>
</footer>
