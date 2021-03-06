<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));


if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
	$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
	$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);	
}
if (0 < $arResult["SECTIONS_COUNT"])
{
?>
<div class="side-menu">
	<ul>
	<?
		$intCurrentDepth = 1;
		$boolFirst = true;
		$flag = 1;
		foreach ($arResult['SECTIONS'] as &$arSection)
		{
			if($arSection["SORT"] >= "2000" && $flag == 1)
			{
				echo "</ul><ul>";
				$flag = 0;
			}
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

			if ($intCurrentDepth < $arSection['RELATIVE_DEPTH_LEVEL'])
			{
				if (0 < $intCurrentDepth)
					echo "\n",str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']),'<ul>';
			}
			elseif ($intCurrentDepth == $arSection['RELATIVE_DEPTH_LEVEL'])
			{
				if (!$boolFirst)
					echo '</li>';
			}
			else
			{
				while ($intCurrentDepth > $arSection['RELATIVE_DEPTH_LEVEL'])
				{
					echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
					$intCurrentDepth--;
				}
				echo str_repeat("\t", $intCurrentDepth-1),'</li>';
			}

			echo (!$boolFirst ? "\n" : ''),str_repeat("\t", $arSection['RELATIVE_DEPTH_LEVEL']);
			?><li 
				id="<?=$this->GetEditAreaId($arSection['ID']);?>" 
				<?if($arParams["CUR_SECTION"] == $arSection['ID'])
				{
					echo 'class="current"';
				}?>>
					<a href="<? echo $arSection["SECTION_PAGE_URL"];?>">
						<? echo $arSection["NAME"];?>
						<?if ($arParams["COUNT_ELEMENTS"])
							{?> 
								<span>(<? echo $arSection["ELEMENT_CNT"]; ?>)</span>
							<?}
					?></a><?

			$intCurrentDepth = $arSection['RELATIVE_DEPTH_LEVEL'];
			$boolFirst = false;
		}
		unset($arSection);
		while ($intCurrentDepth > 1)
		{
			echo '</li>',"\n",str_repeat("\t", $intCurrentDepth),'</ul>',"\n",str_repeat("\t", $intCurrentDepth-1);
			$intCurrentDepth--;
		}
		if ($intCurrentDepth > 0)
		{
			echo '</li>',"\n";
		}
	?>
	</ul>
</div>
<?
	echo ('LINE' != $arParams['VIEW_MODE'] ? '<div style="clear: both;"></div>' : '');
}
?>