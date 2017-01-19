<?php
function wpm_enqueue_styles(){
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri(). '/bootstrap/css/bootstrap.min.css');
wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri(). '/scripts/jquery.js');
wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri(). '/bootstrap/js/bootstrap.min.js');
}
add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles');

/* Shortcode bouton */
function bouton($atts, $content = null) {
 extract(shortcode_atts(array(
 'lien' => '#',
 'couleur' =>'bleu'
 ), $atts));
 return '<a class="bouton '.$couleur.'" href="'.$lien.'" target="_blank">' . do_shortcode($content) . '</a>';
}
add_shortcode('bouton', 'bouton');
add_action('admin_init', 'init_wysiwyg');

function init_wysiwyg() {
    wp_enqueue_script('editor');
    add_thickbox();
    wp_enqueue_script('media-upload');
    add_action('admin_print_footer_scripts', 'wp_tiny_mce', 25);
    wp_enqueue_script('quicktags');
}
