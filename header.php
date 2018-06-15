

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> <?php wp_title(''); if(wp_title('', false)) {echo ' : ';} bloginfo( 'name' );  ?></title>
    <?php
    wp_head();

    ?>
  </head>
  <body <?php body_class();  ?>>
    <!-- Add Your HTML here -->
    <header class="encabezado-sitio container">

      <div class="row justify-content-md-between">
        <div class="col-lg-4">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri()  ?>/img/logo.svg" class="img-fluid mx-auto d-block" alt="">
          </a>
        </div>
        <div class="col-lg-4">

          <?php
            $args = array(
              'container' => 'nav' ,
              'container_class' => 'sociales text-center text-md-right pt-3',
              'link_before' => '<span class="sr-only"',
              'link_after' => '</span>',
              'theme_location' => 'social_menu'
             );
             wp_nav_menu($args);
          ?>

        </div>
      </div>
    </header>

    <div class="navegacion mt-3 py-1">
      <nav class="nav-principal navbar navbar-expand-md navbar-light bg-faded ">
            <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#nav_principal" aria-expanded="false" aria-label="Toggle Nav">
                    <span class="navbar-toggler-icon"></span>
            </button>
            <a href="#" class="navbar-brand d-lg-none">Spa-Site</a>
            <div class="container">

                    <?php
                      $args = array(
                        'menu_class' => 'nav nav-justified flex-column flex-sm-row' ,
                        'container_class' => 'collapse navbar-collapse',
                        'container_id' => 'nav_principal',
                        'theme_location' => 'main_menu'
                       );

                       wp_nav_menu( $args );
                    ?>
            </div>
        </nav>
      </div>
