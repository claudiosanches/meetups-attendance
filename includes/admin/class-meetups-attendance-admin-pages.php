<?php
/**
 * Meetups Attendance Admin Pages class
 *
 * @package Meetups_Attendance/Classes/Admin/Pages
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
		if ( isset( $_POST['meetup_attendance_importer'] ) && check_admin_referer( 'ma_create_meetup', 'ma_create_meetup_nonce' ) ) {
			$response = Meetup_Attendance_Admin_DB_Manager::save_meetup_data( $_POST, $_FILES );
			$classes  = $response->success ? 'notice notice-success' : 'notice notice-error';

			echo '<div class="' . $classes . '"><p>' . esc_html( $response->message ) . '</p></div>';
		}

		include dirname( __FILE__ ) . '/views/html-admin-page.php';
	}
}

new Meetup_Attendance_Admin_Pages;
