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

<div class="container single-product" >
	<div class="row">
		<h1><?php	echo  get_post( $id )->post_title; ?></h1>
	</div>
</div>
<div classe="container">
	<div class ="row" id="product">
		<div class "row picture-hotel" id="im_produit">
		<?php  do_action( 'woocommerce_before_single_product_summary' ); // photo ?>
			<div class="col-md-offset-0 col-md-3 content-hotel">
				<h2>description</h2>
				<?php echo the_content(); ?>
			</div>
			<div class="col-md-offset-0 col-md-3 content-hotel">
				<h2>presentation </h2>
				<?php echo get_post_meta( $id, 'presentation', true); ?>
			</div>
			<div class="col-md-offset-2 col-md-7 content-hotel">
				<h2>telephone</h2>
				<?php echo get_post_meta( $id, 'telephone', true);?>
			</div>
			<div class="col-md-offset-2 col-md-7 content-hotel">
				<h2>situation geographique</h2>
				<?php echo get_post_meta( $id, 'situation', true); ?>
			<div class="col-md-offset-0 col-md-3 content-hotel">
				<h2>situation</h2>
				<?php echo get_post_meta( $id, 'situation', true);?>
			</div>
			<div class="col-md-offset-0 col-md-3 content-hotel">
				<h2>Telephone </h2>
				<?php echo get_post_meta( $id, 'telephone', true); ?>
			</div>
			<div class="col-md-offset-2 col-md-7 content-hotel">
				<h2>Capacite</h2>
				<?php echo get_post_meta( $id, 'capacite', true);?>
			</div>
			<div class="col-md-offset-2 col-md-7 content-hotel">
				<h2>Type d'etablissement</h2>
				<?php echo get_post_meta( $id, 'type', true);?>
			</div>
		</div>
	</div>
</div>
