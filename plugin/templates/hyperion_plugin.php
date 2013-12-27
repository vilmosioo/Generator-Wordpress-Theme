<?php
/*
Plugin Name: <%= name %>
Plugin URI: TODO
Description: TODO 
Version: 0.0.1
Author: TODO
Author URI: TODO
Author Email: TODO
License: GPL2

	Copyright 2014 TODO  (email : TODO)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as 
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	
*/

// Define constants
define('<%= _(name).chain().underscored().value().toUpperCase() %>_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('<%= _(name).chain().underscored().value().toUpperCase() %>_PLUGIN_URL', plugin_dir_url(__FILE__));
define('<%= _(name).chain().underscored().value().toUpperCase() %>_PLUGIN_WORDPRESS_VERSION', get_bloginfo( 'version' ));

// Includes
// require_once(<%= _(name).chain().underscored().value().toUpperCase() %>_PLUGIN_DIR.'bower_components/wordpress-tools-.php');

class <%= _.camelize(name) %>_Plugin {
	
	static function init(){
		return new <%= _.camelize(name) %>_Plugin();
	}

	const ID = '<%= _(name).chain().underscored().value().toUpperCase() %>';

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	private function __construct() {
		register_activation_hook(__FILE__, array( &$this, 'activate' ) );
		register_deactivation_hook(__FILE__, array( &$this, 'deactivate' ) );
		
		// TODO write more functionality here
	} 

	/**
	 * Fired when the plugin is activated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	public function activate( $network_wide ) {

	} 

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @param	boolean	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	function deactivate( $network_wide ) {

	} 

} // end class

$GLOBALS['<%= _.camelize(name) %>_Plugin'] = <%= _.camelize(name) %>_Plugin::init();
?>