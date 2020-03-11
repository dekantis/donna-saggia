<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>





	<h3><?=GetMessage("SS_TITLE")?></h3>

	<div class="icons">
		<?
		if (is_array($arResult["SOCSERV"]) && !empty($arResult["SOCSERV"]))
		{
		?>
			<?foreach($arResult["SOCSERV"] as $socserv):?>	
				<a href="<?=htmlspecialcharsbx($socserv["LINK"])?>" class="<?=htmlspecialcharsbx($socserv["CLASS"])?>"></a>
			<?endforeach?>
		<?
		}
		?>
	</div>
	
	


