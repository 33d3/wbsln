		    <table class="form-table">
		   		<tr valign="top">
			        <th scope="row"><label for="websolns_phone"><?php _e('Phone Number',LANGUAGE_ZONE)?>:</label></th>
			        <td>
			        	  <input type="tel" id="websolns_tel" name="websolns_phone" value="<?php echo get_option('websolns_phone')?get_option('websolns_phone'):''?>">
			        	  <p class="description"><?php _e('Enter business phone number',LANGUAGE_ZONE)?></p>
			        </td>
		        </tr>  
		        
		        <tr valign="top">
			        <th scope="row"><label><?php _e('Address',LANGUAGE_ZONE)?>:</label></th>
			        <td>
			        	  <input type="text" name="websolns_address" value="<?php echo get_option('websolns_address')?get_option('websolns_address'):''?>">
			        	  <p class="description"><?php _e('Enter address here',LANGUAGE_ZONE)?></p>
			        </td>
		        </tr>  
		        
		        <tr valign="top">
			        <th scope="row"><label><?php _e('Notice',LANGUAGE_ZONE)?>:</label></th>
			        <td>
			        	  <label><input type="checkbox" name="websolns_notice_enable" <?php echo get_option('websolns_notice_enable')?'checked':''?>>Enable</label><br />
			        	  <input type="text" id="charcount_input" name="websolns_notice"  onkeyup="countChar(this)" value="<?php echo get_option('websolns_notice')?>"> <span id="charNum"></span>
			        	  <p class="description"><?php _e('Enter Advisory here (Replaces Business Hours)',LANGUAGE_ZONE)?> </p>
			        </td>
		        </tr>  
		        
		        <tr valign="top">
			        <th scope="row"><label><?php _e('Business Hours',LANGUAGE_ZONE)?>:</label></th>
			        <td>
			        
			        <?php $hours = json_decode(get_option('websolns_hours'))?>
			        
			        
			        
			        	  <input type="hidden" name="websolns_hours" value='<?php  echo get_option('websolns_hours')?>'>
			        	  
				        	  <table id="websolns_hours">
					        	  <tr>
					        	  	<th>Days:</th>
					        	  	<th>Open:</th>
					        	  	<th>Close:</th>
					        	  	<th></th>
					        	  </tr>
  
					        	  <tr>
					   			  	<td>Monday:</td>
						          	<td><input type="text" class="websolns_open" value="<?php echo $hours?$hours[0]->start:''?>" ></td>
						        	<td><input type="text" class="websolns_close" value="<?php echo $hours?$hours[0]->end:''?>" ></td>
						        	<td>
						        		<label>
						        			<input type="checkbox" class="websolns_closed" <?php echo $hours && $hours[0]->closed?'checked':''?>>
						        			Closed
						        		</label>	
						        	</td>
					        	  </tr>
					        	  
					        	  <tr>
					   			  	<td>Tuesday:</td>
						          	<td><input type="text" class="websolns_open" value="<?php echo $hours?$hours[1]->start:''?>" ></td>
						        	<td><input type="text" class="websolns_close" value="<?php echo $hours?$hours[1]->end:''?>" ></td>
						        	<td>
						        		<label>
						        			<input type="checkbox" class="websolns_closed" <?php echo $hours && $hours[1]->closed?'checked':''?>>
						        			Closed
						        		</label>	
						        	</td>
					        	  </tr>
					        	  
					        	  <tr>
					   			  	<td>Wednesday:</td>
						          	<td><input type="text" class="websolns_open" value="<?php echo $hours?$hours[2]->start:''?>" ></td>
						        	<td><input type="text" class="websolns_close" value="<?php echo $hours?$hours[2]->end:''?>" ></td>
						        	<td>
						        		<label>
						        			<input type="checkbox" class="websolns_closed" <?php echo $hours && $hours[2]->closed?'checked':''?>>
						        			Closed
						        		</label>	
						        	</td>
					        	  </tr>
					        	  
					        	  <tr>
					   			  	<td>Thrusday:</td>
						          	<td><input type="text" class="websolns_open" value="<?php echo $hours?$hours[3]->start:''?>" ></td>
						        	<td><input type="text" class="websolns_close" value="<?php echo $hours?$hours[3]->end:''?>" ></td>
						        	<td>
						        		<label>
						        			<input type="checkbox" class="websolns_closed" <?php echo $hours && $hours[3]->closed?'checked':''?>>
						        			Closed
						        		</label>	
						        	</td>
					        	  </tr>
					        	  
					        	  <tr>
					   			  	<td>Friday:</td>
						          	<td><input type="text" class="websolns_open" value="<?php echo $hours?$hours[4]->start:''?>" ></td>
						        	<td><input type="text" class="websolns_close" value="<?php echo $hours?$hours[4]->end:''?>" ></td>
						        	<td>
						        		<label>
						        			<input type="checkbox" class="websolns_closed" <?php echo $hours && $hours[4]->closed?'checked':''?>>
						        			Closed
						        		</label>	
						        	</td>
					        	  </tr>
					        	  
					        	  <tr>
					   			  	<td>Saturday:</td>
						          	<td><input type="text" class="websolns_open" value="<?php echo $hours?$hours[5]->start:''?>" ></td>
						        	<td><input type="text" class="websolns_close" value="<?php echo $hours?$hours[5]->end:''?>" ></td>
						        	<td>
						        		<label>
						        			<input type="checkbox" class="websolns_closed" <?php echo $hours && $hours[5]->closed?'checked':''?>>
						        			Closed
						        		</label>	
						        	</td>
					        	  </tr>
					        	  
					        	  <tr>
					   			  	<td>Sunday:</td>
						          	<td><input type="text" class="websolns_open" value="<?php echo $hours?$hours[6]->start:''?>" ></td>
						        	<td><input type="text" class="websolns_close" value="<?php echo $hours?$hours[6]->end:''?>" ></td>
						        	<td>
						        		<label>
						        			<input type="checkbox" class="websolns_closed" <?php echo $hours && $hours[6]->closed?'checked':''?>>
						        			Closed
						        		</label>	
						        	</td>
					        	  </tr>
				        	  
				        	  </table>
			        	  <p class="description"><?php _e('Enter business hours.',LANGUAGE_ZONE)?></p>
			        </td>
		        </tr> 

		    </table>
		 
		    <p class="submit">
		    <input type="submit" class="button-primary" value="<?php _e('Save Changes',LANGUAGE_ZONE) ?>" />
		    </p>
