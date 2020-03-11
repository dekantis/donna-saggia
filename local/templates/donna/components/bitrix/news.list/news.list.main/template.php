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

<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<section class="news">
	<div class="inner">
		<div class="title-section">Новости</div>
			<?
			$firstElem = key($arResult["ITEMS"]);
			foreach($arResult["ITEMS"] as $key=>$arItem):
			?>			
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>				
				<div class="news-item <?if($key == $firstElem) {echo "first";}?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<?
						
					?>
					<div class="news-image">
						<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
								<img src="<?=CFile::ResizeImageGet(
									$arItem["PREVIEW_PICTURE"],
									array("width" => $arParams["IMAGE_WIDTH"], "height" => $arParams["IMAGE_HEIGHT"]),
									BX_RESIZE_IMAGE_PROPORTIONAL_ALT ,
									true
								)["src"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
							</a>
						<?else:?>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
								<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
							</a>
						<?endif?>
					</div>
					<div class="news-description">
						<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
							<div class="date"><?= $arItem["DISPLAY_ACTIVE_FROM"]?></div>
						<?endif?>
						<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
							<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
								<h3><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?= $arItem["NAME"]?></a></h3>
							<?else:?>
								<h3><?= $arItem["NAME"]?></h3>
							<?endif;?>
						<?endif;?>
						<p>
							<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
								<?echo $arItem["PREVIEW_TEXT"];?>
							<?endif;?>
						</p>
						<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
							<a class="more" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Подробнее..</a>
						<?endif;?>
					</div>
				</div>
			<?endforeach;?>
			<div class="button-section">
				<a class="see-all" href="/news/">Все новости</a>
			</div>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
</section>

