<form id="search-form" class="form-style-8"  action="<?php echo home_url( '/' ); ?>">
  <p>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                    <input class="form-input" type="text" name="s" placeholder="Ville / Nom de lieu" value="<?php the_search_query(); ?>" id="s">
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                    <input class="form-group" type="text" placeholder="Date">
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <input type="number" name="nombreparticipants" placeholder="Nombre de Participants" min="0" value="<?php
              if ( isset( $_GET['nombreparticipants'] ) && $_GET['nombreparticipants'] ) {
                echo intval( $_GET['nombreparticipants'] );
              } ?>" id="nombreparticipants">
                <div class="help-block with-errors"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
              <input type="number" name="prix-maxi" placeholder="Prix maxi" min="0" value="<?php
            	if ( isset( $_GET['prix-maxi'] ) && $_GET['prix-maxi'] ) {
            		echo intval( $_GET['prix-maxi'] );
            	} ?>" id="prix-maxi">
            </div>
        </div>
    </div>
  </p>
  <?php
$equips = array(
	'ordinateur'  => __( 'Ordinateur' ),
	'imprimante'  => __( 'Imprimante' ),
	'wifi'  => __( 'Wifi' ),
	'television' => __( 'Télévision' ),
  'enceinte' => __( 'Enceinte' ),
  'microphone' => __( 'Microphone' ),
  'paperboard' => __( 'Paperboard' ),
  'tableau' => __( 'Tableau' ),
  'projecteur-ecran' => __( 'Projecteur' ),
  'photocopieuse' => __( 'P-copieuse' ),
  'regie-son' => __( 'son' ),
  'regie-lumiere' => __( 'lumière' ),
  'cafetariat' => __( 'Cafétariat' ),
  'cafe' => __( 'Café' ),
    );
    ?>
    <?php
        $num = 1;
        $breaker = 3; //How many cols inside a row?
        foreach ( $equips as $key => $equip ) {
            if ($num == 1) echo '<div class="row">'; //First col, so open the row.

                echo '<div class="col-xs-2"> <input type="checkbox" name="equipements[]" class="" '
                . 'id="equipment[' . $key . ']" value="' . $key . '"> <label for="equipment[' . $key . ']"><img src="';echo THEME_IMG_PATH. $key .'.png"/><br/><p class = "search-font">' . $equip . '</p></label></div>';
            $num++;
            if ($num > $breaker) { echo '</div>'; $num = 1; } // The num arrived at the break-point. Close the row!
        }
    ?>
  </div>
    <div class="row">
      <div class="col-xs-offset-2">
	<?php echo '<button class="search-confirm-button" type="submit"><img src="';
  echo THEME_IMG_PATH_BASIC.'Groupe_488.png "/></button>';
  ?>
</div>
</div>
</form>
