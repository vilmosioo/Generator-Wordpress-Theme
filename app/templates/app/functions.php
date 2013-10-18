<?php
require_once 'inc/Hyperion.php';<% if (templates.settings) { %>
require_once 'inc/Theme_Options.php';<% } if (templates.customPost) { %>
require_once 'inc/Custom_Post.php';<% } if (templates.widget) { %>
require_once 'inc/Custom_Widget.sample.php';<% } if (templates.metabox) { %>
require_once 'inc/Metabox.php';<% } %>

class <%= _.camelize(theme.name) %>Theme extends Hyperion{
	private $theme_options;
	
	/**
	* The class constructor, fired after setup theme event.
	* Will load all settings of the theme 
	*/
	function __construct(){	
		parent::__construct();

		// add actions and filters
		add_action( 'widgets_init', array( &$this, 'register_sidebars' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'add_scripts_and_styles') );  
		add_action( 'login_enqueue_scripts', array( &$this, 'login_styles'));
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_styles'));
		add_filter( 'admin_footer_text', array( &$this, 'remove_footer_admin'));
		
		// add image sizes
		add_image_size( 'single', 780, 500); 
		add_image_size( 'nivo', 1040, 300, true ); //(cropped)

		// final bits <% if (templates.customPost) { %>
		$this->register_post_types();<% } if (templates.metabox) { %>
		$this->create_metabox(); <% } if (templates.settings) { %>
		$this->theme_options();<% } if (templates.widget) { %>
		add_action( 'widgets_init', array( &$this, 'register_widget' ));<% } if (templates.shortcode) { %>
		add_shortcode('shortcode', array( &$this, 'some_shortcode' ));<% } %>
	}

	// Customise the footer in admin area
	function remove_footer_admin () {
		echo get_avatar('<%= author.email %>' , '40' );
		echo 'Theme designed and developed by <a href="<%= author.uri %>" target="_blank"><%= author.name %></a> and powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.';
	}
	
	// add custom admin styles
	function admin_styles() {
		wp_enqueue_style( 'hyperion-admin-css', THEME_PATH.'/css/wp-admin.css' );
	}

	// add custom login styles
	function login_styles() {
		wp_enqueue_style( 'hyperion-login-css', THEME_PATH.'/css/wp-login.css' );
	}

	// use this function to include conditional scripts and styles
	function add_scripts_and_styles(){
		// add any dependency libraries
		<% if (dependencies.modernizr) { %>
		wp_enqueue_script( 'hyperion-modernizr', THEME_PATH.'/js/vendor/modernizr/modernizr.js', array(), '2.6.2', true);
		<% } if (dependencies.fontAwesome) { %>
		wp_enqueue_style( 'hyperion-font-awesome', THEME_PATH.'/css/font-awesome.min.css'); 
		<% } %>
		if(is_front_page()){ 
			// add custom scripts/styles
		} 
		if(get_the_title() == 'Something' ) {
			// add custom scripts/styles
		}
	}
	<% if (templates.settings) { %>
	public function theme_options(){
		$this->theme_options = new Theme_Options();
		$this->theme_options->addTab(array(
			'name' => 'General',
			'slug' => 'general',
			'options' => array(
				'option1' => 'Option 1',
				'option2' => 'Option 2'
			)
		));

		$this->theme_options->addTab(array(
			'name' => 'Help',
			'slug' => 'help',
			'options' => array(
				'option3' => array(
					'name' => 'Option 3',
					'desc' => 'Some description'
				),
				'option4' => 'Option 4'
			)
		));
		$this->theme_options->render();
	}
	<% } if (templates.shortcode) { %>
	// create custom shortcodes
	function some_shortcode( $atts, $content = null ) {
		extract(shortcode_atts(array('attribute' => 'default_value'), $atts));
		return "<div $attribute>".do_shortcode($content)."</div>";
	}
	<% } if (templates.customPost) { %>
	// register post types
	function register_post_types(){
		Custom_Post::create(array('name' => 'Custom post'));
	}
	<% } if (templates.widget) { %>
	// create a custom widget
	function register_widget() {
		register_widget( 'Custom_Widget' );
	}
	<% } if (templates.metabox) { %>
	// create a metabox
	protected function create_metabox(){ 
		MetaBox::create(array(
			'fields' => array(
					array('name' => 'Test field', 'description' => 'Some description')
			)
		));
	}
	<% } %>
	/*
	* Register theme sidebars.
	*
	* Will register the main sidebar used for the blog,
	* the front page sidebar and the footer sidebar. 
	*/
	function register_sidebars(){
		if ( function_exists('register_sidebar') ) {
			register_sidebar(array(
				'name' => 'Main',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			));
			// register more sidebars...
		}
	}
}

// Initialize the above class after theme setup
add_action( 'after_setup_theme', create_function( '', 'global $theme; $theme = new <%= _.camelize(theme.name) %>Theme();' ) );

?>