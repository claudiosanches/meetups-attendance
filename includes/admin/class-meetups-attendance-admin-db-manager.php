<?php
/**
 * Meetups Attendance Admin Manager class
 *
 * @package Meetups_Attendance/Classes/Admin/DB/Manager
 * @version 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Meetups Attendance Admin Manager.
 */
class Meetup_Attendance_Admin_DB_Manager {

	/**
	 * Get CSV data.
	 *
	 * @param  array $file
	 *
	 * @return array
	 */
	private static function get_csv_data( $file ) {
		$file_name       = $file['name'];
		$file_name_parts = explode( '.', $file_name );
		$file_ext        = strtolower( end( $file_name_parts ) );
		$file_size       = $file['size'];

		if ( 'csv' == $file_ext && $file_size < 500000 ) {
			$csv = array_map( 'str_getcsv', file( $file['tmp_name'] ) );
			array_walk( $csv, function ( &$value ) use ( $csv ) {
				$value = array_combine( $csv[0], $value );
			});
			array_shift( $csv ); // Remove column header.

			return $csv;
		}

		return array();
	}

	/**
	 * Save meetup data.
	 *
	 * @param  array $data
	 * @param  array $files
	 *
	 * @return stdObject
	 */
	public static function save_meetup_data( $data, $files ) {
		$response = new stdClass;
		$response->success = true;
		$response->message = __( 'Meetup saved successfully', 'meetups-attendance' );

		if ( ! isset( $files['meetup_attendance_csv'] ) || $files['meetup_attendance_csv']['error'] > 0 ) {
			$response->success = false;
			$response->message = __( 'An error has occurred while sending the .csv file!', 'meetups-attendance' );

			return $response;
		}

		$csv_data = self::get_csv_data( $files['meetup_attendance_csv'] );

		if ( empty( $csv_data ) ) {
			$response->success = false;
			$response->message = __( 'Invalid CSV file!', 'meetups-attendance' );

			return $response;
		}

	}

}
