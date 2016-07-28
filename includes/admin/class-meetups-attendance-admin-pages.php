<?php
/**
 * Meetups Attendance Admin Pages class
 *
 * @package Meetups_Attendance/Classes/Admin/Installer
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Meetups Attendance Admin Pages.
 */
class Meetup_Attendance_Admin_Pages {

	/**
	 * Init the admin pages actions.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'include_menus' ) );
	}

	/**
	 * Include menus.
	 */
	public function include_menus() {
		add_menu_page(
			__( 'Meetups Attendance', 'meetups-attendance' ),
			__( 'Meetups Attendance', 'meetups-attendance' ),
			'manage_options',
			'meetups-attendance',
			array( $this, 'main_page' ),
			'dashicons-clipboard',
			90
		);
	}

	/**
	 * Render the main page.
	 */
	public function main_page() {
		include dirname( __FILE__ ) . '/views/html-admin-page.php';
	}
}

new Meetup_Attendance_Admin_Pages;
