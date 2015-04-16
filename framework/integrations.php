<?php
add_action('wp_head','integratecodes');
add_action("admin_init", "procedures_metabox");

function integratecodes() {
?>
	<script>
    (function($) {	
		$(document).ready(function() {
			var offer = $('p.datetoday').html();
			var date = new Date().toDateString();
			var fday = date.split(" ")[0];
			var month = date.split(" ")[1];
			var day = date.split(" ")[2];
			var year = date.split(" ")[3];
			var newdate =  fday+', '+month+' '+day+', '+year;
			$('p.datetoday').html(offer+' '+newdate);
	
		});
    })(jQuery);
    </script>
<?php }

	function procedures_metabox(){
		add_meta_box("post-template-meta-container", __('Slider Options','dt_themes'), "procedures_sllider_settings", "procedures", "normal", "high");
		add_action('save_post','procedures_meta_save');
	}

	#Slider Meta Box for PROCEDURES
	function procedures_sllider_settings($args){	
		global $post; 
		$tpl_default_settings = get_post_meta($post->ID,'_dt_procedures_settings',TRUE);
		$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings  : array();?>

		<!-- Show Slider -->        
        <div class="custom-box">
        	<div class="column one-sixth">
                <label><?php _e('Show Slider','dt_themes');?> </label>
            </div>
            <div class="column four-sixth last">
				<?php $switchclass = array_key_exists("show_slider",$tpl_default_settings) ? 'checkbox-switch-on' :'checkbox-switch-off';
                      $checked = array_key_exists("show_slider",$tpl_default_settings) ? ' checked="checked"' : '';?>
                <div data-for="mytheme-show-slider" class="checkbox-switch <?php echo $switchclass;?>"></div>
                <input id="mytheme-show-slider" class="hidden" type="checkbox" name="mytheme-show-slider" value="true"  <?php echo $checked;?>/>
                <p class="note"> <?php _e('YES! to show slider on this page.','dt_themes');?> </p>
            </div>
        </div><!-- Show Slider End-->

        <!-- Slider Types -->
        <div class="custom-box">
        	<div class="column one-sixth">
                <label><?php _e('Choose Slider','dt_themes');?></label>
            </div>
            <div class="column four-sixth last">
	            <?php $slider_types = array( '' => __("Select",'dt_themes'),
											 'layerslider' => __("Layer Slider",'dt_themes'),
											 'revolutionslider' => __("Revolution Responsive",'dt_themes'));
											 
	 				  $v =  array_key_exists("slider_type",$tpl_default_settings) ?  $tpl_default_settings['slider_type'] : '';
					  
					  echo "<select class='slider-type' name='mytheme-slider-type'>";
					  foreach($slider_types as $key => $value):
					  	$rs = selected($key,$v,false);
						echo "<option value='{$key}' {$rs}>{$value}</option>";
					  endforeach;
	 				 echo "</select>";?>
            <p class="note"> <?php _e("Choose which slider you wish to use ( eg: Layer or Revolution )",'dt_themes');?> </p>
            </div>
        </div><!-- Slider Types End-->
        
        <!-- slier-container starts-->
    	<div id="slider-conainer">
        <?php $layerslider = $revolutionslider = 'style="display:none"';
			  if(isset($tpl_default_settings['slider_type'])&& $tpl_default_settings['slider_type'] == "layerslider"):
			  	$layerslider = 'style="display:block"';
			  elseif(isset($tpl_default_settings['slider_type'])&& $tpl_default_settings['slider_type'] == "revolutionslider"):
			  	$revolutionslider = 'style="display:block"';
			  endif;?>
              
          
              <!-- Layered Slider -->
              <div id="layerslider" class="custom-box" <?php echo $layerslider;?>>
              	<h3><?php _e('Layer Slider','dt_themes');?></h3>
                <?php if(dttheme_is_plugin_active('LayerSlider/layerslider.php')):?>
                <?php // Get WPDB Object
					  global $wpdb;
					  // Table name
					  $table_name = $wpdb->prefix . "layerslider";
					  // Get sliders
					  $sliders = $wpdb->get_results( "SELECT * FROM $table_name WHERE flag_hidden = '0' AND flag_deleted = '0'  ORDER BY date_c ASC LIMIT 100" );
					  
					  if($sliders != null && !empty($sliders)):
		 	                echo '<div class="one-half-content">';
							echo '	<div class="bpanel-option-set">';
							echo ' <div class="column one-sixth">';
                            echo '	<label>'.__('Select LayerSlider','dt_themes').'</label>';
							echo ' 	</div>';
							echo ' <div class="column two-sixth">';
                            echo '	<select name="layerslider_id">';
                            echo '		<option value="0">'.__("Select Slider",'dt_themes').'</option>';
									  	foreach($sliders as $item) :
											$name = empty($item->name) ? 'Unnamed' : $item->name;
											$id = $item->id;
											$rs = isset($tpl_default_settings['layerslider_id']) ? $tpl_default_settings['layerslider_id']:'';
											$rs = selected($id,$rs,false);
											echo "	<option value='{$id}' {$rs}>{$name}</option>";
										endforeach;
                            echo '	</select>';
                            echo '<p class="note">';
							_e("Choose Which LayerSlider you would like to use..",'dt_themes');
							echo "</p>";
							echo ' 	</div>';
							echo '	</div>';
                            echo '</div>';
					  else:
					     echo '<p id="j-no-images-container">'.__('Please add atleat one layer slider','dt_themes').'</p>';
					  endif;?>
                      
					<?php $layersliders = get_option('layerslider-slides');
                        if($layersliders):
                            $layersliders = is_array($layersliders) ? $layersliders : unserialize($layersliders);	
                            foreach($layersliders as $key => $val):
                                $layersliders_array[$key+1] = 'LayerSlider #'.($key+1);
                            endforeach;
                            echo '<div class="one-half-content">';
							echo '	<div class="bpanel-option-set">';
							echo ' <div class="column one-sixth">';
                            echo '	<label>'.__('Select LayerSlider','dt_themes').'</label>';
                            echo '</div>';
							echo ' <div class="column two-sixth">';
                            echo '	<select name="layerslider_id">';
                            echo '		<option value="0">'.__("Select Slider",'dt_themes').'</option>';
                            foreach($layersliders_array as $key => $value):
                                $rs = isset($tpl_default_settings['layerslider_id']) ? $tpl_default_settings['layerslider_id']:'';
                                $rs = selected($key,$rs,false);
                                echo "	<option value='{$key}' {$rs}>{$value}</option>";
                            endforeach;
                            echo '	</select>';
                            echo '<p class="note">';
							_e("Choose which LayerSlider would you like to use!",'dt_themes');
							echo "</p>";
                            echo '</div>';
							echo '	</div>';
                            echo '</div>';
                        endif;
					  else:?>
                      <p id="j-no-images-container"><?php _e('Please activate Layered Slider','dt_themes'); ?></p>
               <?php endif;?>         
                
              </div><!-- Layered Slider End-->

              <!-- Revolution Slider -->
              <div id="revolutionslider" class="custom-box" <?php echo $revolutionslider;?>>
	            <h3><?php _e('Revolution Slider','dt_themes');?></h3>
                <?php $return = dttheme_check_slider_revolution_responsive_wordpress_plugin();
					  if($return):
                        echo '<div class="one-half-content">';
						echo '	<div class="bpanel-option-set">';
						echo ' <div class="column one-sixth">';
						echo '	<label>'.__('Select Slider','dt_themes').'</label>';
						echo '</div>';
						echo ' <div class="column three-sixth">';
						echo '	<select name="revolutionslider_id">';
						echo '		<option value="0">'.__("Select Slider",'dt_themes').'</option>';
						foreach($return as $key => $value):
							$rs = isset($tpl_default_settings['revolutionslider_id']) ? $tpl_default_settings['revolutionslider_id']:'';
							$rs = selected($key,$rs,false);
							echo "	<option value='{$key}' {$rs}>{$value}</option>";
						endforeach;
						echo '</select>';
						echo '<p class="note">';
						_e("Choose which Revolution slider would you like to use!",'dt_themes');
						echo "</p>";
						echo '</div>';
						echo '	</div>';
						echo '</div>';
                	  else: ?>
	                	<p id="j-no-images-container"><?php _e('Please activate Revolution Slider , and add at least one slider.','dt_themes'); ?></p>
                <?php endif;?>
              </div><!-- Revolution Slider End-->
        </div><!-- slier-container ends-->
<?php  wp_reset_postdata();
	}
		
	function procedures_meta_save($post_id){
		global $pagenow;
		if ( 'post.php' != $pagenow ) return $post_id;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 	return $post_id;
		
		$settings = array();
		$settings['layout'] = isset($_POST['layout']) ? $_POST['layout'] : "";
		$settings['disable-comment'] = isset( $_POST['post-comment'] ) ? $_POST['post-comment'] : "";
		$settings['disable-everywhere-sidebar'] = isset($_POST['disable-everywhere-sidebar']) ? $_POST['disable-everywhere-sidebar'] : "";
		$settings['disable-featured-image'] = isset($_POST['post-featured-image']) ? $_POST['post-featured-image'] : "";
		$settings['disable-author-info']	= isset($_POST['disable-author-info']) ? $_POST['disable-author-info'] : "";
		$settings['disable-date-info']	= isset($_POST['disable-date-info']) ? $_POST['disable-date-info'] : "";
		$settings['disable-comment-info']	= isset($_POST['disable-comment-info']) ? $_POST['disable-comment-info'] : "";
		$settings['disable-category-info']	= isset($_POST['disable-category-info'])?$_POST['disable-category-info']: "";
		$settings['disable-tag-info']	= isset($_POST['disable-tag-info']) ? $_POST['disable-tag-info'] : "";

		$settings['show_slider'] =  $_POST['mytheme-show-slider'];
		$settings['slider_type'] = $_POST['mytheme-slider-type'];
		$settings['layerslider_id'] = $_POST['layerslider_id'];
		$settings['revolutionslider_id'] = $_POST['revolutionslider_id'];
		
		update_post_meta($post_id, "_dt_procedures_settings", array_filter($settings));
		
	}

/* CALL FUNCTION FOR SLIDER */
function procedure_slider_out($post_id) {
	$tpl_default_settings = get_post_meta($post_id, '_dt_procedures_settings', TRUE);
	$tpl_default_settings = is_array($tpl_default_settings) ? $tpl_default_settings : array();

	if (array_key_exists('show_slider', $tpl_default_settings) && array_key_exists('slider_type', $tpl_default_settings)) :

		echo '<!-- **Slider Section** -->';
		echo '<section id="slider" class="procedure-slider">';
		if ($tpl_default_settings['slider_type'] === "layerslider") :
			$id = isset( $tpl_default_settings['layerslider_id'])? $tpl_default_settings['layerslider_id'] : "";
			$slider = !empty($id) ? do_shortcode("[layerslider id='{$id}']") : "";
			echo $slider;
			
		elseif ($tpl_default_settings['slider_type'] === "revolutionslider") :
			$id = isset($tpl_default_settings['revolutionslider_id']) ? $tpl_default_settings['revolutionslider_id'] : "";
			$slider = !empty($id) ? do_shortcode("[rev_slider $id]") : "";
			echo $slider;
			
		endif;

		echo '</section><!-- **Slider Section - End** -->';
	endif;
}

?>