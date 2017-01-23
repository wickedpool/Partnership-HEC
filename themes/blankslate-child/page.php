
<div id="wrapperr">
<!-- Sidebar -->
<div id="sidebar-wrapper">
<ul class="sidebar-nav">
<?php get_sidebar(); ?>
</ul>
</div>
<a href="#menu-toggle" id="menu-toggle"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/search-closed.png" /> </a>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<div class="main-content">
<div class="pagecontent">
<div id="page-content-wrapper">
<?php get_header(); ?>
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<section id="content" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<section class="entry-content">
<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
<?php the_content(); ?>
<?php wp_login_form( $args ); 
$args = array(
		'echo'           => true,
		'remember'       => true,
		'redirect'       => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
		'form_id'        => 'loginform',
		'id_username'    => 'user_login',
		'id_password'    => 'user_pass',
		'id_remember'    => 'rememberme',
		'id_submit'      => 'wp-submit',
		'label_username' => __( 'Username' ),
		'label_password' => __( 'Password' ),
		'label_remember' => __( 'Remember Me' ),
		'label_log_in'   => __( 'Log In' ),
		'value_username' => '',
		'value_remember' => false
		);
?>
<div class="entry-links"><?php wp_link_pages(); ?></div>
</section>
</article>
<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
<?php endwhile; endif; ?>
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

<!-- /#page-content-wrapper -->
</div>
<!-- Menu Toggle Script -->
<script>
$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapperr").toggleClass("toggled");
		});
</script>
