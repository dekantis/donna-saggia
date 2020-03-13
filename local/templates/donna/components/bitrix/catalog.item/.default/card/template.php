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

?>
<div class="goods" id="<?=$areaId?>">
<?
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
{?>

	<div class="<?
	foreach($item['DISPLAY_PROPERTIES'] as $key=>$property)
	{
		switch($key)
		{
			case 'SALE':
				if ($price['RATIO_BASE_PRICE'] > $price['RATIO_PRICE'])
				{
					echo ' sale';
				}
				break;
			case 'NEW_COLLECTION':
				echo ' new';
				break;
			case 'SALE_LEADER':
				echo ' hit';
				break;
		}
	}
	?>"></div>
<?}?>
<div class="goods-inner">
	<div class="goods-slider">
		<ul class="slides">
			<?
			if (count($morePhoto) > 1)
			{
				foreach ($morePhoto as $key => $photo)
				{
					?>
					<li><img src="<?=$photo['SRC']?>"></li>
					<?
				}
			}
			else
			{?>
				<a href="<?=$item['DETAIL_PAGE_URL']?>">
					<img src="<?=CFile::ResizeImageGet($morePhoto[0]['ID'], array('width'=>'100', 'height'=>'210'), BX_RESIZE_IMAGE_PROPORTIONAL , true)['src'];?>">
				</a>
			<?}
			?>
		</ul>		
		<? if ($itemHasDetailUrl): ?>
			<a href="/catalog/ajax/detail.php?elem=<?=$item["ID"]?>" class="quick-view various fancybox.ajax" data-fancybox-type="ajax">Быстрый просмотр</a>
		<? endif;?>
	</div>
	<div class="goods-description">
		<h3>
		<? if ($itemHasDetailUrl): ?>
			<a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$productTitle?></a>
		<?else:?>
			<?=$productTitle?>
		<? endif; ?>
		</h3>
		<div class="art">
			<? 
			echo $item['DISPLAY_PROPERTIES']["ARTNUMBER"]["NAME"] . ": ";
			echo $item['DISPLAY_PROPERTIES']["ARTNUMBER"]["VALUE"];
			?>
		</div>
		<div class="cost">
			<?
			if ($arParams['SHOW_OLD_PRICE'] === 'Y')
			{
				?>
				<span class="product-item-price-old"
					<?=($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : 'style="color:#353535; text-decoration: line-through;"')?>>
					<?=$price['PRINT_RATIO_BASE_PRICE']?>
				</span>
				<?
			}
			?>
			<span class="product-item-price-current"
				<?=($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? '' : 'style="color: #e52b2d;"')?>
			>
				<?
				if (!empty($price))
				{
					if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers)
					{
						echo Loc::getMessage(
							'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
							array(
								'#PRICE#' => $price['PRINT_RATIO_PRICE'],
							)
						);
					}
					else
					{	
						echo $price['PRINT_RATIO_PRICE'];
					}
					
				}
				?>
			</span>
		</div>
		<?if($haveOffers):?>
		<div class="sizes">
			<div>Размеры:</div>
			<ul>
				<?
					foreach ($item["OFFERS"] as $offer)
					{
						echo "<a href='".$item['DETAIL_PAGE_URL']."'><li>" . $offer["PROPERTIES"]["SIZE"]["VALUE"] . "</li></a>";
					}
				?>
			</ul>
		</div>
		<?endif;?>
	</div>
</div>
</div>