<?php
/**
 * Admin page.
 *
 * @package Meetups_Attendance/Admin/Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="wrap">
	<h1><?php esc_html_e( 'Meetups Attendance', 'meetups-attendance' ); ?></h1>

	<h2><?php esc_html_e( 'Register Meetup', 'meetups-attendance' ); ?></h2>
	<form method="post" enctype="multipart/form-data" action="#">
		<?php wp_nonce_field( 'ma_create_meetup', 'ma_create_meetup_nonce' ); ?>
		<p><?php esc_html_e( 'Register a new meetup attendance.', 'meetups-attendance' ); ?></p>

		<table class="form-table">
			<tr>
				<th scope="row">
					<label for="meetup_name"><?php esc_html_e( 'Meetup Name', 'meetups-attendance' ); ?></label>
				</th>
				<td>
					<input name="meetup_name" type="text" id="meetup_name" class="regular-text" required="required" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="meetup_date"><?php esc_html_e( 'Meetup Date', 'meetups-attendance' ); ?></label>
				</th>
				<td>
					<input name="meetup_date" type="date" id="meetup_date" class="regular-text" placeholder="YYYY/MM/DD" required="required" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="meetup_url"><?php esc_html_e( 'Meetup URL', 'meetups-attendance' ); ?></label>
				</th>
				<td>
					<input name="meetup_url" type="url" id="meetup_url" class="regular-text" required="required" />
				</td>
			</tr>
			<tr>
				<th scope="row">
					<label for="meetup_attendance_csv"><?php esc_html_e( 'Meetup Attendance CSV', 'meetups-attendance' ); ?></label>
				</th>
				<td>
					<input type="file" name="meetup_attendance_csv" id="meetup_attendance_csv" accept=".csv" required="required" />
				</td>
			</tr>
		</table>

		<input type="hidden" name="meetup_attendance_importer" value="true">

		<?php submit_button( __( 'Register', 'meetups-attendance' ) ); ?>
	</form>

</div>
