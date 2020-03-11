<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
		</div>		
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
				<?$APPLICATION->IncludeComponent("bitrix:subscribe.form", "subscribe.main", Array(
					"CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"CACHE_TYPE" => "A",	// Тип кеширования
						"PAGE" => "#SITE_DIR#personal/subscribe/subscr_edit.php",	// Страница редактирования подписки (доступен макрос #SITE_DIR#)
						"SHOW_HIDDEN" => "N",	// Показать скрытые рубрики подписки
						"USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
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
