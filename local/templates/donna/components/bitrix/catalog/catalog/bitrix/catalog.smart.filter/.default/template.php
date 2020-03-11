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
?>
<div class="filter">
	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
		<?
		//not prices
		foreach($arResult["ITEMS"] as $key=>$arItem)
		{	
			if(
				empty($arItem["VALUES"])
				|| isset($arItem["PRICE"])
			) 
			{
				continue;
			}
				
			?>
			<div class="filter-wrap">
				<?if (!in_array($arItem["CODE"], array("SALE", "NEW_COLLECTION", "SALELEADER"))):?>
				<div class="title-filter">
					<?=$arItem["NAME"]?>
					<?if ($arItem["FILTER_HINT"] <> ""):?>
						<i id="item_title_hint_<?echo $arItem["ID"]?>" class="fa fa-question-circle"></i>
						<script type="text/javascript">
							new top.BX.CHint({
								parent: top.BX("item_title_hint_<?echo $arItem["ID"]?>"),
								show_timeout: 10,
								hide_timeout: 200,
								dx: 2,
								preventHide: true,
								min_width: 250,
								hint: '<?= CUtil::JSEscape($arItem["FILTER_HINT"])?>'
							});
						</script>
					<?endif;?>
				</div>
				<?endif;?>
				<?
				if($arItem["CODE"] == "COLOR")
				{
					$arItem["DISPLAY_TYPE"] = "C";
				};
				switch ($arItem["DISPLAY_TYPE"])
				{
					case "C"://color filter
						?>
						<ul class="color-filter">
							<?foreach ($arItem["VALUES"] as $val => $ar):
								$class = "";
								if ($ar["CHECKED"])
									$class.= " bx-active";
								if ($ar["DISABLED"])
									$class.= " disabled";
							?>
							<label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="<?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
								<li <? echo $ar["CHECKED"]? 'class="active"': '' ?>>															
									<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
										<span class="class" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
									<?endif?>
									
								</li>
							</label>
							<input
									style="display: none"
									type="checkbox"
									name="<?=$ar["CONTROL_NAME"]?>"
									id="<?=$ar["CONTROL_ID"]?>"
									value="<?=$ar["HTML_VALUE"]?>"
									<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
								/>
							<?endforeach?>
							</ul>
						<?
						break;
					default: //CHECKBOXES
						?>
						<ul>
							<?foreach($arItem["VALUES"] as $val => $ar):?>
								<li>
									<input
										type="checkbox"
										value="<? echo $ar["HTML_VALUE"] ?>"
										name="<? echo $ar["CONTROL_NAME"] ?>"
										id="<? echo $ar["CONTROL_ID"] ?>"
										<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
										onclick="smartFilter.click(this)"
									/>
									<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="<? echo $ar["DISABLED"] ? 'disabled': '' ?>" for="<? echo $ar["CONTROL_ID"] ?>">									
											<?=in_array($arItem["CODE"],array("NEW_COLLECTION","SALE", "SALELEADER")) ? $arItem["NAME"] : $ar["VALUE"];?>
											<?
											if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
												?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
											endif;
											?>
									</label>
								</li>
							<?endforeach;?>
						</ul>
				<?
				}
				?>
				<div style="clear: both"></div>
			</div>
		<?
		}
		foreach($arResult["ITEMS"] as $key=>$arItem)//prices
		{	
			$key = $arItem["ENCODED_ID"];
			if(isset($arItem["PRICE"])):
				if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
					continue;

				?>
				<div class="filter-wrap" data-role="bx_filter_block">
					<div class="title-filter"><?=$arItem["NAME"]?></div>
					<div class="result" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="none">
						<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
						<span class="arrow"></span>
					</div>
					<div id="slider-range"></div>
					<div class="range-min"></div>
					<div class="range-max"></div>
					<div id="min-price-html">
						<input
							class="min-price"
							type="hidden"
							name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
							id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
							value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
							size="3"
							onkeyup="smartFilter.keyup(this)"
						/>
					</div>
					<div id="max-price-html">
						<input
							class="max-price"
							type="hidden"
							name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
							id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
							value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
							size="3"
							onkeyup="smartFilter.keyup(this)"
						/>
					</div>
				</div>
					
				
				<?
				$arJsParams = array(
					"tracker" => "slider-range",
					"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
					"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
					"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
					"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
					"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
					"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
					"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
					"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
					"precision" => $precision,
				);
				?>
				<script type="text/javascript">			
					BX.ready(function(){
						window['trackBar'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
							
					});				
				</script>
			<?endif;
		}
		?>
		<input 
						style="border: 0px; width: 140px;" 
						class="choose" 
						type="submit" 
						id="set_filter" 
						name="set_filter"
						value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
					>
</form>
</div>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>