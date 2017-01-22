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

function msk_remove_additionalinfo_tab($tabs) {
	unset($tabs['additional_information']);
	$tabs['description']['title'] = __('Details', 'msk');
	$tabs['reviews']['title'] = __( 'Clients reviews', 'msk' );
	
	$tabs['description']['priority'] = 50;
	
	return $tabs;
}
add_filter('woocommerce_product_tabs', 'msk_remove_additionalinfo_tab', 10);

/*************************************************************************************************
* On ajoute des champs de test pour se repérer, dans l'onglet Général

function msk_add_test_field_data() {
	echo '<div style="background:#f8fbca; padding:1em;">';

	echo '<h4>Testons les différents types de champs</h4>';

	// Champ de type text
	woocommerce_wp_text_input(
		array(
			'id' => 'input_text', 
			'label' => __('Champ de type "text"', 'msk'),
			'placeholder' => __('Placeholder du champ text', 'msk'),
			'description' => __('La description peut apparaître dans une infobulle si "desc_tip" est sur "true".', 'msk'),
			'desc_tip' => true // Si "true", la description s'affichera en infobulle
		)
	);

	// Champ de type hidden
	woocommerce_wp_hidden_input(
		array(
			'id' => 'input_hidden', 
			'label' => __('Champ de type "hidden"', 'msk'),
			'value' => 'valeur-du-champ-hidden',
		)
	);

	// Champ de type textarea
	woocommerce_wp_textarea_input(
		array(
			'id' => 'input_textarea', 
			'label' => __('Champ de type "textarea"', 'msk'),
			'class' => 'widefat',
			'placeholder' => __('Placeholder du champ textarea', 'msk'),
			'description' => __('<br>La description n\'apparaîtra pas dans une infobulle si "desc_tip" est sur "false" ou inexistant.', 'msk'),
			'custom_attributes' => array( // Un tableau d'attributs personnalisés qui seront ajoutés au champ en question
				'data-test' => 50,
				'data-other-test' => 'Lorem ipsum'
			)
		)
	);

	// Champ de type checkbox
	woocommerce_wp_checkbox(
		array(
			'id' => 'input_checkbox', 
			'label' => __('Champ de type "checkbox"', 'msk'),
			'value' => 'yes', // La valeur enregistrée de la checkbox
			'cbvalue' => 'yes',  // La valeur de la checkbox en question. Si elle est la même que "value", la checkbox sera cochée
		)
	);

	// Champ de type select
	woocommerce_wp_select(
		array(
			'id' => 'input_select', 
			'label' => __('Champ de type "select"', 'msk'),
			'options' => array( // Un tableau avec les options (value et nom) du select
				'value1' => 'Am',
				'value2' => 'Stram',
				'value3' => 'Gram',
			),
			'value' => 'value2', // La valeur enregistrée, choisie, de la select
		)
	);

	// Champ de type radio
	woocommerce_wp_radio(
		array(
			'id' => 'input_radio', 
			'label' => __(' ', 'msk'),
			'options' => array( // Un tableau avec les options (value et nom) du radio
				'value4' => 'Pif',
				'value5' => 'Paf',
				'value6' => 'Pouf',
			),
			'value' => 'value5', // La valeur enregistrée, choisie, de la radio
		)
	);

	echo '</div>';
}
add_action('woocommerce_product_options_general_product_data', 'msk_add_test_field_data'); 

********************************************************************************************
*******************************************************************************************/

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
 }
}
add_action('save_post', 'msk_save_hotel_fields', 10, 3);

?>
