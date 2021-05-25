<?php if ($icon): ?>
<img src="<?php echo htmlspecialchars($icon); ?>"
	 alt="<?php echo htmlspecialchars($name); ?>"
	 title="<?php echo htmlspecialchars($name); ?>" />
<?php endif; ?>
<div>
	<?php if (!$icon): ?>
	<span style="margin-right: 4px;"><i class="store-cart-icon"></i></span>
	<?php endif; ?>
	<span><?php
		if ($name):
		?><span><?php echo $this->noPhp($name); ?></span><?php
		endif;
		?>&nbsp;<span class="store-cart-counter">(<?php echo $count; ?>)</span>
	</span>
</div>
<script type="text/javascript">
	$(function() { require(['store/js/StoreCartElement'], function(app) { app.init('<?php echo $elementId; ?>', '<?php echo $cartUrl; ?>'); }); });
</script>
