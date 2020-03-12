<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav id="navi">
	<ul id="horizontal-multilevel-menu">

	<?
	$previousLevel = 0;
	foreach($arResult as $arItem):?>

		<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
		<?endif?>

		<?if ($arItem["IS_PARENT"]):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="<?if ($arItem["SELECTED"]):?>opt first_level<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					<ul class="inner_ul">
			<?else:?>
				<li <?if ($arItem["SELECTED"]):?> class="select_inner_li"<?endif?>><a href="<?=$arItem["LINK"]?>" class="inner_ul_a"><?=$arItem["TEXT"]?></a>
					<ul>
			<?endif?>

		<?else:?>

			<?if ($arItem["PERMISSION"] > "D"):?>

				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li class="<?if ($arItem["SELECTED"]):?>opt<?endif?>"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
				<?else:?>
					<li<?if ($arItem["SELECTED"]):?> class="select_inner_li"<?endif?>><a href="<?=$arItem["LINK"]?>" class="inner_ul_a"><?=$arItem["TEXT"]?></a></li>
				<?endif?>

			<?else:?>

				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li class="<?if ($arItem["SELECTED"]):?>opt<?endif?>"><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
				<?else:?>
					<li <?if ($arItem["SELECTED"]):?> class="select_inner_li"<?endif?>><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
				<?endif?>

			<?endif?>

		<?endif?>

		<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

	<?endforeach?>

	<?if ($previousLevel > 1)://close last item tags?>
		<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
	<?endif?>

	</ul>
</nav>
<?endif?>