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
$this->setFrameMode(true);?>

<section class="">
    <div class="carousel">
		<ul class="slides">
		<?foreach($arResult["DISPLAY_PROPERTIES"]["UF_PICS"]["FILE_VALUE"] as $arPic):?>
			<li style="background-image: url(<?=CFile::ResizeImageGet(
				$arPic,
				array("width" => $arResult["DISPLAY_PROPERTIES"]["UF_WIDTH"]["VALUE"], "height" => $arResult["DISPLAY_PROPERTIES"]["UF_HEIGHT"]["VALUE"]),
				BX_RESIZE_IMAGE_PROPORTIONAL_ALT ,
				true
			)["src"]?>);"></li>
		<?endforeach;?>			
		</ul>
    </div>
    
    <div class="right-side">
		<a href="#" class="image" style="background-image: url(<?=$arResult["DISPLAY_PROPERTIES"]["UF_RIGHT_FILE"]["FILE_VALUE"]["SRC"]?>);">
			<span class="image-title">
				<?=$arResult["DISPLAY_PROPERTIES"]["UF_RIGHT_NAME"]["VALUE"]?>
				<span><?=$arResult["DISPLAY_PROPERTIES"]["UF_RIGHT_DESCRIPTION"]["VALUE"]?></span>
			</span>
		</a>
      
		<a class="sale-home" href="#" style="background-image: url(<?=$arResult["DISPLAY_PROPERTIES"]["UF_RIGHT_DOWN_FILE"]["FILE_VALUE"]["SRC"]?>);"></a>
    </div>
</section>