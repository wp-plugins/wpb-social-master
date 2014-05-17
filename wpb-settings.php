<?php
//--------- settings framework install ---------------- //

require_once dirname( __FILE__ ) . '/class.settings-api.php';

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
if ( !class_exists('WPB_Settings_API_Test' ) ):
class WPB_Settings_API_Test {

    private $settings_api;

    function __construct() {
        $this->settings_api = new WeDevs_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'WPB Social Master', 'WPB Social Master', 'delete_posts', 'wpb_social_master', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'wpb_profile',
                'title' => __( 'Share', 'wedevs' )
            ),
            array(
                'id' => 'wpb_follow',
                'title' => __( 'Follow', 'wedevs' )
            ),
            array(
                'id' => 'wpb_style',
                'title' => __( 'Style Settings', 'wpuf' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'wpb_profile' => array(
				array(
                    'name' => 'wpb_select_profile',
                    'label' => __( 'Select Your Sharing Profiles', 'wedevs' ),
                    'desc' => __( 'Choose you sharing profiles', 'wedevs' ),
                    'type' => 'multicheck',
                    'default' => array('google' => 'Google', 'twitter' => 'Twitter','facebook' => 'facebook',),
                    'options' => array(
                        'facebook' => 'Facebook',
                        'twitter' => 'Twitter',
                        'google' => 'Google',
                        'pinterest' => 'Pinterest',
                        'stumbleupon' => 'Stumbleupon',
                        'delicious' => 'Delicious',
                        'friendfeed' => 'Friendfeed',
                        'digg' => 'Digg',
                        'linkedin' => 'Linkedin'
                    )
                )
            ),
            'wpb_follow' => array(
				array(
                    'name' => 'wpb_socail_master_fb',
                    'label' => __( 'Facebook', 'wedevs' ),
                    'desc' => __( 'Put your Facebook username here.', 'wedevs' ),
                    'type' => 'text',
                    'default' => ''
                ),
				array(
                    'name' => 'wpb_socail_master_gplus',
                    'label' => __( 'Google Plus', 'wedevs' ),
                    'desc' => __( 'Put your Google plus user id here.', 'wedevs' ),
                    'type' => 'text',
                    'default' => ''
                ),
				array(
                    'name' => 'wpb_socail_master_tw',
                    'label' => __( 'Twitter', 'wedevs' ),
                    'desc' => __( 'Put your Twitter username here.', 'wedevs' ),
                    'type' => 'text',
                    'default' => ''
                ),
				array(
                    'name' => 'wpb_socail_master_pin',
                    'label' => __( 'Pinterest', 'wedevs' ),
                    'desc' => __( 'Put your Pinterest username here.', 'wedevs' ),
                    'type' => 'text',
                    'default' => ''
                ),
				array(
                    'name' => 'wpb_socail_master_dri',
                    'label' => __( 'Dribbble', 'wedevs' ),
                    'desc' => __( 'Put your Dribbble username here.', 'wedevs' ),
                    'type' => 'text',
                    'default' => ''
                ),
				array(
                    'name' => 'wpb_socail_master_beh',
                    'label' => __( 'Behance', 'wedevs' ),
                    'desc' => __( 'Put your Behance username here.', 'wedevs' ),
                    'type' => 'text',
                    'default' => ''
                ),
				array(
                    'name' => 'wpb_socail_master_Sco',
                    'label' => __( 'Scoutzie', 'wedevs' ),
                    'desc' => __( 'Put your Scoutzie username here.', 'wedevs' ),
                    'type' => 'text',
                    'default' => ''
                ),
				array(
                    'name' => 'wpb_socail_master_in',
                    'label' => __( 'Linkedin', 'wedevs' ),
                    'desc' => __( 'Put your Linkedin profile url here.', 'wedevs' ),
                    'type' => 'text',
                    'default' => ''
                ),
				array(
                    'name' => 'wpb_socail_master_email',
                    'label' => __( 'Email', 'wedevs' ),
                    'desc' => __( 'Put your email address here.', 'wedevs' ),
                    'type' => 'text',
                    'default' => ''
                ),
				array(
                    'name' => 'wpb_socail_master_you',
                    'label' => __( 'Youtube', 'wedevs' ),
                    'desc' => __( 'Put your Youtube username here.', 'wedevs' ),
                    'type' => 'text',
                    'default' => ''
                )
            ),
            'wpb_style' => array(
				array(
                    'name' => 'wpb_bg_blur_switich',
                    'label' => __( 'Background blur', 'wedevs' ),
                    'desc' => __( 'Makes blur images and texts (only works on Chrome).', 'wedevs' ),
                    'type' => 'radio',
					'default' => 'true',
                    'options' => array(
                        'true' => 'Yes',
                        'false' => 'No'
                    )
                ),
				array(
                    'name' => 'wpb_animation',
                    'label' => __( 'Select a animation ', 'wedevs' ),
                    'desc' => __( 'You can change animation of your social icons by selecting a animation.', 'wedevs' ),
                    'type' => 'select',
                    'options' => array(
                        'launchpad' => 'launchpad',
                        'launchpadReverse' => 'launchpadReverse',
                        'slideTop' => 'slideTop',
                        'slideRight' => 'slideRight',
                        'slideBottom' => 'slideBottom',
                        'slideBottom' => 'slideBottom',
                        'slideLeft' => 'slideLeft',
                        'chain' => 'chain'
                    )
                ),
				array(
                    'name' => 'wpb_btn_bg_clor',
                    'label' => __( 'Button Background Color', 'wedevs' ),
                    'desc' => __( 'Select a color for your buttons background color. Default #1abc9c', 'wedevs' ),
                    'type' => 'color',
                    'default' => '#1abc9c'
                ),
				array(
                    'name' => 'wpb_btn_bg_hover_clor',
                    'label' => __( 'Button Background Hover Color', 'wedevs' ),
                    'desc' => __( 'Select a color for your buttons background hover color. Default #16a085', 'wedevs' ),
                    'type' => 'color',
                    'default' => '#16a085'
                ),
				array(
                    'name' => 'wpb_btn_text_clor',
                    'label' => __( 'Button Text Color', 'wedevs' ),
                    'desc' => __( 'Select a color for your buttons text color. Default #ffffff', 'wedevs' ),
                    'type' => 'color',
                    'default' => '#ffffff'
                )
            )
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;

$settings = new WPB_Settings_API_Test();