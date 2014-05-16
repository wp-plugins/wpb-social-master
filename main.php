<?php
/**
Plugin Name: WPB Social Master
Plugin URI: http://demo.wpbean.com/wpb-social-master/
Description: Just install this plugin & put shortcode to enable Social Sharing on your WordPress site. This plugin is also compatible with WordPress multisite . You can choose different button background color, button text color, animation. To use this plugin just put a shortcode to your post or page or anywhere. Shortcode: For share [wpb-social-share text="Share"] & For follow [wpb-social-follow text="Follow me"] &nbsp;&nbsp;&nbsp;&nbsp; jQuery Plugin by: <a href="https://github.com/tolgaergin/social">Tolgaergin</a>. &nbsp;&nbsp;&nbsp;&nbsp; WordPress Settings API PHP Class by: <a href="https://github.com/tareq1988/wordpress-settings-api-class" >Wedevs</a>.
Author: wpbean
Version: 1.0
Author URI: http://wpbean.com
*/

//--------------- Adding Latest jQuery------------//
function wpb_ss_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'wpb_ss_jquery');


//-------------- include js files---------------//
function wpb_ss_adding_scripts() {
	wp_register_script('wpb_ss_socialProfiles_js', plugins_url('js/socialProfiles.min.js', __FILE__), array('jquery'),'1.10.2', true);
	wp_register_script('wpb_ss_socialShare_js', plugins_url('js/socialShare.min.js', __FILE__), array('jquery'),'1.10.2', true);
	wp_enqueue_script('wpb_ss_socialProfiles_js');
	wp_enqueue_script('wpb_ss_socialShare_js');
}
add_action( 'wp_enqueue_scripts', 'wpb_ss_adding_scripts' ); 


//------------ include css files-----------------//
function wpb_ss_adding_style() {
	wp_register_style('wpb_ss_arthref_style', plugins_url('css/arthref.min.css', __FILE__),'','1.10.2', false);
	wp_register_style('wpb_ss_main_style', plugins_url('css/main.css', __FILE__),'','1.0', false);
	wp_enqueue_style('wpb_ss_arthref_style');
	wp_enqueue_style('wpb_ss_main_style');
}
add_action( 'init', 'wpb_ss_adding_style' ); 


//--------- trigger setting api class---------------- //

function my_get_option( $option, $section, $default = '' ) {
 
    $options = get_option( $section );
 
    if ( isset( $options[$option] ) ) {
        return $options[$option];
    }
 
    return $default;
}


//--------- trigger the plugin---------------- //
function wpb_ss_trigger() {
?>
<script>
	jQuery(document).ready(function () {

		jQuery('.wpbshareSelector').socialShare({
			social: '<?php  $profiles = my_get_option( 'wpb_select_profile', 'wpb_profile', 'facebook,google,twitter' ); 
							$def = "facebook,google,twitter";
								if ($profiles !==  $def) {
									$comma_separated = implode(",", $profiles); 
									echo $comma_separated;
								}else{
									echo "facebook,google,twitter";
								}
					?>',
			whenSelect: false,
			selectContainer: '.wpbshareSelector',
			blur: <?php echo my_get_option( 'wpb_bg_blur_switich', 'wpb_style', 'true' );?>,
			animation: '<?php echo my_get_option( 'wpb_animation', 'wpb_style', 'launchpadReverse' );?>',
		});
		
		jQuery('.wpbfollowSelector').socialProfiles({
			animation: '<?php echo my_get_option( 'wpb_animation', 'wpb_style', 'launchpadReverse' );?>',
			blur: <?php echo my_get_option( 'wpb_bg_blur_switich', 'wpb_style', 'true' );?>,
			facebook: '<?php echo my_get_option( 'wpb_socail_master_fb', 'wpb_follow', '' );?>',
			google: '<?php echo my_get_option( 'wpb_socail_master_gplus', 'wpb_follow', '' );?>',
			twitter: '<?php echo my_get_option( 'wpb_socail_master_tw', 'wpb_follow', '' );?>',
			pinterest: '<?php echo my_get_option( 'wpb_socail_master_pin', 'wpb_follow', '' );?>',
			dribbble: '<?php echo my_get_option( 'wpb_socail_master_dri', 'wpb_follow', '' );?>',
			behance: '<?php echo my_get_option( 'wpb_socail_master_beh', 'wpb_follow', '' );?>',
			scoutzie: '<?php echo my_get_option( 'wpb_socail_master_Sco', 'wpb_follow', '' );?>',
			linkedin: '<?php echo my_get_option( 'wpb_socail_master_in', 'wpb_follow', '' );?>',
			email: '<?php echo my_get_option( 'wpb_socail_master_email', 'wpb_follow', '' );?>',
			youtube: '<?php echo my_get_option( 'wpb_socail_master_you', 'wpb_follow', '' );?>'
		});
	});
</script>
<?php
}
add_action('wp_footer','wpb_ss_trigger',999);


//--------- css for wpb shere---------------- //

function wpb_ss_plugin_style(){
?>
<style type="text/css">

	div.wpbshareSelector, div.wpbfollowSelector {
	white-space: normal;
	color: <?php echo my_get_option( 'wpb_btn_text_clor', 'wpb_style', '#fff' );?>;
	background-color: <?php echo my_get_option( 'wpb_btn_bg_clor', 'wpb_style', '#1abc9c' );?>;
	border: none;
	font-size: 15px;
	font-weight: normal;
	line-height: 1.4;
	border-radius: 4px;
	padding: 4px 30px;
	-webkit-font-smoothing: subpixel-antialiased;
	-webkit-transition: border .25s linear, color .25s linear, background-color .25s linear;
	transition: border .25s linear, color .25s linear, background-color .25s linear;
	display: inline-block;
	cursor: pointer;
	}
	div.wpbshareSelector:hover, div.wpbfollowSelector:hover {background: <?php echo my_get_option( 'wpb_btn_bg_hover_clor', 'wpb_style', '#16a085' );?>;}

</style>
<?php
}
add_action('wp_head','wpb_ss_plugin_style');


//--------- register short code for share ---------------- //

function  wpb_s_share_shortcode($atts){

extract(shortcode_atts(array(
      'text' => 'Share',
   ), $atts));

$return_string = '<div class="wpbshareSelector">'.$text.'</div> ';
return $return_string;
}
function wpb_s_share_register_shortcodes(){
   add_shortcode('wpb-social-share', 'wpb_s_share_shortcode');
}
add_action( 'init', 'wpb_s_share_register_shortcodes');


//--------- register short code for follow ---------------- //

function  wpb_s_follow_shortcode($atts){

extract(shortcode_atts(array(
      'text' => 'Follow US',
   ), $atts));

$return_string = '<div class="wpbfollowSelector">'.$text.'</div> ';
return $return_string;
}
function wpb_s_follow_register_shortcodes(){
   add_shortcode('wpb-social-follow', 'wpb_s_follow_shortcode');
}
add_action( 'init', 'wpb_s_follow_register_shortcodes');


//--------- settings framework install ---------------- //

require_once dirname( __FILE__ ) . '/wpb-settings.php';