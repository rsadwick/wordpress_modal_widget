<!-- This file is used to markup the administration form of the widget. -->
<p>Customize Modals:</p>

<table>
    <?php

	$title = !empty($instance['title']) ? $instance['title'] : __('#7bd148', 'text_domain');
		?>
		
		<select name="colorpicker">
		  <option value="#7bd148">Green</option>
		  <option value="#5484ed">Bold blue</option>
		  <option value="#a4bdfc">Blue</option>
		  <option value="#46d6db">Turquoise</option>
		  <option value="#7ae7bf">Light green</option>
		  <option value="#51b749">Bold green</option>
		  <option value="#fbd75b">Yellow</option>
		  <option value="#ffb878">Orange</option>
		  <option value="#ff887c">Red</option>
		  <option value="#dc2127">Bold red</option>
		  <option value="#dbadff">Purple</option>
		  <option value="#e1e1e1">Gray</option>
		</select>
		<p>
		<label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
		<input class="widefat modal-color-box" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>
    
   
</table>

<script>
	jQuery( document ).ready(function() {
  		jQuery('select[name="colorpicker"]').simplecolorpicker({
  			picker: true
		}).on('change', function() {
			console.log('change')
		  jQuery('.modal-color-box').val(jQuery('select[name="colorpicker"]').val());
		});
		
		/*setTimeout(function() {
		    jQuery('select[name="colorpicker"]').simplecolorpicker('selectColor', jQuery('.modal-color-box').val());
		  }, 1000);*/
		
	});
</script>