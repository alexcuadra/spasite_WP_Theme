<?php get_header(); ?>

<?php

while(have_posts()): the_post();

 ?>

<div class="container pt-4">
        <div class="row no-gutters">
            <div class="col-12 hero">

                <?php the_post_thumbnail( 'full', array('class' => 'img-fluid' ) ); ?>
                <h2 class="text-uppercase d-none d-md-block"><?php  the_title(); ?></h2>
            </div>
        </div>
    </div>



    <div class="container pt-4">
        <div class="row">
            <main class="col-lg-8 contenido-principal">
                <h2 class="d-block d-md-none text-uppercase text-center"><?php  the_title(); ?></h2>

                <div id="servicios" role="tablist" aria-multiselectable="true">
                  <div class="card">
                       <div class="card-header py-2" role="tab" id="servicio1">
                            <h3 class="mb-0">
                              <a class="btn btn-link"
                                      data-toggle="collapse"
                                      data-target="#descripcion1"
                                      aria-expanded="true"
                                      aria-controls="descripcion1">
                                <?php the_field('service_title_1'); ?>
                              </a>
                           </h3>
                       </div> <!--card-header-->

                       <div id="descripcion1"
                            class="collapse show"
                            aria-labelledby="servicio1"
                            data-parent="#servicios">

                            <div class="card-body">
                                 <p>  <?php the_field('service_description_1'); ?> </p>
                            </div>
                       </div> <!--#Description-->
                  </div> <!--.card-->

                  <div class="card">
                       <div class="card-header" id="servicio2">
                            <h3 class="mb-0">
                                 <a class="btn btn-link collapsed"
                                         data-toggle="collapse"
                                         data-target="#descripcion2"
                                         aria-expanded="false"
                                         aria-controls="descripcion2">
                                   <?php the_field('service_title_2'); ?>
                                </a>
                           </h3>
                       </div> <!--.card-header-->
                       <div id="descripcion2"
                            class="collapse"
                            aria-labelledby="servicio2"
                            data-parent="#servicios">

                            <div class="card-body">
                                  <p>  <?php the_field('service_description_2'); ?> </p>
                            </div>
                       </div> <!--#descripcion-->
                  </div><!--.card-->

                  <div class="card">
                       <div class="card-header" id="servicio3">
                            <h3 class="mb-0">
                                 <a class="btn btn-link collapsed"
                                         data-toggle="collapse"
                                         data-target="#descripcion3"
                                         aria-expanded="false"
                                         aria-controls="descripcion3">
                                   <?php the_field('service_title_3'); ?>
                                  </a>
                            </h3>
                       </div>
                       <div id="descripcion3"
                            class="collapse"
                            aria-labelledby="servicio3"
                            data-parent="#accordion">
                            <div class="card-body">

                              <p>  <?php the_field('service_description_3'); ?> </p>
                            </div>
                       </div>
                  </div> <!--.card-->
                </div> <!--#servicios-->


        <?php if(is_page( 'about' )):
                get_template_part( 'templates/gallery');
              endif;

           ?>


             </main>

             <?php get_sidebar(); ?>
          </div>
    </div>

  <?php endwhile; ?>
  <?php get_template_part( 'templates/dates' ); ?>
<?php get_footer(); ?>
