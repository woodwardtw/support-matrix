<?php 
//from https://darkog.com/blog/bulk-csv-import-programmatically-in-wordpress/
/**
 * Class Users_Import_Batch
 *
 * Import users from CSV with the following structure:
 * first_name, last_name, email, ip
 */
class Users_Import_Batch {

	/**
	 * Unique identifier of each batch
	 * @var string
	 */
	public $id = 'users_import_4';

	/**
	 * Describe the batch
	 * @var string
	 */
	public $title = 'Users Import';

	/**
	 * Define a way to obtain the data from the csv.
	 * You need to populate the $items array.
	 *
	 * @return void
	 */
	public function setup($csv_path) {

		// Define the CSV Path
		//$csv_path = get_template_directory() . '/users.csv'; //we are doing this via acf

		// Add the CSV data in the processing queue
		$rows   = array_map( 'str_getcsv', file( $csv_path ) );

		// Loop over the data and add every row to the queue
		foreach ( $rows as $row ) {
			$row_data = array(
				'first_name' => $row[0], // First name
				'last_name'  => $row[1], // Last name
				'email'      => $row[2], // Email
			);
			$unique_id  = md5( $row[2] );
			//$this->push( new WP_Batch_Item( $unique_id, $row_data ) );
		}
	}

	/***
	 * Define the import procedure for single item
	 *
	 * Return
	 * - TRUE - If the item was processed successfully.
	 * - WP_Error instance - If there was an error.
	 *
	 * @param WP_Batch_Item $item
	 *
	 * @return bool|\WP_Error
	 */
	public function process( $item ) {

		// Retrieve the custom data
		$user_firstname = $item->get_value( 'first_name' );
		$user_lastname  = $item->get_value( 'last_name' );
		$user_email     = $item->get_value( 'email' );

		// Bail if invalid data provided.
		if ( ! filter_var( $user_email, FILTER_VALIDATE_EMAIL ) ) {
			return new WP_Error( 302, "Invalid email provided" );
		}

		// Bail if no name is provided.
		if ( empty( $user_firstname ) || empty( $user_lastname ) ) {
			return new WP_Error( 302, "No name provided" );
		}

		// Bail if the email is used already
		if ( email_exists( $user_email ) ) {
			return new WP_Error( 302, 'Email ' . $user_email . ' already exist.' );
		}

		// Generate username
		$user_login = $this->generate_username( $user_email );

		// Setup the basic data
		$data = array(
			'user_login' => $user_login,
			'user_email' => $user_email,
			'first_name' => $user_firstname,
			'last_name'  => $user_lastname,
			'user_pass'  => wp_generate_password(),
		);

		// Try to insert the user
		$imported_user_id = wp_insert_user( $data );
		if ( is_wp_error( $imported_user_id ) ) {
			return $imported_user_id; // Bail if WP_Error is returned.
		}

		// 2.) Send welcome email
		//wp_mail( $user_email, 'Welcome!', 'Howdy ' . $user_firstname . ', Welcome to the client portal.' );

		return true;
	}

	/**
	 * Generates unused username
	 *
	 * @param $email
	 *
	 * @return string|string[]|null
	 */
	private function generate_username( $email ) {
		// Generate unused username
		$tries      = 0;
		$user_login = '';
		while ( true ) {
			$user_login = preg_replace( '/@.*?$/', '', $email );
			if ( $tries > 0 ) {
				$user_login .= $tries;
			}
			if ( ! username_exists( $user_login ) ) {
				break;
			} elseif ( $tries > 100 ) { // Stop if no free username.
				break;
			} else {
				$tries ++;
			}
		}
		// Generate random username if the above procedure didn't succeeded.
		if ( empty( $user_login ) ) {
			$user_login = 'user_' . time();
		}

		return $user_login;
	}
}
