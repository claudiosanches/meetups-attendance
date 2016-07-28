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

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_menus' ) );
	}

	public function add_menus() {
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

	public function main_page() {

	}
}

new Meetup_Attendance_Admin_Pages;