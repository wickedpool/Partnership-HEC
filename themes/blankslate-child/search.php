<?php get_header(); ?>
<div id="wrapperr">
<div id="sidebar-wrapper">
<ul class="sidebar-nav">
<?php get_sidebar(); ?>
</ul>
</div>
<a href="#menu-toggle" id="menu-toggle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/search-closed.png" /> </a>
<div class="main-content">
<div class="pagecontent">
<div id="page-content-wrapper">
<div class="container">
	<div class="row">
		<div style="position:relative;top:200px;">
<section id="content" role="main">
<?php if ( have_posts() ) : ?>
<header class="header">
<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'blankslate' ), get_search_query() ); ?></h1>
</header>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php $img_url = $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );?>
	<img style="width:500px;height:auto;" src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">
<?php endwhile; ?>
<?php get_template_part( 'nav', 'below' ); ?>
<?php else : ?>
<article id="post-0" class="post no-results not-found">
<header class="header">
<h2 class="entry-title"><?php _e( 'Nothing Found', 'blankslate' ); ?></h2>
</header>
<section class="entry-content">
<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'blankslate' ); ?></p>
<?php get_search_form(); ?>
</section>
</article>
<?php endif; ?>
</section>
</div>
</div>
</div>
</div>
</div>
<div class="foo">
<?php get_footer(); ?>
</div>
</div>
</div>
<script>
$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapperr").toggleClass("toggled");
		});
</script>
