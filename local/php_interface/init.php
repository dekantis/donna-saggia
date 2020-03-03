<?
CModule::AddAutoloadClasses(
        '', // не указываем имя модуля
        array(
           // ключ - имя класса, значение - путь относительно корня сайта к файлу с классом
                'DiscountChecker' => '/local/php_interface/classes/DiscountChecker.php',
                'NewProductChecker' => '/local/php_interface/classes/NewProductChecker.php',
        )
);

\Bitrix\Main\EventManager::getInstance()->addEventHandler("sale", "DiscountonAfterAdd", Array("DiscountChecker", "AddDiscountProperty"));
\Bitrix\Main\EventManager::getInstance()->addEventHandler("sale", "DiscountonBeforeUpdate", Array("DiscountChecker", "UpdateDiscountProperty"));
\Bitrix\Main\EventManager::getInstance()->addEventHandler("sale", "DiscountonDelete", Array("DiscountChecker", "DeleteDiscountProperty"));

AddEventHandler("iblock", "OnBeforeIBlockElementAdd", Array("NewProductChecker", "AddNewProduct"));

?>