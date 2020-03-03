<?php
class NewProductChecker
{
	function AddNewProduct(&$arParams)
	{	
		if($arParams["IBLOCK_ID"] == 2)
		{		
			$arParams["IBLOCK_SECTION"][] = "18";
		}		
	}
}