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

<div class="subscribe-section">
<?
$frame = $this->createFrame("subscribe-form", false)->begin();
?>
	<!-- start form -->
	<form action="<?=$arResult["FORM_ACTION"]?>" method="post">			
		<fieldset>
			<div class="subscribe">
				<input type="text" name="subscribe-input" placeholder="<?=GetMessage("subscr_form_email_title")?>" value="<?=$arResult["EMAIL"]?>" />
				<input type="submit" name="submit" value="" />
			</div>					
		</fieldset>				
	</form>
	<!-- end of form -->

</div>
		
	
