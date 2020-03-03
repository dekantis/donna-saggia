<?php

class DiscountChecker
{
	function AddDiscountProperty(\Bitrix\Main\Event $event)
	{
		$tempAr = $event->getParameter('fields')["ACTIONS_LIST"];
		$saleProdIds = [];
		foreach($tempAr["CHILDREN"] as $key=>$discountData)
		{
			if($discountData["DATA"]["Type"] == "Discount")
			{
				foreach($discountData["CHILDREN"] as $keyProd=>$productData)
				{
					switch ($productData["CLASS_ID"]) 
					{
						case "CondIBElement":
							$saleProdIds += $productData["DATA"]["value"];
							break;
						case "CondIBSection":
							$sections[] = $productData["DATA"]["value"];								
							break;
					}
				
				}
			}
			
		}				

		if(CModule::IncludeModule('iblock') && !empty($sections))
		{
			$productElems = CIBlockElement::GetList(
				array(),
				array("IBLOCK_ID" => 2, "SECTION_ID" => $sections),
				false,
				false,
				array("ID")
			);
			while($res = $productElems->GetNext())
			{	
				if(!in_array($res["ID"], $saleProdIds))
				{
					$saleProdIds[] = $res["ID"];
				}
			}
				
		}	
		$productProp = array("SALE" => "20");
		if(CModule::IncludeModule('iblock') && !empty($saleProdIds))
		{
			$prods = new CIBlockElement;
			foreach ($saleProdIds as $prodId)
			{
				$res = $prods->SetPropertyValuesEx($prodId,"2", $productProp);
			}
		}		
	}
	
	function UpdateDiscountProperty(\Bitrix\Main\Event $event)
	{
		$saleProdIDsBefore = [];
		$discountID = $event->getParameter('id')["ID"];
		$tempAr = unserialize(CSaleDiscount::GetByID($discountID)['ACTIONS']);
		foreach($tempAr["CHILDREN"] as $key=>$discountData)
		{
			if($discountData["DATA"]["Type"] == "Discount")
			{
				foreach($discountData["CHILDREN"] as $keyProd=>$productData)
				{
					switch ($productData["CLASS_ID"]) 
					{
						case "CondIBElement":
							$saleProdIDsBefore += $productData["DATA"]["value"];
							break;
						case "CondIBSection":
							$sectionsBefore[] = $productData["DATA"]["value"];								
							break;
					}
				
				}
			}
			
		}
		$saleProdIDsAfter = [];
		$tempAr = $event->getParameter('fields')["ACTIONS_LIST"];

		foreach($tempAr["CHILDREN"] as $key=>$discountData)
		{
			if($discountData["DATA"]["Type"] == "Discount")
			{
				foreach($discountData["CHILDREN"] as $keyProd=>$productData)
				{
					switch ($productData["CLASS_ID"]) 
					{
						case "CondIBElement":
							$saleProdIDsAfter += $productData["DATA"]["value"];
							break;
						case "CondIBSection":
							$sectionsAfter[] = $productData["DATA"]["value"];								
							break;
					}				
				}
			}			
		}	
		
		if(CModule::IncludeModule('iblock') && !empty($sections))
		{
			$productElems = CIBlockElement::GetList(
				array(),
				array("IBLOCK_ID" => 2, "SECTION_ID" => $sections),
				false,
				false,
				array("ID")
			);
			while($res = $productElems->GetNext())
			{	
				if(!in_array($res["ID"], $saleProdIds))
				{
					$saleProdIds[] = $res["ID"];
				}
			}
				
		}	
		$disableSaleIDs = array_diff($saleProdIDsBefore, $saleProdIDsAfter);
		$activateSaleIDs = array_diff($saleProdIDsAfter, $saleProdIDsBefore);
		if(CModule::IncludeModule('iblock') && !empty($saleProdIDsBefore))
		{
			$disableProp = array("SALE" => "");
			$activateProp = array("SALE" => "20");
			$prods = new CIBlockElement;
			foreach ($disableSaleIDs as $prodId)
			{
				$res = $prods->SetPropertyValuesEx($prodId,"2", $disableProp);
			}
			
			foreach ($activateSaleIDs as $prodId)
			{
				$res = $prods->SetPropertyValuesEx($prodId,"2", $activateProp);
			}
		}
	}
	
	function DeleteDiscountProperty(\Bitrix\Main\Event $event)
	{
		$discountID = $event->getParameter('id')["ID"];
		$tempAr = unserialize(CSaleDiscount::GetByID($discountID)['ACTIONS']);
		$saleProdIds = [];
		foreach($tempAr["CHILDREN"] as $key=>$discountData)
		{
			if($discountData["DATA"]["Type"] == "Discount")
			{
				foreach($discountData["CHILDREN"] as $keyProd=>$productData)
				{
					switch ($productData["CLASS_ID"]) 
					{
						case "CondIBElement":
							$saleProdIds += $productData["DATA"]["value"];
							break;
						case "CondIBSection":
							$sections[] = $productData["DATA"]["value"];								
							break;
					}
				
				}
			}			
		}
		if(CModule::IncludeModule('iblock') && !empty($sections))
		{
			$productElems = CIBlockElement::GetList(
				array(),
				array("IBLOCK_ID" => 2, "SECTION_ID" => $sections),
				false,
				false,
				array("ID")
			);
			while($res = $productElems->GetNext())
			{	
				if(!in_array($res["ID"], $saleProdIds))
				{
					$saleProdIds[] = $res["ID"];
				}
			}
				
		}	
		$productProp = array("SALE" => "");
		if(CModule::IncludeModule('iblock') && !empty($saleProdIds))
		{
			$prods = new CIBlockElement;
			foreach ($saleProdIds as $prodId)
			{
				$res = $prods->SetPropertyValuesEx($prodId,"2", $productProp);
			}
		}		
	}
}