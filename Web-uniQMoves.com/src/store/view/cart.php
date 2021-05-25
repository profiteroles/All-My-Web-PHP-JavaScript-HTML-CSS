<?php
/* @var $this StoreBaseElement */
/* @var $items \Profis\SitePro\controller\StoreDataItem[] */
?>
<div class="wb-store-cart-details ng-cloak" style="overflow-x: hidden;" data-ng-controller="StoreCartCtrl">
	<div class="wb-store-controls">
		<div>
			<button class="wb-store-back btn btn-default" type="button"
					data-ng-click="main.goBack()"><span class="fa fa-chevron-left"></span>&nbsp;<?php echo $this->__('Back'); ?></button>
		</div>
	</div>
	<table class="wb-store-cart-table"
		   data-ng-show="main.flowStep === 0 || main.flowStep === 2 || main.flowStep === 3"
		   data-ng-style="{width: (main.data.items.length == 0) ? '100%' : null}">
		<thead>
			<tr data-ng-if="main.data.items.length > 0">
				<th style="width: 1%;">&nbsp;</th>
				<th>&nbsp;</th>
				<th style="width: 1%;"><?php echo $this->__('Qty'); ?></th>
				<th style="width: 1%;"><?php echo $this->__('Price'); ?></th>
				<th>&nbsp;</th>
			</tr>
			<tr data-ng-if="main.data.items.length === 0"><td colspan="5">&nbsp;</td></tr>
		</thead>
		<tbody>
			<tr class="wb-store-cart-empty" data-ng-if="main.data.items.length === 0">
				<td colspan="5"><?php echo $this->__('The cart is empty'); ?></td>
			</tr>
			<tr data-ng-repeat="item in main.data.items">
				<td class="wb-store-cart-table-img">
					<div data-ng-style="{'background-image': 'url(' + item.image + ')'}" />
				</td>
				<td class="wb-store-cart-table-name">
					{{item.name}}
					<span data-ng-if="item.priceStr">({{item.priceStr}})</span>
				</td>
				<td class="wb-store-cart-table-quantity">
					<input type="number" class="form-control"
						   data-ng-model="item.quantity"
						   data-ng-change="main.changeQuantity(item)"
						   data-ng-if="main.flowStep === 0" />
					<span data-ng-if="main.flowStep > 0">{{item.quantity}}</span>
				</td>
				<td class="wb-store-cart-table-price">{{item.totalPriceStr}}</td>
				<td class="wb-store-cart-table-remove">
					<span title="<?php echo htmlspecialchars($this->__('Remove')); ?>"
						  class="fa fa-trash-o"
						  data-ng-if="main.flowStep === 0"
						  data-ng-click="main.removeItem(item)"></span>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr data-ng-if="main.data.items.length > 0 && main.flowStep === 0 && !main.totals.subTotalPrice.eq(main.totals.totalPrice)">
				<th colspan="3" class="wb-store-cart-table-totals">&nbsp;<?php echo $this->__('Subtotal'); ?>:</th>
				<td class="wb-store-cart-sum">{{main.formatPrice(main.totals.subTotalPrice)}}</td>
				<td>&nbsp;</td>
			</tr>
			<tr data-ng-if="main.data.items.length > 0 && (main.flowStep === 0 || !main.data.billingShippingRequired)">
				<th colspan="3" class="wb-store-cart-table-totals">&nbsp;<?php echo $this->__('Total'); ?>:</th>
				<td class="wb-store-cart-sum">{{main.formatPrice(main.totals.totalPrice)}}</td>
				<td>&nbsp;</td>
			</tr>
			<tr data-ng-if="main.data.items.length === 0 || (main.flowStep > 0 && main.data.billingShippingRequired)"><td colspan="5">&nbsp;</td></tr>
		</tfoot>
	</table>
	<div data-ng-if="main.flowStep === 1 && main.data.billingShippingRequired">
		<div class="row-fluid">
			<div class="col-md-offset-3 col-md-6"><?php
				$this->renderView($this->viewPath.'/billing-info-form.php', array(
					'source' => 'main.data.billingInfo',
					'errorSource' => 'main.billingInfoErrors',
					'title' => $this->__('Billing Information'),
					'canSameAsPrev' => false,
					'needPhone' => StoreCartApi::PHONE_FIELD_VISIBLE && StoreCartApi::PHONE_FIELD_REQUIRED, // Phone field MUST be visible in billing info when it is required in shipping info
					'limitToAvailableCountries' => false,
				));
			?></div>
		</div>
		<div class="row-fluid">
			<div class="col-md-offset-3 col-md-6"><?php
				$this->renderView($this->viewPath.'/billing-info-form.php', array(
					'source' => 'main.data.deliveryInfo',
					'errorSource' => 'main.deliveryInfoErrors',
					'title' => $this->__('Delivery Information'),
					'canSameAsPrev' => true,
					'needPhone' => StoreCartApi::PHONE_FIELD_VISIBLE,
					'limitToAvailableCountries' => true,
				));
			?></div>
		</div>
		<div class="row-fluid">
			<div class="col-md-offset-3 col-md-6">
				<h3 style="margin-bottom: 20px;"><?php echo $this->__('Order Comments'); ?></h3>
				<textarea class="form-control"
						  style="height: 114px;"
						  data-ng-model="main.data.orderComment"></textarea>
			</div>
		</div>
	</div>
	<div data-ng-if="(main.flowStep === 2 || main.flowStep === 3) && main.data.billingShippingRequired">
		<div class="row-fluid">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-6"><?php
						$this->renderView($this->viewPath.'/billing-info-details.php', array(
							'title' => $this->__('Billing Information'),
							'source' => 'main.data.billingInfo',
							'needPhone' => false
						));
					?></div>
					<div class="col-md-6"><?php
						$this->renderView($this->viewPath.'/billing-info-details.php', array(
							'title' => $this->__('Delivery Information'),
							'source' => 'main.data.deliveryInfo',
							'needPhone' => true
						));
					?></div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h3 style="margin-bottom: 20px;"><?php echo $this->__('Order Comments'); ?></h3>
						<div>{{(main.data.orderComment !== '') ? main.data.orderComment : '—'}}</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<h3 style="margin-bottom: 20px;">{{(main.shippingMethods.length > 0) ? '<?php echo $this->__('Shipping Method'); ?>' : '&nbsp;'}}</h3>
				<div style="margin-bottom: 16px;"
					 data-ng-if="main.shippingMethods.length > 0 && main.flowStep === 2">
					<select class="form-control"
							data-ng-options="main.fmtSMN(item, '<?php echo $this->__('days'); ?>') for item in main.shippingMethods"
							data-ng-model="main.shippingMethod"
							data-ng-change="main.applyShipping()"></select>
				</div>
				<div data-ng-if="!main.totals.subTotalPrice.eq(main.totals.totalPrice)">
					<label><?php echo $this->__('Subtotal'); ?>:</label>&nbsp;{{main.formatPrice(main.totals.subTotalPrice)}}
				</div>
				<div data-ng-if="main.totals.taxPrice.gt(0)">
					<label><?php echo $this->__('Tax'); ?>:</label>&nbsp;{{main.formatPrice(main.totals.taxPrice)}}
				</div>
				<div data-ng-if="main.totals.shippingPrice.gt(0)">
					<label><?php echo $this->__('Shipping'); ?>:</label>&nbsp;{{main.formatPrice(main.totals.shippingPrice)}}
				</div>
				<div style="font-size: 24px;">
					<label><?php echo $this->__('Total'); ?>:</label>&nbsp;{{main.formatPrice(main.totals.totalPrice)}}
				</div>
			</div>
		</div>
	</div>
<?php if ($hasPaymentGateways || $hasForm): ?>
	<div class="text-center" style="padding-top: 20px; clear: both;" data-ng-if="main.data.items.length > 0 && main.flowStep < 3">
		<button class="btn btn-success btn-lg" type="button"
				data-ng-disabled="main.loading"
				data-ng-click="main.checkout()">
			{{(main.flowStep === 1 || main.flowStep === 2) ? '<?php echo $this->__('Next Step'); ?>' : '<?php echo $this->__('Checkout'); ?>'}}
		</button>
	</div>
<?php endif; ?>
<?php if (!$hasPaymentGateways && $hasForm): ?>
	<div class="wb-store-pay-btns" data-ng-show="main.flowStep === 3" data-payment-gateways="false" data-totals="main.totals">
		<?php if ($hasFormFile): ?>
			<?php if (empty($items)): ?> <div style="display: none;"> <?php endif; ?>
				<?php require $hasFormFile; ?>
			<?php if (empty($items)): ?> </div> <?php endif; ?>
		<?php endif; ?>
	</div>
<?php elseif ($hasPaymentGateways): ?>
	<div class="wb-store-pay-wrp" data-ng-if="main.flowStep === 3" data-payment-gateways="true">
		<div class="wb-store-pay-sep"></div>
		<h3 style="margin: 60px 0 0 0;"><?php echo $this->__('Choose Payment Method'); ?></h3>
		<?php $this->renderView($hasPaymentGatewaysFile, $hasPaymentGatewaysParams); ?>
	</div>
<?php endif; ?>
</div>
<script type="text/javascript">
	$(function() { require(['store/js/StoreCart'], function(app) { app.init('<?php echo $elementId; ?>', '<?php echo $cartUrl; ?>', <?php echo json_encode($storeData); ?>); }); });
</script>
