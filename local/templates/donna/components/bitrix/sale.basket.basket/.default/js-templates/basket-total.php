<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<div class="total" data-entity="basket-total-block">
		<?=GetMessage("SBB_TOTAL")?>
		<span class="total-n" data-entity="basket-total-price">{{{PRICE_FORMATED}}}</span>
	</div>
</script>
