<?php
/*
Plugin Name: A Woocommerce categories slider
Description: A Woocommerce categories slider
Version: dev-0.1
Author: Silvano Emanuel Roqués
Author URI: http://lode.uno/tejne
*/

// don't call the file directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function wpwcacs_enqueue_script() {
    wp_enqueue_media();
    wp_register_script( 'wpwcacs-slider', plugin_dir_url( __FILE__ ) . 'wpwcacs-slider.js');
    wp_enqueue_script( 'wpwcacs-slider' );
}

add_action( 'wp_enqueue_scripts', 'wpwcacs_enqueue_script' );


function wpwcacs_shortcode( $atts = [], $content = null) {
	$categories = get_categories(
		array(
            'hide_empty' =>  0,
            'exclude'  =>  1,
            'taxonomy'   =>  'product_cat' 
		));
	$slider_menu="";
	$slider_content="";
	foreach( $categories as $index=>$category ) {
		//var_dump($category);
		if($category->count > 0){
			$slider_menu .= '<button style="margin:20px 10px;padding:20px;width:10em;" onclick="currentDiv('.($index).')">'.$category->cat_name.'</button>';
			$block_content = '<!-- wp:woocommerce/product-category {"categories":['.$category->cat_ID.'],"stockStatus":["","instock","onbackorder"]} /-->';
			$slider_content .= '<div class="catslide"';
			if($index>0){$slider_content .= ' style="display:none" ';}
			$slider_content .= '>'.do_blocks($block_content).'</div>';
		}
	}
	return '
		<div style="width:100%;">
			<div style="display: flex; flex-flow:row wrap; margin-bottom:10px">'.$slider_menu.'</div>
			<div>'.$slider_content.'</div>
		</div>';
}
add_shortcode('catslider', 'wpwcacs_shortcode');