<?php
/**
 * @var StoreElement $this
 * @var string $source
 * @var string $errorSource
 * @var string $title
 * @var bool $canSameAsPrev
 * @var bool $needPhone
 * @var bool $limitToAvailableCountries
 **/
?>
<h3 style="margin-bottom: 20px;"><?php
	echo $title;
	if (isset($canSameAsPrev) && $canSameAsPrev): ?>
		<div class="checkbox" style="display: inline-block; font-size: 14px; font-weight: normal; margin: 0px 0px 0px 20px; vertical-align: middle;"data-ng-class="{'has-error': main.billingInfoErrors.email}"><label>
			<input type="checkbox" class="wb-store-use-save-cb"
				   style="margin-top: 2px;"
				   data-ng-change="main.changeInfoField('hideDeliveryInfo', main.billingInfoErrors); main.changeInfoField('country', main.billingInfoErrors); main.changeInfoField('region', main.billingInfoErrors);"
				   data-ng-model="main.hideDeliveryInfo"/>
			<?php echo $this->__('Same as billing information'); ?>
		</label></div><?php
	endif;
?></h3>
<div class="alert alert-danger" data-ng-if="<?php echo $errorSource; ?> && !<?php echo $errorSource; ?>.__isEmpty">
	<button type="button" class="close" data-ng-click="<?php echo $errorSource; ?> = null">&times;</button>
	<div data-ng-repeat="error in <?php echo $errorSource; ?>">{{error}}</div>
</div>
<div style="overflow-x: hidden;">
	<input type="hidden" name="billing-info" value="1"/>
	<div class="wb-store-billing-info-form"<?php if (isset($canSameAsPrev) && $canSameAsPrev): ?> data-ng-hide="main.hideDeliveryInfo"<?php endif; ?>>
		<div class="form-group" data-ng-class="{'has-error': <?php echo $errorSource; ?>.email}">
			<label class="control-label"><?php echo $this->__('Email'); ?></label>
			<input type="text" class="form-control" name="email"
				   data-ng-change="main.changeInfoField('email', <?php echo $errorSource; ?>)"
				   data-ng-model="<?php echo $source; ?>.email"/>
		</div>
		<?php if (isset($needPhone) && $needPhone): ?>
		<div class="form-group" data-ng-class="{'has-error': <?php echo $errorSource; ?>.phone}">
			<label class="control-label"><?php echo $this->__('Phone Number'); ?></label>
			<input type="text" class="form-control" name="phone"
				   data-ng-change="main.changeInfoField('phone', <?php echo $errorSource; ?>)"
				   data-ng-model="<?php echo $source; ?>.phone"/>
		</div>
		<?php endif; ?>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group" data-ng-class="{'has-error': <?php echo $errorSource; ?>.firstName}">
					<label class="control-label"><?php echo $this->__('First Name'); ?></label>
					<input type="text" class="form-control" name="firstName"
						   data-ng-change="main.changeInfoField('firstName', <?php echo $errorSource; ?>)"
						   data-ng-model="<?php echo $source; ?>.firstName"/>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group" data-ng-class="{'has-error': <?php echo $errorSource; ?>.lastName}">
					<label class="control-label"><?php echo $this->__('Last Name'); ?></label>
					<input type="text" class="form-control" name="lastName"
						   data-ng-change="main.changeInfoField('lastName', <?php echo $errorSource; ?>)"
						   data-ng-model="<?php echo $source; ?>.lastName"/>
				</div>
			</div>
		</div>
		<div class="form-group" data-ng-class="{'has-error': <?php echo $errorSource; ?>.address1}">
			<label class="control-label"><?php echo $this->__('Address'); ?></label>
			<input type="text" class="form-control" name="address1"
				   data-ng-change="main.changeInfoField('address1', <?php echo $errorSource; ?>)"
				   data-ng-model="<?php echo $source; ?>.address1"/>
		</div>
		<div class="row">
			<div class="col-sm-8">
				<div class="form-group" data-ng-class="{'has-error': <?php echo $errorSource; ?>.city}">
					<label class="control-label"><?php echo $this->__('City'); ?></label>
					<input type="text" class="form-control" name="city"
						   data-ng-change="main.changeInfoField('city', <?php echo $errorSource; ?>)"
						   data-ng-model="<?php echo $source; ?>.city"/>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="form-group" data-ng-class="{'has-error': <?php echo $errorSource; ?>.postCode}">
					<label class="control-label"><?php echo $this->__('Post Code'); ?></label>
					<input type="text" class="form-control" name="postCode"
						   data-ng-change="main.changeInfoField('postCode', <?php echo $errorSource; ?>)"
						   data-ng-model="<?php echo $source; ?>.postCode"/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group" data-ng-class="{'has-error': <?php echo $errorSource; ?>.country}">
					<label class="control-label"><?php echo $this->__('Country'); ?></label>
					<select class="form-control" name="country"
							data-ng-if="main.data.countries.length"
							data-ng-change="main.changeInfoField('country', <?php echo $errorSource; ?>)"
							data-ng-model="<?php echo $source; ?>.countryCode"
							data-ng-options="country.code as country.name for country in main.data.countries<?php if( $limitToAvailableCountries ) { ?> | filter:filterAllowedCountries<?php } ?>"
					>
					</select>
					<input type="text" class="form-control" data-ng-model="<?php echo $source; ?>.country" data-ng-if="!main.data.countries.length"/>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group" data-ng-class="{'has-error': <?php echo $errorSource; ?>.region}">
					<label class="control-label" data-ng-hide="<?php echo $source; ?>.countryCode === 'US'"><?php echo $this->__('Region'); ?></label>
					<label class="control-label" data-ng-show="<?php echo $source; ?>.countryCode === 'US'"><?php echo $this->__('State / Province'); ?></label>
					<select class="form-control" name="region"
							data-ng-if="main.getCountry(<?php echo $source; ?>.countryCode).regions.length"
							data-ng-change="main.changeInfoField('region', <?php echo $errorSource; ?>)"
							data-ng-model="<?php echo $source; ?>.region"
							data-ng-options="region.name as region.name for region in main.getCountry(<?php echo $source; ?>.countryCode).regions<?php if( $limitToAvailableCountries ) { ?> | filter:filterAllowedRegions(<?php echo $source; ?>.countryCode)<?php } ?>"
					>
					</select>
					<input type="text" class="form-control" name="region"
						   data-ng-if="!main.getCountry(<?php echo $source; ?>.countryCode).regions.length"
						   data-ng-change="main.changeInfoField('region', <?php echo $errorSource; ?>)"
						   data-ng-model="<?php echo $source; ?>.region"/>
				</div>
			</div>
		</div>
	</div>
</div>
