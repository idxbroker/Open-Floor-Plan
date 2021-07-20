<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Open Floor Plan', 'open-floor-plan' ) );
define( 'CHILD_THEME_URL', 'http://www.agentevolution.com/shop/open-floor-plan/' );
define( 'CHILD_THEME_VERSION', '1.0.11' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'open-floor-plan', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'open-floor-plan' ) );

//* Add Theme Support
add_theme_support( 'equity-top-header-bar' );
add_theme_support( 'equity-after-entry-widget-area' );

//* Add rectangular size image for featured posts/pages
add_image_size( 'featured-post', '700', '370', true);

//* Create additional color style options
add_theme_support( 'equity-style-selector', array(
	'open-floor-plan-green'  => __( 'Green', 'open-floor-plan' ),
	'open-floor-plan-red'    => __( 'Red', 'open-floor-plan' ),
	'open-floor-plan-tan'    => __( 'Tan', 'open-floor-plan' ),
	'open-floor-plan-grey'   => __( 'Grey', 'open-floor-plan' ),
	'open-floor-plan-custom' => __( 'Use Customizer', 'open-floor-plan' ),
) );

//* Load fonts 
add_filter( 'equity_google_fonts', 'open_floor_plan_fonts' );
function open_floor_plan_fonts( $equity_google_fonts ) {
	$equity_google_fonts = 'Lato:700|Open+Sans:400,700';
	return $equity_google_fonts;
}

// Add class to body for easy theme identification.
add_filter( 'body_class', 'add_theme_body_class' );
function add_theme_body_class( $classes ) {
	$classes[] = 'home-theme--open-floor-plan';
	return $classes;
}

//* Load backstretch.js
add_action( 'wp_enqueue_scripts', 'open_floor_plan_register_scripts' );
function open_floor_plan_register_scripts() {
	if ( is_home() ) {
		wp_enqueue_script( 'jquery-backstretch', get_stylesheet_directory_uri() . '/lib/js/jquery.backstretch.min.js', array('jquery'), '2.0.4', true);
	}

	//* Disable sticky header if checked in customizer
	if ( get_theme_mod('disable_sticky_header') == false && !wp_is_mobile() ) {
		wp_enqueue_script( 'sticky-header', get_stylesheet_directory_uri() . '/lib/js/sticky-header.js', array('jquery'), '1.0', true);
	}
}

//* Output backstretch call with custom or default image to wp_footer
add_action('wp_footer', 'open_floor_plan_backstretch_js', 9999);
function open_floor_plan_backstretch_js() {

	if( !is_home() )
		return;

	$background_url = get_theme_mod('default_background_image', get_stylesheet_directory_uri() . '/images/bkg-default.jpg' );
	?>
		<script>jQuery.backstretch("<?php echo $background_url; ?>");</script>
	<?php
}

/**
 * Filter header right menu args to limit depth and add custom walker
 * @param array $args arguments for building the nav menu
 */
add_filter( 'wp_nav_menu_args', 'equity_child_header_menu_args', 10, 1 );
function equity_child_header_menu_args( $args ) {

	if ( 'header-right' == $args['theme_location'] ) {
		$args['depth'] = 3;
		$args['walker'] = new Description_Plus_Icon_Walker;
	}

	return $args;
}

//* Remove default primary nav and add header right nav
add_theme_support( 'equity-menus', array( 'header-right' => __( 'Header Right', 'open-floor-plan' ) ) );

//* Add sticky header wrap markup
add_action( 'equity_before_header', 'open_floor_plan_sticky_header_open', 1 );
add_action( 'equity_after_header', 'open_floor_plan_sticky_header_close' );
function open_floor_plan_sticky_header_open() {
	echo '<div class="sticky-header">';
}
function open_floor_plan_sticky_header_close() {
	echo '</div><!-- end .sticky-header -->';
}

//* Filter footer widgets div classes
add_filter( 'equity_attr_footer-widgets', 'open_floor_plan_attributes_footer_widgets' );
function open_floor_plan_attributes_footer_widgets( $attributes ) {
	$attributes['class'] .= ' bg-alt';
	return $attributes;
}

//* Register widget areas
equity_register_widget_area(
	array(
		'id'          => 'home-top',
		'name'        => __( 'Home Top', 'open-floor-plan' ),
		'description' => __( 'This is the Top section of the Home page. Recommended to add the Soliloquy Slider.', 'open-floor-plan' ),
	)
);
equity_register_widget_area(
	array(
		'id'          => 'home-middle-1',
		'name'        => __( 'Home Middle 1', 'open-floor-plan' ),
		'description' => __( 'This is the first Middle section of the Home page. Recommended to add Equity - IDX Quick Search or WP Listings Search widget.', 'open-floor-plan' ),
	)
);
equity_register_widget_area(
	array(
		'id'          => 'home-middle-2',
		'name'        => __( 'Home Middle 2', 'open-floor-plan' ),
		'description' => __( 'This is the second Middle section of the Home page. Recommended to add Equity - IDX Property Showcase or WP Listings Featured Listings widget.', 'open-floor-plan' ),
	)
);
equity_register_widget_area(
	array(
		'id'          => 'home-middle-3',
		'name'        => __( 'Home Middle 3', 'open-floor-plan' ),
		'description' => __( 'This is the third Middle section of the Home page. Recommended to add a text widget and use shortcodes for calls to action.', 'open-floor-plan' ),
	)
);
equity_register_widget_area(
	array(
		'id'          => 'home-bottom-left',
		'name'        => __( 'Home Bottom Left', 'open-floor-plan' ),
		'description' => __( 'This is the Bottom left section of the Home page. Recommended to use the Equity - Featured Posts or other widget.', 'open-floor-plan' ),
	)
);
equity_register_widget_area(
	array(
		'id'          => 'home-bottom-right',
		'name'        => __( 'Home Bottom Right', 'open-floor-plan' ),
		'description' => __( 'This is the Bottom right section of the Home page. Recommended to use a custom menu or other widget.', 'open-floor-plan' ),
	)
);

//* Default widget content
if ( ! is_active_sidebar( 'top-header-left' ) ) {
	add_action('equity_top_header_left', 'top_header_left_default_widget');
}
function top_header_left_default_widget() {
	the_widget( 'WP_Widget_Text', array( 'text' => '[social_icons]') );
}
if ( ! is_active_sidebar( 'top-header-right' ) ) {
	add_action('equity_top_header_right', 'top_header_right_default_widget');
}
function top_header_right_default_widget() {
	the_widget( 'WP_Widget_Text', array( 'text' => '[agent_email] [agent_phone]') );
}

//* Home page - define home page widget areas for welcome screen display check
add_filter('equity_theme_widget_areas', 'open_floor_plan_home_widget_areas');
function open_floor_plan_home_widget_areas($active_widget_areas) {
	$active_widget_areas = array( 'home-top', 'home-bottom-left', 'home-bottom-right' );
	return $active_widget_areas;
}

//* Home page - markup and default widgets
function equity_child_home() {
	?>
	
	<div class="home-top">
		<div class="row">
			<div class="columns small-12">
			<?php
				if ( ! is_active_sidebar( 'home-top' ) ) {
					the_widget( 'WP_Widget_Text', array( 'title' => 'Slider', 'text' => 'Add the included Soliloqy Slider widget or any other slider plugin widget.'), array( 'before_widget' => '<aside class="widget-area">', 'after_widget' => '</aside>', 'before_title' => '<h4 class="widget-title">', 'after_title' => '</h4>' ) );
					
				} else {
					equity_widget_area( 'home-top' );
				}
			?>
			</div><!-- end .columns .small-12 -->
		</div><!-- .end .row -->
	</div><!-- end .home-top -->

	<div class="home-middle-1 bg-alt">
		<div class="row">
			<div class="columns small-12">
			<?php equity_widget_area( 'home-middle-1' ); ?>
			</div><!-- end .columns .small-12 -->
		</div><!-- .end .row -->
	</div><!-- end .home-middle-1 -->

	<div class="home-middle-2">
		<div class="row">
			<div class="columns small-12">
			<?php equity_widget_area( 'home-middle-2' ); ?>
			</div><!-- end .columns .small-12 -->
		</div><!-- .end .row -->
	</div><!-- end .home-middle-2 -->

	<div class="home-middle-3 bg-alt">
		<div class="row">
			<div class="columns small-12">
			<?php equity_widget_area( 'home-middle-3' ); ?>
			</div><!-- end .columns .small-12 -->
		</div><!-- .end .row -->
	</div><!-- end .home-middle-3 -->

	<div class="home-bottom">
		<div class="row">
			<?php equity_widget_area( 'home-bottom-left', array( 'before' => '<aside class="home-bottom-left widget-area columns small-12 medium-6 large-8">' ) ); ?>
			<?php equity_widget_area( 'home-bottom-right', array( 'before' => '<aside class="home-bottom-right widget-area columns small-12 medium-6 large-4">' ) ); ?>
		</div><!-- .end .row -->
	</div><!-- end .home-bottom -->

<?php
}

//* Includes

# Theme Customizatons
require_once get_stylesheet_directory() . '/lib/customizer.php';

# Recommended Plugins
require_once get_stylesheet_directory() . '/lib/plugins.php';