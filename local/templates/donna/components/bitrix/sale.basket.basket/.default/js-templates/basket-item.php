<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

?>
<script id="basket-item-template" type="text/html">
	<tr class="{{#SHOW_RESTORE}} basket-items-list-item-container-expend{{/SHOW_RESTORE}}"
		id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
		{{#SHOW_RESTORE}}
			<td class="basket-items-list-item-notification" colspan="<?=$restoreColSpan?>">
				<div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed" id="basket-item-height-aligner-{{ID}}">
					{{#SHOW_LOADING}}
						<div class="basket-items-list-item-overlay"></div>
					{{/SHOW_LOADING}}
					<div class="basket-items-list-item-removed-container">
						<div>
							<?=Loc::getMessage('SBB_GOOD_CAP')?> <strong>{{NAME}}</strong> <?=Loc::getMessage('SBB_BASKET_ITEM_DELETED')?>.
						</div>
						<div class="basket-items-list-item-removed-block">
							<a href="javascript:void(0)" data-entity="basket-item-restore-button">
								<?=Loc::getMessage('SBB_BASKET_ITEM_RESTORE')?>
							</a>
							<span class="basket-items-list-item-clear-btn" data-entity="basket-item-close-restore-button"></span>
						</div>
					</div>
				</div>
			</td>
		{{/SHOW_RESTORE}}
		{{^SHOW_RESTORE}}
			<td class="product-photo">
				<a href="{{DETAIL_PAGE_URL}}"><img src="{{IMAGE_URL}}"></a>
			</td>
			<td class="product-name">
				<h3><a href="{{DETAIL_PAGE_URL}}">{{NAME}}</a></h3>
				{{#PREVIEW_TEXT}}
					<p>{{{PREVIEW_TEXT}}}</p>
				{{/PREVIEW_TEXT}}
				{{#COLUMN_LIST}}
					<div class="art" data-entity="basket-item-property-value" data-property-code="{{CODE}}">
						{{NAME}}: {{VALUE}}
					</div>
				{{/COLUMN_LIST}}
			</td>
			<td class="cost-bag"><span class="property-name"><?=GetMessage("SBB_PRICE_NAME")?>:</span>{{{PRICE_FORMATED}}}</td>
			<td class="quantity-td" data-entity="basket-item-quantity-block">
				<div class="quantity">
					<div class="minus" data-entity="basket-item-quantity-minus">-</div>
					<input type="text" id="basket-item-quantity-{{ID}}" value="{{QUANTITY}}" data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field">
					<div class="plus" data-entity="basket-item-quantity-plus">+</div>
				</div>
			</td>
			<? if ($useSumColumn) : ?>
				<td class="sum-bag"><span class="property-name"><?=GetMessage("SBB_SUM_NAME")?>:</span>{{{SUM_FULL_PRICE_FORMATED}}}</td>
			<? endif; ?>

			<? if ($useActionColumn) : ?>
				<td class="del-td"><a class="delete" href="javascript:void(0)" data-entity="basket-item-delete">Удалить из корзины</a></td>
			<? endif; ?>
		{{/SHOW_RESTORE}}
	</tr>
</script>
