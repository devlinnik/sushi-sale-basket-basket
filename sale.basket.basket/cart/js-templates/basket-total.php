<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 */
?>
<script id="basket-total-template" type="text/html">
	<div class="basket-checkout-container" data-entity="basket-checkout-aligner">
		<?
		if ($arParams['HIDE_COUPON'] !== 'Y')
		{
			?>
			<div class="basket-coupon-section">
				<div class="basket-coupon-block-field">
							<input type="text" placeholder="<?= Loc::getMessage('SBB_COUPON_ENTER_MSGVER_1') ?>" class="form-control" id="" data-entity="basket-coupon-input">
							<span class=" basket-coupon-block-coupon-btn"></span>
				</div>
			</div>
			<?
		}
		?>
		<div class="basket-checkout-section">
		<div class="basket-checkout-block basket-checkout-block-total"><?= Loc::getMessage('SBB_TOTAL_MSGVER_1') ?>
						{{#DISCOUNT_PRICE_FORMATED}}
							<div class="basket-coupon-block-total-price-old">
								{{{PRICE_WITHOUT_DISCOUNT_FORMATED}}}
							</div>
						{{/DISCOUNT_PRICE_FORMATED}}

						<div class="basket-coupon-block-total-price-current" data-entity="basket-total-price">
							{{{PRICE_FORMATED}}}
						</div>

						{{#DISCOUNT_PRICE_FORMATED}}
							<div class="basket-coupon-block-total-price-difference">
								<?= Loc::getMessage(
									'SBB_BASKET_ITEM_ECONOMY_MSGVER_1',
									[
										'#DISCOUNT_PRICE_FORMATED#' => '<span style="white-space: nowrap;">{{{DISCOUNT_PRICE_FORMATED}}}</span>',
									],
								) ?>
							</div>
						{{/DISCOUNT_PRICE_FORMATED}}
		</div>
					<button class="btn basket-checkout-block-btn"
						data-entity="basket-checkout-button">
						<?=Loc::getMessage('SBB_ORDER')?>
					</button>
		</div>

		<?
		if ($arParams['HIDE_COUPON'] !== 'Y')
		{
		?>
			<div class="basket-coupon-alert-section">
				<div class="basket-coupon-alert-inner">
					{{#COUPON_LIST}}
					<div class="basket-coupon-alert text-{{CLASS}}">
						<span class="basket-coupon-text">
							<strong>{{COUPON}}</strong> - <?=Loc::getMessage('SBB_COUPON')?> {{JS_CHECK_CODE}}
							{{#DISCOUNT_NAME}}({{DISCOUNT_NAME}}){{/DISCOUNT_NAME}}
						</span>
						<span class="close-link" data-entity="basket-coupon-delete" data-coupon="{{COUPON}}">
							<?=Loc::getMessage('SBB_DELETE')?>
						</span>
					</div>
					{{/COUPON_LIST}}
				</div>
			</div>
			<?
		}
		?>
	</div>
</script>