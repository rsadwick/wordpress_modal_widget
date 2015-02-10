<!-- This file is used to markup the administration form of the widget. -->
<h3>Customize Modals:</h3>

<div>
    <?php
        $title = !empty($instance['title']) ? $instance['title'] : __('#7bd148', 'text_domain');
        $opacity = !empty($instance['opacity']) ? $instance['opacity'] : __('0.9', 'text_domain');
    ?>
          <label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e('Background:'); ?></label> 
          
          <select name="colorpicker">
              <option value="#252525">GFC Gray</option>
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
          
          <hr/>
          <p>
           <label for="<?php echo $this -> get_field_id('opacity'); ?>"><?php _e('Opacity:'); ?></label> 
           <input size="3" id="<?php echo $this -> get_field_id('opacity'); ?>" name="<?php echo $this -> get_field_name('opacity'); ?>" type="text" value="<?php echo esc_attr($opacity); ?>"> 
          </p>
          
          <input class="modal-color-box" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="hidden" value="<?php echo esc_attr($title); ?>"> 
</div>

<script>
	jQuery( document ).ready(function() {
  		
  		//using eq because WP creates duplicates!  Why?  No idea.
  		var colorpicker = jQuery('select[name="colorpicker"]').eq(1);
  		var colorvalue =  jQuery('.modal-color-box').eq(1);
  		
  		colorpicker.simplecolorpicker({
  			
		}).on('change', function() {
			
		  colorvalue.val(colorpicker.val());
		});
		
		colorpicker.simplecolorpicker('selectColor', colorvalue.val());
		
	});
</script>