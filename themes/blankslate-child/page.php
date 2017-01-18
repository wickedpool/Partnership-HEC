
		<div id="wrapperr">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
										<?php get_sidebar(); ?>
            </ul>
        </div>
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
														<div class="entry-links"><?php wp_link_pages(); ?></div>
														 <a href="#menu-toggle" class="btn btn-default hidden-md hidden-lg" id="menu-toggle">Toggle Menu</a>
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
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
