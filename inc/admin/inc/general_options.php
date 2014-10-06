<table class="form-table">
	<tr valign="top">
		<th scope="row">
			<label for="websolsn_legal_page">
				<?php _e('Legal Information:',LANGUAGE_ZONE)?>
			</label>
		</th>
		<td>
			<input type="text" name="websolsn_legal_page" id="websolsn_legal_page" value="<?php echo get_option('websolsn_legal_page')?get_option('websolsn_legal_page'):''?>"/>
			<p class="description">
				<?php _e('Link to Legal information',LANGUAGE_ZONE)?>
			</p>
		</td>
	</tr>
	<tr valign="top">
		<th scope="row">
			<label for="websolsn_copyright">
				<?php _e('Copyright:',LANGUAGE_ZONE)?>
			</label>
		</th>
		<td>
			<input type="text" name="websolsn_copyright" id="websolsn_copyright" value="<?php echo get_option('websolsn_copyright')?get_option('websolsn_copyright'):'Copyright @ Websolns'?>"/>
			<p class="description">
				<?php _e('Link to Copyright information',LANGUAGE_ZONE)?>
			</p>
		</td>
	</tr>
</table>
 <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes',LANGUAGE_ZONE) ?>" />
 </p>