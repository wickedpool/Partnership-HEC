<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="container">
<div id="product">
<div class "picture-hotel">
	<div class="row">
		<div classe="col-sm-12">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/salle-main.png" />
			</div>
		</div>
	</div>
		<div class="content-hotel-all">
		<div class="row row-single">
			<div class="col-sm-2 content-hotel">
				<h2>salle 1 </h2>
			</div>
			<div class="col-sm-5 content-hotel-content">
				<h2><?php	echo  get_post( $id )->post_title; ?></h2>
		</div>
	</div>
		<div class="row row-single">
			<div class="col-sm-2 content-hotel">
				<h2>presentation </h2>
			</div>
				<?php echo get_post_meta( $id, 'presentation', true); ?>
			</div>
		</div>
		<div class="row row-single">
			<div class="col-sm-2 content-hotel">
				<h2>telephone</h2>
			</div>
				<?php echo get_post_meta( $id, 'telephone', true);?>
			</div>
		</div>
		<div class="row row-single">
			<div class="col-sm-2 content-hotel">
				<h2>situation geographique</h2>
			</div>
				<div class="col-sm-5 content-hotel-content">
					<h2><?php echo get_post_meta( $id, 'situation', true); ?></h2>
			</div>
		</div>
		<div class="row row-single">
			<div class="col-md-offset-0 col-sm-2 content-hotel">
				<h2>Capacite</h2>
			</div>
				<div class="col-sm-5 content-hotel-content">
					<h2><?php echo get_post_meta( $id, 'capacite', true);?></h2>
			</div>
			</div>
		</div>
		<div class="row row-single">
			<div class="col-md-offset-0 col-md-6 content-hotel">
				<h2>Type d'etablissement</h2>
				<?php echo get_post_meta( $id, 'type', true);?>
			</div>
			<div class="col-md-offset-10 col-md-3 content-hotel">
				<a href="<?php echo WC()->cart->get_cart_url(); ?>"><img style="width:100px;" src="<?php echo get_stylesheet_directory_uri(); ?>/images/cart-img.png" /></a>
			</div>
		</div>
		</div>
	</div>
</div>
