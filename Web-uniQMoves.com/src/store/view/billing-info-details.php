<?php
/* @var $this StoreElement */
?>
<h3 style="margin-bottom: 20px;"><?php echo $title; ?></h3>
<div class="row">
	<div class="col-sm-6">
		<label><?php echo $this->__('Email'); ?>:</label> {{<?php echo $source; ?>.email}}<br/>
		<label><?php echo $this->__('Phone'); ?>:</label> {{<?php echo $source; ?>.phone}}<br/>
		<label><?php echo $this->__('First Name'); ?>:</label> {{<?php echo $source; ?>.firstName}}<br/>
		<label><?php echo $this->__('Last Name'); ?>:</label> {{<?php echo $source; ?>.lastName}}<br/>
		<label><?php echo $this->__('Address'); ?>:</label> {{<?php echo $source; ?>.address1}}<br/>
	</div>
	<div class="col-sm-6">
		<label><?php echo $this->__('City'); ?>:</label> {{<?php echo $source; ?>.city}}<br/>
		<label><?php echo $this->__('Post Code'); ?>:</label> {{<?php echo $source; ?>.postCode}}<br/>
		<label data-ng-hide="<?php echo $source; ?>.countryCode === 'US'"><?php echo $this->__('Region'); ?>:</label><label data-ng-show="<?php echo $source; ?>.countryCode === 'US'"><?php echo $this->__('State / Province'); ?>:</label> {{<?php echo $source; ?>.region}}<br/>
		<label><?php echo $this->__('Country'); ?>:</label> {{<?php echo $source; ?>.country}}<br/>
		<?php if (isset($needPhone) && $needPhone): ?>
		<label><?php echo $this->__('Phone'); ?>:</label> {{<?php echo $source; ?>.phone}}<br/>
		<?php endif; ?>
	</div>
</div>