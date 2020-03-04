<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
if ($item["PROPERTIES"]["SALE"]["VALUE"] == "10"):?>
	<div class="sale"></div>
<?elseif($item["PROPERTIES"]["NEW_COLLECTION"]["VALUE"] == "10"):?>
	<div class="new"></div>	
<?elseif($item["PROPERTIES"]["SALELEADER"]["VALUE"] == "10"):?>
	<div class="hit"></div>	
<?endif;?>


<div class="goods-inner">
	<div class="goods-slider" id="<?= $itemIds["PICT_SLIDER"] ?>">
		<ul class="slides">
			<li id="<?= $itemIds["PICT"] ?>" <?= ($showSlider ? 'style="display:none;"' : '') ?>><img src="<?= $item["PREVIEW_PICTURE"]["SRC"] ?>"></li>
			<? if ($item["SECOND_PICT"]) : ?>
				<li id="<?= $itemIds["SECOND_PICT"] ?>" <?= ($showSlider ? 'style="display:none;"' : '') ?>><img src="<?= $item["PREVIEW_PICTURE_SECOND"]["SRC"] ?>"></li>
			<? endif; ?>
			<? if ($showSlider) : ?>
				<? foreach ($morePhoto as $photo) : ?>
					<li><img src="<?= $photo["SRC"] ?>" alt="<?= $photo["ALT"] ?>"></li>
				<? endforeach; ?>
			<? endif; ?>
		</ul>
		<a href="/ajax/detail.php?elem=<?=$item["ID"]?>" class="quick-view various fancybox.ajax" data-fancybox-type="ajax">Быстрый просмотр</a>
	</div>

	<div class="goods-description">
		<h3>
			<? if ($itemHasDetailUrl) : ?>
				<a href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $productTitle ?>"><?= $productTitle ?></a>
			<? else : ?>
				<span><?= $productTitle ?></span>
			<? endif; ?>
		</h3>
		
		<?
		$priceList = $item["PRICE_MATRIX"]["MATRIX"][1]["ZERO-INF"];
		$blockNames = explode(",", $arParams["PRODUCT_BLOCKS_ORDER"]);
		foreach ($blockNames as $blockName) : ?>
			<?

			switch ($blockName) {
				case "price":
					?>
						<div 
							class="cost" 
							id="<?= $itemIds["PRICE"] ?>">
							<? if (!empty($price)) : ?>
								
								<? if($priceList["PRICE"] > $priceList["DISCOUNT_PRICE"]):?>
								
								<span style="color:#e52b2d;"><?=$price["PRINT_RATIO_PRICE"]?></span>
								<span style="color: #353535;  font-family: 'proxima_nova_rgregular', sans-serif; text-decoration: line-through;">
								<?=$price["PRINT_RATIO_BASE_PRICE"]?></span>
								<? else: ?>
									<?= $price["PRINT_RATIO_PRICE"] ?>
								<? endif; ?>
							<? endif; ?>
						</div>
					<?
					break;
				case "props":
					?>
						<? if (!$haveOffers) : ?>
							<? foreach ($item["DISPLAY_PROPERTIES"] as $code => $displayProperty) : ?>
								<div class="art">
									<?= $displayProperty["NAME"] ?>: 
									<?= (is_array($displayProperty["DISPLAY_VALUE"])
									? implode(' / ', $displayProperty["DISPLAY_VALUE"])
									: $displayProperty["DISPLAY_VALUE"])
									?>
								</div>
							<? endforeach; ?>
						<? else : ?>
							<?
								$showProductProps = !empty($item['DISPLAY_PROPERTIES']);
								$showOfferProps = $arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $item['OFFERS_PROPS_DISPLAY'];
							?>
							<? if ($showProductProps || $showOfferProps) : ?>
									<? foreach ($item["DISPLAY_PROPERTIES"] as $code => $displayProperty) : ?>
										<div class="art">
											<?= $displayProperty["NAME"] ?>: 
											<?= (is_array($displayProperty["DISPLAY_VALUE"])
											? implode(' / ', $displayProperty["DISPLAY_VALUE"])
											: $displayProperty["DISPLAY_VALUE"])
											?>
										</div>
								<? endforeach; ?>
							<? endif; ?>
						<? endif; ?>
					<?
					break;
				case "sku":
					if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $haveOffers && !empty($item['OFFERS_PROP'])) {
						?>
							<div id="<?= $itemIds["PROP_DIV"]?>">
								<? foreach ($arParams["SKU_PROPS"] as $skuProperty) : ?>
									<?
										$propertyId = $skuProperty["ID"];
										$skuProperty["NAME"] = htmlspecialcharsbx($skuProperty["NAME"]);
										if (!isset($item["SKU_TREE_VALUES"][$propertyId]))
											continue;
									?>
									<div class="sizes" data-entity="sku-line-block">
										<div><?=$skuProperty["NAME"]?></div>
										<ul>
											<?
											foreach ($skuProperty["VALUES"] as $value) {
												if (!isset($item["SKU_TREE_VALUES"][$propertyId][$value["ID"]]))
													continue;

													$value["NAME"] = htmlspecialcharsbx($value["NAME"]);

													if ($skuProperty["SHOW_MODE"] === "PICT") {
														?>
															<li style="background-image: url(<?=$value["PICT"]["SRC"]?>)" data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>" data-onevalue="<?= $value['ID'] ?>"></li>
														<?
													} else {
														?>
															<li data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>" data-onevalue="<?= $value['ID'] ?>"><?= $value["NAME"] ?></li>
														<?
													}
											}
											?>
										</ul>
									</div>
								<? endforeach; ?>
							</div>
						<?

						foreach ($arParams["SKU_PROPS"] as $skuProperty) {
							if (!isset($item["OFFERS_PROP"][$skuProperty["CODE"]]))
								continue;

							$skuProps[] = array(
								"ID" => $skuProperty["ID"],
								"SHOW_MODE" => $skuProperty["SHOW_MODE"],
								"VALUES" => $skuProperty["VALUES"],
								"VALUES_COUNT" => $skuProperty["VALUES_COUNT"]
							);
						}

						unset($skuProperty, $value);

						if ($item["OFFERS_PROPS_DISPLAY"]) {
							foreach ($item["JS_OFFERS"] as $keyOffer => $jsOffer) {
								$strProps = "";

								foreach ($jsOffer["DISPLAY_PROPERTIES"] as $displayProperty) {
									$strProps .= '<div class="art">'
									. $displayProperty["NAME"]
									. ": " 
									. (is_array($displayProperty["DISPLAY_VALUE"])
									? implode(' / ', $displayProperty["DISPLAY_VALUE"])
									: $displayProperty["DISPLAY_VALUE"])
									. '</div>';
								}

								$item["JS_OFFERS"][$keyOffer]["DISPLAY_PROPERTIES"] = $strProps;
							}
							unset($jsOffer, $strProps);
						}
					}
					break;
			}
			?>
		<? endforeach; ?>
	</div>

</div>
