<?php
/**
 * Plugin Name: Meetups Attendance
 * Plugin URI: http://github.com/claudiosmweb/meetups-attendance
 * Description: Register meetups attendance.
 * Author: Claudio Sanches
 * Author URI: https://claudiosmweb.com/
 * Version: 0.0.1
 * License: GPLv2 or later
 * Text Domain: meetups-attendance
 * Domain Path: languages/
 *
 * @package Meetups_Attendance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Meetups_Attendance' ) ) :

	/**
	 * Meetups Attendance main class.
	 */
	class Meetups_Attendance {

		/**
		 * Plugin version.
		 *
		 * @var string
		 */
		const VERSION = '0.0.1';

		/**
		 * Instance of this class.
		 *
		 * @var object
		 */
		protected static $instance = null;

		/**
		 * Initialize the plugin public actions.
		 */
		private function __construct() {
			// Load plugin text domain.
			add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

			if ( is_admin() ) {
				$this->admin_includes();
			}
		}

		/**
		 * Return an instance of this class.
		 *
		 * @return object A single instance of this class.
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Load the plugin text domain for translation.
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'meetups-attendance', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Admin includes.
		 */
		private function admin_includes() {
			include_once dirname( __FILE__ ) . '/includes/admin/class-meetups-attendance-admin-db-manager.php';
			include_once dirname( __FILE__ ) . '/includes/admin/class-meetups-attendance-admin-pages.php';
		}

	}

	add_action( 'plugins_loaded', array( 'Meetups_Attendance', 'get_instance' ) );

	include_once dirname( __FILE__ ) . '/includes/class-meetups-attendance-install.php';
	register_activation_hook( __FILE__, array( 'Meetups_Attendance_Install', 'create_database' ) );

endif;
