<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
<header id="header" role="banner">

<!-- Bouton referencer salle -->

<a class="btn btn-warning btn-lg" href="#myModal2" data-toggle="modal">Referencer ma salle</a>
<div id="myModal2" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" type="button" data-dismiss="modal">x</button>
					<h4 class="modal-title">Referencer</h4>
			</div>
			<div class="modal-body">
				<p class="lead">Veuillez entrer les elements necessaires au referencement de votre salle</p>
				<form method="post" id="myForm">
					<div class="form-group">
						<label for="name">Nom:</label>
						<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="" required/>
					</div>
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" name="email" id="email" class="form-control" placeholder="Email" value="" required/>
					</div>
						<div class="form-group">
						<label for="comment">Description:</label>
						<textarea class="form-control" id="comment" name="comment" required></textarea>
					</div>
					<input type="submit" name="submit" class="btn btn-success btn-lg" value="submit">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel Form</button>
			</div>
		</div>
	</div>
</div>

<!-- Bouton connection -->

<a class="btn btn-warning btn-2 btn-lg" href="#myModal1" data-toggle="modal">Connexion</a>
<div id="myModal1" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Connection</h4>
            </div>
            <div class="modal-body">
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
                </div>
            </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<section id="branding">
<div id="site-title"><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; } ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a><?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } ?></div>
</section>
</header>
<div id="container">
