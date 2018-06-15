<?php
// add stylesheet and scripts
function spasite_styles(){
  // stylesheet
  wp_enqueue_style( 'fontawesome', get_template_directory_uri(). '/css/font-awesome.min.css', array(), '4.7.0' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri(). '/css/bootstrap.min.css', array(), '4.0.0' );
    wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Italianno|Lato:400,700,900|Raleway:400,700,900', array(), '1.0' );
  wp_enqueue_style( 'style', get_stylesheet_uri(), array('bootstrap'), '1.0' );
// scripts
wp_enqueue_script('jquery');
wp_enqueue_script('popper', get_template_directory_uri().'/js/popper.js', array('jquery'), '1.0', true);
wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), '4.0', true);
wp_enqueue_script('scripts', get_template_directory_uri().'/js/scripts.js', array('jquery'), '1.0', true);

}

add_action( 'wp_enqueue_scripts', 'spasite_styles' );

// setup theme

function spasite_setup(){
//featured image
add_theme_support( 'post-thumbnails' );

//update image size
update_option('thumbnail_size_w', 217);
update_option('thumbnail_size_h', 143);

// add images

add_image_size('products', 1140, 466, true);
add_image_size( 'product_thumb', 400, 266, true );
add_image_size( 'portrait', 350, 409, true );


  //register menus
  register_nav_menus( array(
      'main_menu' => esc_html__( 'Main Menu', 'spasite' ),
      'social_menu' => esc_html__( 'Social Menu', 'spasite' )
  ) );
}

add_action( 'after_setup_theme', 'spasite_setup' );

// add class nav-item to <li> main menu

function spasite_li_class($classes, $item, $args){
  if($args->theme_location == 'main_menu'){
    $classes[] = 'nav-item';
  }
  return $classes;
}

add_filter('nav_menu_css_class', 'spasite_li_class', 1, 3);

// add class nav-item to <a> main menu

function spasite_a_class($atts, $item, $args){
  if($args->theme_location == 'main_menu'){
    $class = 'class';
    $atts['class'] = 'nav-link';
  }
  return $atts;
}

add_filter('nav_menu_link_attributes', 'spasite_a_class', 10, 3);

// widgets

function spasite_widgets(){
  register_sidebar( array(
    'name' => 'Footer Widget 1' ,
    'id' => 'footer_widget_1' ,
    'before_widget' => '<div id="%1$s">' ,
    'after_widget' => '</div>',
    'before_title' => '<h3 class="text-uppercase text-center pb-4">',
    'after_title' => '</h3>'

   ));

   register_sidebar( array(
     'name' => 'Footer Widget 2' ,
     'id' => 'footer_widget_2' ,
     'before_widget' => '<div id="%1$s">' ,
     'after_widget' => '</div>',
     'before_title' => '<h3 class="text-uppercase text-center pb-4">',
     'after_title' => '</h3>'

    ));

    register_sidebar( array(
      'name' => 'Footer Widget 3' ,
      'id' => 'footer_widget_3' ,
      'before_widget' => '<div id="%1$s">' ,
      'after_widget' => '</div>',
      'before_title' => '<h3 class="text-uppercase text-center pb-4">',
      'after_title' => '</h3>'

     ));

     register_sidebar( array(
       'name' => 'Sidebar Widget 1' ,
       'id' => 'sidebar_widget_1' ,
       'before_widget' => '<div id="%1$s">' ,
       'after_widget' => '</div>',
       'before_title' => '<h2 class="text-uppercase text-center mt-4">',
       'after_title' => '</h2>'

      ));
}

add_action( 'widgets_init', 'spasite_widgets' );

//schedule widget

/**
 * Adds Foo_Widget widget.
 */
class Schedule_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'schedule_widget', // Base ID
			esc_html__( 'Schedule', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'schedule of aviablility', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		} ?>

    <?php $about = get_page_by_title( 'About us' ); ?>

    <p class="text-center mt-5 lead"><?php the_field('schedule_text', $about->ID); ?></p>

    <?php $schedule = get_field('schedule', $about->ID);
      if($schedule):

     ?>

    <table class="table table-hover text-center mt-5">
         <thead>
             <tr>
                <?php foreach ($schedule['header'] as $th) : ?>
                 <th class="text-center"><?php echo $th['c']; ?></th>
               <?php endforeach; ?>

             </tr>
         </thead>
         <tbody>
           <?php foreach ($schedule['body'] as $tr) : ?>
               <tr>
                  <?php foreach ($tr as $td) : ?>
                    <td><?php echo $td['c']; ?></td>
                  <?php endforeach; ?>
               </tr>
             <?php endforeach; ?>

         </tbody>
    </table>

    <?php
    endif;
    echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Schedule_Widget

// register Schedule_Widget widget
function spasite_schedule_widget() {
    register_widget( 'Schedule_Widget' );
}
add_action( 'widgets_init', 'spasite_schedule_widget' );

// custom post types

// Register Custom Post Type
function spasite_products() {

	$labels = array(
		'name'                  => _x( 'Products', 'Post Type General Name', 'spasite' ),
		'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'spasite' ),
		'menu_name'             => __( 'Products', 'spasite' ),
		'name_admin_bar'        => __( 'Product', 'spasite' ),
		'archives'              => __( 'Product Archives', 'spasite' ),
		'attributes'            => __( 'Product Attributes', 'spasite' ),
		'parent_item_colon'     => __( 'Parent Product:', 'spasite' ),
		'all_items'             => __( 'All Products', 'spasite' ),
		'add_new_item'          => __( 'Add New Product', 'spasite' ),
		'add_new'               => __( 'Add Product', 'spasite' ),
		'new_item'              => __( 'New Product', 'spasite' ),
		'edit_item'             => __( 'Edit Product', 'spasite' ),
		'update_item'           => __( 'Update Product', 'spasite' ),
		'view_item'             => __( 'View Product', 'spasite' ),
		'view_items'            => __( 'View Products', 'spasite' ),
		'search_items'          => __( 'Search Product', 'spasite' ),
		'not_found'             => __( 'Not found', 'spasite' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'spasite' ),
		'featured_image'        => __( 'Featured Image', 'spasite' ),
		'set_featured_image'    => __( 'Set featured image', 'spasite' ),
		'remove_featured_image' => __( 'Remove featured image', 'spasite' ),
		'use_featured_image'    => __( 'Use as featured image', 'spasite' ),
		'insert_into_item'      => __( 'Insert into Product', 'spasite' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Product', 'spasite' ),
		'items_list'            => __( 'Producta list', 'spasite' ),
		'items_list_navigation' => __( 'Products list navigation', 'spasite' ),
		'filter_items_list'     => __( 'Filter Products list', 'spasite' ),
	);
	$args = array(
		'label'                 => __( 'Product', 'spasite' ),
		'description'           => __( 'Products of the site', 'spasite' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => false,
	);
	register_post_type( 'our_products', $args );

}
add_action( 'init', 'spasite_products', 0 );

//shortcode for products
// Use this way: [spasite_products number=int]

function spasite_products_shortcode($products){
    $args = array(
      'post_per_page' => $products['number'],
      'post_type' => 'our_products',
      'orderby' => 'name',
      'order' => 'ASC',

    );

    $products = new WP_Query($args); ?>
    <div class="container productos pt-5">
      <div class="row">

  <?php  while($products->have_posts()): $products->the_post(); ?>

        <div class="col-6 col-md-3 mb-4 mb-md-0">
            <div class="card">
                      <a href="<?php the_permalink();?>">
                        <?php the_post_thumbnail( 'product_thumb', array('class' => 'card-img-top img-fluid') );?>
                            <div class="card-body">
                                <h3 class="card-title text-center text-uppercase">
                                  <?php the_title();?>
                                </h3>
                                <p class="card-text text-uppercase">
                                <?php the_field('short_description');?>
                                </p>
                                <p class="precio lead text-center mb-0">
                                  $ <?php the_field('price');?>

                                </p>
                            </div>
                      </a>
                  </div>
                </div>

  <?php  endwhile; wp_reset_postdata(); ?>

              </div>
          </div>

    <?php
}

add_shortcode( 'spasite_products', 'spasite_products_shortcode' );

//shortcode for products
// Use this way: [spasite_contact]

function spasite_contact_shortcode(){ ?>
            <form class="p-5 mt-5 formulario-contacto needs-validation" novalidate>
               <div class="form-group">
                   <label for="nombre">Name</label>
                   <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Your name" required>
                   <div class="invalid-feedback">
                    Message is mandatory
                 </div>
               </div>
               <div class="form-group">
                   <label for="email">Email</label>
                   <input type="email" class="form-control" id="email" name="email" placeholder="your Email" required>
                   <div class="invalid-feedback">
                    Message is mandatory
                 </div>
               </div>
               <div class="form-group">
                   <label for="mensaje">Message</label>
                   <textarea class="form-control" id="mensaje" name="mensaje" rows="6"></textarea>
               </div>
               <input type="submit" class="btn btn-primary text-uppercase" name="enviar" value="Enviar" required>
               <div class="invalid-feedback">
                Message is mandatory
             </div>
           </form>

<?php
}
add_shortcode( 'spasite_contact', 'spasite_contact_shortcode' );
