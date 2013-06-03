
<fieldset>
			<ul>
	
				<li>
					<label for="category_id"><?php echo lang('blog:category_label') ?></label>
					<div class="input">
					<?php echo form_dropdown('category_id', array(lang('blog:no_category_select_label')) + $options['categories']) ?>
					</div>
				</li>

	<li class="even">
		<label>Number to display</label>
		<?php echo form_input('limit', $options['limit']) ?>
	</li>

	</ul>
</fieldset>