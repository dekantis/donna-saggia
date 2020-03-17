<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>	
			</section>
		</section>
		<footer id="footer">	
			<div class="inner">
				<?
				$APPLICATION->IncludeFile(
					SITE_DIR."include/phones2.html",
					Array(),
					Array("MODE"=>"html")
				);
				?>
			  
				<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", Array(
					"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
						"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
						"DELAY" => "N",	// Откладывать выполнение шаблона меню
						"MAX_LEVEL" => "1",	// Уровень вложенности меню
						"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_TYPE" => "N",	// Тип кеширования
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"ROOT_MENU_TYPE" => "bottom",	// Тип меню для первого уровня
						"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
						"COMPONENT_TEMPLATE" => "bottom_menu"
					),
					false
				);?>
				
				<?$APPLICATION->IncludeComponent(
					"bitrix:menu",
					"company_menu",
					Array(
						"ALLOW_MULTI_SELECT" => "N",
						"CHILD_MENU_TYPE" => "left",
						"DELAY" => "N",
						"MAX_LEVEL" => "1",
						"MENU_CACHE_GET_VARS" => array(""),
						"MENU_CACHE_TIME" => "3600",
						"MENU_CACHE_TYPE" => "N",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"ROOT_MENU_TYPE" => "company",
						"USE_EXT" => "N",
						"COMPONENT_TEMPLATE" => "company_menu"
					)
				);?>
			  
				<div class="social">
			  
					<?$APPLICATION->IncludeComponent(
						"bitrix:eshop.socnet.links",
						"links",
						Array(
							"FACEBOOK" => "#",
							"GOOGLE" => "",
							"INSTAGRAM" => "#",
							"TWITTER" => "",
							"VKONTAKTE" => "#"
						)
					);?>
					<?$APPLICATION->IncludeComponent(
	"bitrix:sender.subscribe", 
	".default", 
	array(
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CONFIRMATION" => "Y",
		"HIDE_MAILINGS" => "N",
		"SET_TITLE" => "N",
		"SHOW_HIDDEN" => "N",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"USE_PERSONALIZATION" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
				</div>
				
				<?
				$APPLICATION->IncludeFile(
					SITE_DIR."include/copyrigth.html",
					Array(),
					Array("MODE"=>"html")
				);
				?>
			</div>
		</footer>
	</body>
</html>
