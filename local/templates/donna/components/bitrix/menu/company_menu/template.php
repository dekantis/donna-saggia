<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?if (!empty($arResult)):
?>

<div class="company-menu">
	<h3>Компания</h3>
	<ul>
		<?
		$count = 0;
		foreach($arResult as $arItem):
			if($count == 3):?>
				</ul><ul>
			<?
			endif;
			$count++;
			?>	
			<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?endforeach;?>	
	</ul>
</div>
<?endif;?>