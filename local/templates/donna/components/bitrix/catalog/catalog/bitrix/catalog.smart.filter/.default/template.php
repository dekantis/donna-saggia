<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
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

<form name="<?= $arResult["FILTER_NAME"] . "_form" ?>" action="<?= $arResult["FORM_ACTION"] ?>" method="get" class="smartfilter">
	<? foreach ($arResult["HIDDEN"] as $arItem) : ?>
		<input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>" value="<? echo $arItem["HTML_VALUE"] ?>" />
	<? endforeach; ?>

	<? foreach ($arResult["ITEMS"] as $key => $arItem) :
		if (
			empty($arItem["VALUES"])
			|| isset($arItem["PRICE"])
		)
			continue;

		if (
			$arItem["DISPLAY_TYPE"] == "A"
			&& ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
		)
			continue;
		if(in_array($arItem["CODE"],array("NEW_COLLECTION", "SALE", "SALELEADER")))
		{
			$arItem["DISPLAY_TYPE"] = "N";
		};
		if($arItem["CODE"] == "PRODUCT_COLOR")
		{
			$arItem["DISPLAY_TYPE"] = "C";
		};
	?>
		<div class="filter-wrap bx-filter-parameters-box">
			<span class="bx-filter-container-modef"></span>
			<?if($arItem["DISPLAY_TYPE"]!= "N"):?>
				<div class="title-filter"><?= $arItem["NAME"] ?></div>
			<?endif;?>
			<?
			switch ($arItem["DISPLAY_TYPE"]) {
				case "N":
				?>
					<ul>
						<? foreach ($arItem["VALUES"] as $val => $ar) : ?>
							<li>
								<input
									type="checkbox"
									value="<? echo $ar["HTML_VALUE"] ?>"
									name="<? echo $ar["CONTROL_NAME"] ?>"
									id="<? echo $ar["CONTROL_ID"] ?>"
									<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
									onclick="smartFilter.click(this)"
								/>

								<label 
									data-role="label_<?=$ar["CONTROL_ID"]?>"
									for="<?= $ar["CONTROL_ID"] ?>">
									<?= $arItem["NAME"] ?>
								</label>
							</li>
						<? endforeach ?>
					</ul>
			<?		break;
				case "C":
					?>
					<ul class="color-filter">
						<? foreach ($arItem["VALUES"] as $val => $ar) : ?>
							<li>
								<input
									type="checkbox"
									value="<? echo $ar["HTML_VALUE"] ?>"
									name="<? echo $ar["CONTROL_NAME"] ?>"
									id="<? echo $ar["CONTROL_ID"] ?>"
									<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
									onclick="smartFilter.click(this)"
								/>
								<span style="background-image: url(<?=$ar["FILE"]["SRC"]?>)" onclick="pictureClick('<?=$ar["CONTROL_ID"]?>')"></span>
							</li>
						<? endforeach ?>
					<script>
						function pictureClick(controlId) {
							var input = document.getElementById('<?=$ar["CONTROL_ID"]?>');
							input.checked = !input.checked;
							smartFilter.click(input);
						}
					</script>
					</ul>
					<?
					break;
				default:
			?>
					<ul>
						<? foreach ($arItem["VALUES"] as $val => $ar) : ?>
							<li>
								<input
									type="checkbox"
									value="<? echo $ar["HTML_VALUE"] ?>"
									name="<? echo $ar["CONTROL_NAME"] ?>"
									id="<? echo $ar["CONTROL_ID"] ?>"
									<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
									onclick="smartFilter.click(this)"
								/>

								<label 
									data-role="label_<?=$ar["CONTROL_ID"]?>"
									for="<?= $ar["CONTROL_ID"] ?>">
									<?= $ar["VALUE"] ?>
								</label>
							</li>
						<? endforeach ?>
					</ul>
			<?
			}
			?>
		</div>
	<? endforeach; ?>

	<? foreach ($arResult["ITEMS"] as $key => $arItem) :
		if (isset($arItem["PRICE"])) :
			if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
				continue;
	?>
		<div class="filter-wrap bx-filter-parameters-box">
			<span class="bx-filter-container-modef"></span>
			<div class="title-filter"><?= $arItem["NAME"] ?></div>

			<div id="slider-range"></div>
			<div class="range-min"></div>
			<div class="range-max"></div>

			<input
				class="min-price"
				type="hidden"
				name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
				id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
				value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
				size="5"
				onkeyup="smartFilter.keyup(this)"
			/>
			<input
				class="max-price"
				type="hidden"
				name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
				id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
				value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
				size="5"
				onkeyup="smartFilter.keyup(this)"
			/>
			<script>
				$( "#slider-range" ).slider({
					range: true,
					min: <?echo $arItem["VALUES"]["MIN"]["VALUE"]?>,
					max: <?echo $arItem["VALUES"]["MAX"]["VALUE"]?>,
					values: [ <?echo $arItem["VALUES"]["MIN"]["VALUE"]?>, <?echo $arItem["VALUES"]["MAX"]["VALUE"]?> ],
					slide: function( event, ui ) {
						$( ".range-min" ).text(ui.values[ 0 ]);
						$( ".range-max" ).text(ui.values[ 1 ]);
					},
					change: function( event, ui ) {
						var minPriceInput = document.getElementById("<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>");
						var maxPriceInput = document.getElementById("<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>");
						minPriceInput.value = ui.values[0];
						maxPriceInput.value = ui.values[1];
						smartFilter.keyup(minPriceInput);
						smartFilter.keyup(maxPriceInput);
					}
				});
				$( ".range-min" ).text($( "#slider-range" ).slider( "values", 0 ));
				$( ".range-max" ).text($( "#slider-range" ).slider( "values", 1 ));

				$("#slider-range").on("slidechange", function( event, ui ) {
					var minPriceInput = document.getElementById("<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>");
					var maxPriceInput = document.getElementById("<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>");
					minPriceInput.value = ui.values[0];
					maxPriceInput.value = ui.values[1];
					smartFilter.keyup(minPriceInput);
					smartFilter.keyup(maxPriceInput);
				});
			</script>
		</div>
		<? endif; ?>
	<? endforeach ; ?>
	<input 
					style="border: 0px; width: 140px;" 
					class="choose" 
					type="submit" 
					id="set_filter" 
					name="set_filter"
					value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
				>
	<div class="result" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
		<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
	</div>
</form>
<script type="text/javascript">
	var smartFilter = new JCSmartFilter('<? echo CUtil::JSEscape($arResult["FORM_ACTION"]) ?>', '<?= CUtil::JSEscape($arParams["FILTER_VIEW_MODE"]) ?>', <?= CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"]) ?>);
</script>
