<?php
/**
 * Plugin Name: Family Archives
 * Plugin URI: http://cv.joseguerrauk.com
 * Description: This plugin allows for basic genealogy profiles. You can create pages for family members and ancestors with facts, bio summaries and more.
 * Version: 1.1.0
 * Author: Jose Guerra
 * Author URI: http://cv.joseguerrauk.com
 * Copyright 2017 JoseGuerraUK
 */

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once ( plugin_dir_path(__FILE__) . 'ancestry-cpt.php' );
require_once ( plugin_dir_path(__FILE__) . 'ancestry-fields.php' );

/* Load general files in the admin */
function gcofa_admin_enqueue_scripts() {
	global $pagenow, $typenow;

	if ( $typenow == 'ancestry') {

		wp_enqueue_style( 'gcofa-admin-css', plugins_url( 'css/admin-ancestry.css', __FILE__ ) );

	}

	if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'ancestry' ) {
		
		wp_enqueue_script( 'gcofa-custom-quicktags', plugins_url( 'js/gcofa-quicktags.js', __FILE__ ), array( 'quicktags' ), '20170125', true );
		wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );

	}

}
add_action( 'admin_enqueue_scripts', 'gcofa_admin_enqueue_scripts' );


/* Custom Pedigree script for generating genealogy charts */
function gcofa_my_pedigree_scripts() {

	if ( !is_admin() ) {
		wp_enqueue_style( 'gcofa-my-pedigree-style', plugins_url( 'css/gcofa-ancestry.css', __FILE__ ) );
		wp_enqueue_script( 'gcofa-my-pedigree-script', plugins_url('js/emperor.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
	}
}

add_action( 'wp_enqueue_scripts', 'gcofa_my_pedigree_scripts' );

 

/* @Recreate the default filters on the_content so we can pull formated content with get_post_meta
-------------------------------------------------------------- */
    add_filter( 'meta_content', 'wptexturize'        );
    add_filter( 'meta_content', 'convert_smilies'    );
    add_filter( 'meta_content', 'convert_chars'      );
    add_filter( 'meta_content', 'wpautop'            );
    add_filter( 'meta_content', 'shortcode_unautop'  );
    add_filter( 'meta_content', 'prepend_attachment' );

