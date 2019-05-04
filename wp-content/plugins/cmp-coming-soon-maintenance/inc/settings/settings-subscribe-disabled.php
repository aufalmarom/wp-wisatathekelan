<?php 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>

<div class="table-wrapper content wrapper-disabled closed" id="subscribe-section">
	<h3><?php _e('Subscribe Form', 'cmp-coming-soon-maintenance');?></h3>
	<table class="content">
	<tbody>
	<tr>
		<th>
			<fieldset>
				<legend class="screen-reader-text">
					<span><?php _e('Subscribe Form Options', 'cmp-coming-soon-maintenance');?></span>
				</legend>

				<p>
					<label title="Niteo Subscribe">
					 	<input disabled type="radio" name="niteoCS_subscribe_type" value="2">&nbsp;<?php _e('Niteo Subscribe', 'cmp-coming-soon-maintenance');?>
					</label>
				</p>

				<p>
					<label title="3rd Party Plugin">
					 	<input disabled type="radio" name="niteoCS_subscribe_type" value="1">&nbsp;<?php _e('3rd Party Plugin', 'cmp-coming-soon-maintenance');?>
					</label>
				</p>

				<p>
					<label title="Disabled">
					 	<input disabled type="radio" name="niteoCS_subscribe_type" value="0" checked="checked">&nbsp;<?php _e('Disabled', 'cmp-coming-soon-maintenance');?>
					</label>
				</p>

			</fieldset>
		</th>

		<td id="subscribe-disabled">
			<p><?php _e('Subscribe Form is disabled or is not supported by selected Theme.', 'cmp-coming-soon-maintenance');?></p>
		</td>

	</tbody>
	</table>
</div>