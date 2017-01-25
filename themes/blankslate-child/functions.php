<?php
function wpm_enqueue_styles(){
	wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/css/style.css' );
	wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri(). '/bootstrap/css/bootstrap.min.css');
	wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri(). '/scripts/jquery.js');
	wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri(). '/bootstrap/js/bootstrap.min.js');
	wp_enqueue_script('perso-js', get_stylesheet_directory_uri(). '/scripts/scripts.js');
}
add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles');
?>
<?php
if( !defined(THEME_IMG_PATH)){
	define( 'THEME_IMG_PATH', get_stylesheet_directory_uri() . '/images/equipements/' );
}
?>
<?php
add_filter( 'query_vars', 'willy_add_query_vars' );
function willy_add_query_vars( $vars ){
	$vars[] = "ville";
	$vars[] = "chambres";
	$vars[] = "quartiers";
	$vars[] = "prix-maxi";
	$vars[] = "equipements";
	return $vars;
}
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
function msk_remove_additionalinfo_tab($tabs) {
	unset($tabs['additional_information']);
	$tabs['description']['title'] = __('Details', 'msk');
	$tabs['reviews']['title'] = __( 'Clients reviews', 'msk' );

	$tabs['description']['priority'] = 50;
	return $tabs;
}
add_filter('woocommerce_product_tabs', 'msk_remove_additionalinfo_tab', 10);

/*************************************************************************************************
 * On ajoute 2 champs (post meta ou custom field) aux produits WC dans l'onglet "Avancé"

 *************************************************************************************************/

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

/*************************************************************************************
 * REAL ONE
 * **********************************************************************************/

function msk_add_test_field_data() {
	echo '<div style="background:#f8fbca; padding:1em;">';
	echo '<h4>Testons les différents types de champs</h4>';
	// presentation
	woocommerce_wp_text_input(
			array(
				'id' => 'presentation',
				'label' => __("Presentation de l'hotel", 'msk'),
				'placeholder' => __(get_post_meta($product->id, 'presentation', true), 'msk'),
				'description' => __("Presenation de l'hotel", 'msk'),
				'desc_tip' => false // Si "true", la description s'affichera en infobulle
				)
			);
	woocommerce_wp_text_input(
			array(
				'id' => 'telephone',
				'data_type' => 'decimal',
				'label' => __('telephone', 'msk'),
				'placeholder' => __('Numero de telephone', 'msk'),
				'description' => __('Hatred this product has received.', 'msk'),
				'desc_tip' => true
				)
			);
	woocommerce_wp_text_input(
			array(
				'id' => 'situation',
				'label' => __("situation geographique", 'msk'),
				'placeholder' => __(get_post_meta($product->id, 'situation', true), 'msk'),
				'description' => __("situation geogrqphique de l'hotel", 'msk'),
				'desc_tip' => false // Si "true", la description s'affichera en infobulle
				)
			);
	woocommerce_wp_text_input(
			array(
				'id' => 'capacite',
				'data_type' => 'decimal',
				'label' => __('capacite', 'msk'),
				'placeholder' => __('capacite de la salle', 'msk'),
				'description' => __('Hatred this product has received.', 'msk'),
				'desc_tip' => true
				)
			);
	woocommerce_wp_radio(
			array(
				'id' => 'reponse',
				'label' => __('reponse de lhote avant', 'msk'),
				'options' => array( // Un tableau avec les options (value et nom) du radio
					'value4' => '24h',
					'value5' => '48h',
					'value6' => '72h',
					),
				'value' => 'value4', // La valeur enregistrée, choisie, de la radio
				)
			);
	echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', 'msk_add_test_field_data');
function msk_save_hotel_fields($product_id, $post, $update) {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if ($post->post_type == 'product') {
		if (isset($_POST['presentation'])) {
			$loves = $_POST['presentation'];
			update_post_meta($product_id, 'presentation', $loves);
		}
		if (isset($_POST['situation'])) {
			$hates = $_POST['situation'];
			update_post_meta($product_id, 'situation', $hates);
		}
		if (isset($_POST['telephone'])) {
			$hates = $_POST['telephone'];
			update_post_meta($product_id, 'telephone', $hates);
		}
		if (isset($_POST['capacite'])) {
			$hates = $_POST['capacite'];
			update_post_meta($product_id, 'capacite', $hates);
		}
		if (isset($_POST['reponse'])) {
			$hates = $_POST['reponse'];
			update_post_meta($product_id, 'reponse', $hates);
		}
	}
}
add_action('save_post', 'msk_save_hotel_fields', 10, 3);
?>
