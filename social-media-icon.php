<?php 
/**
 * Plugin Name:       Test Task Social Icons
 * Plugin URI:        https://example.com/plugins/test-task-social-icons/
 * Description:       Handle the basics Social Icons.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Hasnain Mehmood
 * Author URI:        https://author.example.com/
 * License:           V1
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-test-task-plugin
 * Domain Path:       /languages
 */




//Add frontend styles for Plugin
$pluginURL = plugins_url("",__FILE__);
$CSSURL = "$pluginURL/CSS/frontend-style.css";//change to your filename and path
wp_register_style( 'frontend_CSS', $CSSURL);
wp_enqueue_style('frontend_CSS');
wp_enqueue_style( 'plugin-cdn-fontawesome', $pluginURL. '/font-awesome-4.7.0/css/font-awesome.min.css' );

 function utm_user_scripts_backend_style() {
            $plugin_url = plugin_dir_url( __FILE__ );

        wp_enqueue_style( 'style',  $plugin_url . "/css/frontend-style.css");
        wp_enqueue_style( 'plugin-cdn-fontawesome', $plugin_url. '/font-awesome-4.7.0/css/font-awesome.min.css' );
    }

    add_action( 'admin_print_styles', 'utm_user_scripts_backend_style' );

/*
 * Register a custom menu page.
 */

function add_social_menu_item() {

	

    add_menu_page( 'Social Media Icons',
                   'Social Media Icons!',
			       'manage_options',
			       'social_media_test_icon',
			       'social_media_icon_function',
			       plugins_url( 'test-task-social-media-icon/images/social_icon.png' ),
			       6
    );
}
add_action( 'admin_menu', 'add_social_menu_item' );


function social_media_icon_function(){

    $si_icon_value1= get_option('si_icon_value1_option');
    $si_url1_value= get_option('si_url1_option');
    $si_icon_value2= get_option('si_icon_value2_option');
    $si_url2_value= get_option('si_url2_option');
    $si_icon_value3= get_option('si_icon_value3_option');
    $si_url3_value= get_option('si_url3_option');

  ?>
  
	
	 <form id="si_form" action="social-media-icon_submit" method="post">
	 	
          <div class="si_main_block">
          	
                    <p class="si_text">Social Icons:</p>

                    <ul class="si_main_list">

                      <li class="si_list_item">
                         <span class="si_icon">
                               <input type="text" name="si_icon_value" id="si_icon_value1" placeholder='Icon Value'
                               class="si_icon_value"  value='<?php if(!$si_icon_value1 == '') echo $si_icon_value1; ?>' />
                         </span>
                    	 <div class="si_url_block">
                    	 <input type="text" name="si_url" id="si_url1" 
                         placeholder='<?php if($si_url1_value == '') echo 'Start typing the URL...'; ?>'
                         class="si_url" 
                         value='<?php if(!$si_url1_value == '') echo $si_url1_value; ?>'
                         />
                    	 </div>
                     </li>
                     <li class="si_list_item">
                         <span class="si_icon">
                               <input type="text" name="si_icon_value" id="si_icon_value2" placeholder='Icon Value'
                               class="si_icon_value" value='<?php if(!$si_icon_value2 == '') echo $si_icon_value2; ?>' />
                         </span>
                    	 <div class="si_url_block">
                    	 <input type="text" name="si_url" id="si_url2"
                         placeholder='<?php if($si_url2_value == '') echo 'Start typing the URL...'; ?>'
                         class="si_url" 
                         value='<?php if(!$si_url2_value == '') echo $si_url2_value; ?>'
                          />
                    	 </div>
                     </li>
                     <li class="si_list_item">
                         <span class="si_icon">
                               <input type="text" name="si_icon_value" id="si_icon_value3" placeholder='Icon Value'
                               class="si_icon_value" value='<?php if(!$si_icon_value3 == '') echo $si_icon_value3; ?>' />
                         </span>
                    	 <div class="si_url_block">
                    	 <input type="text" name="si_url" id="si_url3" 
                         placeholder='<?php if($si_url3_value == '') echo 'Start typing the URL...'; ?>'
                         class="si_url" 
                         value='<?php if(!$si_url3_value == '') echo $si_url3_value; ?>'
                          />
                    	 </div>
                     </li>

                    </ul>

                    <div class="si_save_block">
                    	<input type="submit" name="si_save" id="si_save_btn" value="Save" class="si_save">
                    </div>

          </div>

	 </form>
       

          
<div class="Plugin_Info">
    <p> - > Use this [social_icons] Short Code in the editor where you want...!</p>
    <p> - > Hit the Url : https://fontawesome.com/v4.7.0/icons/  and pick the icon class code like "fa fa-facebook" and put it in icon value field.</p>
</div>
          

<?php
}



add_action( 'admin_footer', 'social_media_jquery' ); // Write our JS below here

function social_media_jquery() { ?>
	<script type="text/javascript" >
	jQuery(document).ready(function($) {

        jQuery('#si_form').submit(function(event) {
        	/* Act on the event */
            
            event.preventDefault();

            var si_icon_value1 = jQuery('#si_icon_value1').val();
            var si_url1 = jQuery('#si_url1').val();
            var si_icon_value2 = jQuery('#si_icon_value2').val();
            var si_url2 = jQuery('#si_url2').val();
            var si_icon_value3 = jQuery('#si_icon_value3').val();
            var si_url3 = jQuery('#si_url3').val();

        	//alert(si_url1+' > '+si_url2+' > '+si_url3);

		var data = {
			'action': 'si_action',
            'si_icon_value1': si_icon_value1,
			'si_url1': si_url1,
            'si_icon_value2': si_icon_value2,
			'si_url2': si_url2,
            'si_icon_value3': si_icon_value3,
			'si_url3': si_url3
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			alert(response);
		});
	});

 });
	</script> <?php
}


//si ajax action
add_action( 'wp_ajax_si_action', 'si_action' );

function si_action() {


    $si_icon_value1 = $_POST['si_icon_value1'];
	$si_url1 = $_POST['si_url1'];
    $si_icon_value2 = $_POST['si_icon_value2'];
	$si_url2 = $_POST['si_url2'];
    $si_icon_value3 = $_POST['si_icon_value3'];
	$si_url3 = $_POST['si_url3'];

	echo  "Saved...!";

    //add value in database
     
     if (!get_option( 'si_url1_option') && !get_option( 'si_url2_option') && !get_option( 'si_url3_option') && !get_option( 'si_icon_value1_option') && !get_option( 'si_icon_value2_option') && !get_option( 'si_icon_value3_option')) {
         
          add_option( 'si_icon_value1_option', $si_icon_value1);
          add_option( 'si_url1_option', $si_url1);
          add_option( 'si_icon_value2_option', $si_icon_value2);
          add_option( 'si_url2_option', $si_url2);
          add_option( 'si_icon_value3_option', $si_icon_value3);
          add_option( 'si_url3_option', $si_url3);
     }
    else{

         //update value in database

         update_option( 'si_icon_value1_option', $si_icon_value1);
         update_option( 'si_url1_option', $si_url1 );
         update_option( 'si_icon_value2_option', $si_icon_value2);
         update_option( 'si_url2_option', $si_url2 );
         update_option( 'si_icon_value3_option', $si_icon_value3);
         update_option( 'si_url3_option', $si_url3 );
    }



	wp_die();
}




function social_media_func(  ){

    $si_icon_value1= get_option('si_icon_value1_option'); 
    $si_url1_value= get_option('si_url1_option');
    $si_icon_value2= get_option('si_icon_value2_option'); 
    $si_url2_value= get_option('si_url2_option');
    $si_icon_value3= get_option('si_icon_value3_option'); 
    $si_url3_value= get_option('si_url3_option');

?>

    <div class="sm_icons_block">
      <ul>
          <li>
            <?php if($si_icon_value1) { ?>
              <a href="<?php echo $si_url1_value; ?>" title="<?php echo $si_url1_value; ?>" target="_blank">
                  
                     <i class="<?php echo $si_icon_value1; ?>"></i>

              </a>
          </li>
      <?php } ?>
      <?php if($si_icon_value2) { ?>
          <li>
              <a href="<?php echo $si_url2_value; ?>" title="<?php echo $si_url2_value; ?>" target="_blank">
                  
                     <i class="<?php echo $si_icon_value2; ?>"></i>

              </a>
          </li>
          <?php } ?>
          <?php if($si_icon_value3) { ?>
          <li>
              <a href="<?php echo $si_url3_value; ?>" title="<?php echo $si_url3_value; ?>" target="_blank">
                  
                     <i class="<?php echo $si_icon_value3; ?>"></i>

              </a>
          </li>
          <?php } ?>
      </ul>
    </div> 

<?php
}
add_shortcode( 'social_icons', 'social_media_func' );
