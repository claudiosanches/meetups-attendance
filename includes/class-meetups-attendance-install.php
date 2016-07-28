<?php
/**
 * Meetups Attendance Install class
 *
 * @package Meetups_Attendance/Classes/Installer
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Meetups Attendance Install.
 */
class Meetups_Attendance_Install {

	/**
	 * Create database.
	 */
	public static function create_database() {
		global $wpdb;

		$wpdb->hide_errors();

		$collate = '';

		if ( $wpdb->has_cap( 'collation' ) ) {
			$collate = $wpdb->get_charset_collate();
		}

		$tables = "
			CREATE TABLE {$wpdb->prefix}ma_users (
				ID bigint(20) NOT NULL auto_increment,
				user_id varchar(16) NOT NULL,
				name longtext NULL,
				url longtext NULL,
				PRIMARY KEY  (ID),
				KEY user_id (user_id)
			) $collate;
			CREATE TABLE {$wpdb->prefix}ma_meetups (
				ID bigint(20) NOT NULL auto_increment,
				meetup_id varchar(16) NOT NULL,
				name longtext NULL,
				url longtext NULL,
				date datetime NULL default null,
				PRIMARY KEY  (ID),
				KEY meetup_id (meetup_id)
			) $collate;
			CREATE TABLE {$wpdb->prefix}ma_attendances (
				ID bigint(20) NOT NULL auto_increment,
				user_id varchar(16) NOT NULL,
				meetup_id varchar(16) NOT NULL,
				went boolean NULL,
				PRIMARY KEY  (ID),
				KEY user_id (user_id),
				KEY meetup_id (meetup_id)
			) $collate;
		";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		dbDelta( $tables );
	}
}
