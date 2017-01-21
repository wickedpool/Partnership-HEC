<?php
function wpm_enqueue_styles(){
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri(). '/bootstrap/css/bootstrap.min.css');
wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri(). '/scripts/jquery.js');
wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri(). '/bootstrap/js/bootstrap.min.js');
wp_enqueue_script('perso-js', get_stylesheet_directory_uri(). '/scripts/scripts.js');
}
add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles');

function msk_add_love_product_tab($tabs) {
	
	$tabs['love_tab'] = array(
		'title' 	=> __('Popularity', 'msk'),
		'priority' 	=> 15,
		'callback' 	=> 'msk_add_love_product_tab_content'
	);

	return $tabs;

}
add_filter('woocommerce_product_tabs', 'msk_add_love_product_tab');

function msk_add_love_product_tab_content() {
	wc_get_template('single-product/tabs/love-product.php');
}

?>
