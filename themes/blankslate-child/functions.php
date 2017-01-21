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

function msk_add_loves_hates_fields_to_product() {
	woocommerce_wp_text_input(
		array(
			'id' => 'loves', 
			'data_type' => 'decimal', 
			'label' => __('Loves', 'msk'),
			'placeholder' => __('Amount of love', 'msk'),
			'description' => __('Love this product has received.', 'msk'),
			'desc_tip' => true
		)
	);

	woocommerce_wp_text_input(
		array(
			'id' => 'hates', 
			'data_type' => 'decimal', 
			'label' => __('Hates', 'msk'),
			'placeholder' => __('Amount of hate', 'msk'),
			'description' => __('Hatred this product has received.', 'msk'),
			'desc_tip' => true
		)
	);
}
add_action('woocommerce_product_options_advanced', 'msk_add_loves_hates_fields_to_product');

/*************************************************************************************************
* On enregistre les valeurs de LOVES & HATES lorsqu'on enregistre un post
*************************************************************************************************/
function msk_save_loves_hates_product_fields($product_id, $post, $update) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

	if ($post->post_type == 'product') {
		if (isset($_POST['loves'])) {
			$loves = (int)$_POST['loves'];
			update_post_meta($product_id, 'loves', $loves);
		}

		if (isset($_POST['hates'])) {
			$hates = (int)$_POST['hates'];
			update_post_meta($product_id, 'hates', $hates);
		}
	}
}
add_action('save_post', 'msk_save_loves_hates_product_fields', 10, 3);

?>
