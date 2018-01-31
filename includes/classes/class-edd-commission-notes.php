<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * The Commissions Notes Class
 *
 * @since  1.0.0
 */

class EDDC_Notes extends EDD_Commission {


    /**
	 * Commission Notes
	 *
	 * @since  1.0.0
	 */
	protected $notes;


	/**
	 * The raw notes values, for internal use only
	 *
	 * @since 1.0.0
	 */
	private $raw_notes = null;


    /**
	 * Get the parsed notes for a commission as an array
	 *
	 * @since  1.0.0
	 * @param  integer $length The number of notes to get
	 * @param  integer $paged What note to start at
	 * @return array The notes requsted
	 */
	public function get_notes( $length = 20, $paged = 1 ) {

		$length = is_numeric( $length ) ? $length : 20;
		$offset = is_numeric( $paged ) && $paged != 1 ? ( ( absint( $paged ) - 1 ) * $length ) : 0;

		$all_notes   = $this->get_raw_notes();
		$notes_array = array_reverse( array_filter( explode( "\n\n", $all_notes ) ) );

		$desired_notes = array_slice( $notes_array, $offset, $length );

		return $desired_notes;

	}


	/**
	 * Get the total number of notes we have after parsing
	 *
	 * @since  1.0.0
	 * @return int The number of notes for the commission record
	 */
	public function get_notes_count() {

		$all_notes = $this->get_raw_notes();
		$notes_array = array_reverse( array_filter( explode( "\n\n", $all_notes ) ) );

		return count( $notes_array );

	}


	/**
	 * Add a note to the commission record
	 *
	 * @since  1.0.0
	 * @param string $note The note to add
	 * @return string|boolean The new note if added successfully, false otherwise
	 */
	public function add_note( $note = '' ) {

		$note = trim( $note );
		if ( empty( $note ) ) {
			return false;
		}

		$notes = $this->get_raw_notes();

		if( empty( $notes ) ) {
			$notes = '';
		}

		$note_string = date_i18n( 'F j, Y H:i:s', current_time( 'timestamp' ) ) . ' - ' . $note;
		$new_note    = apply_filters( 'edd_commission_notes_add_note_string', $note_string );
		$notes      .= "\n\n" . $new_note;

		do_action( 'edd_commission_notes_pre_add_note', $new_note, $this->id, $this );

		$updated = $this->update_meta( '_edd_commission_notes', $notes );

		if ( $updated ) {
			$this->raw_notes = $notes;
			$this->notes     = $this->get_notes();
		}

		do_action( 'edd_commission_notes_post_add_note', $this->notes, $new_note, $this->id, $this );

		// Return the formatted note, so we can test, as well as update any displays
		return $new_note;

	}


	/**
	 * Get the notes column for the commission record
	 *
	 * @since  1.0.0
	 * @return string The Notes for the commission record, non-parsed
	 */
	private function get_raw_notes() {

		if ( ! is_null( $this->raw_notes ) ) {
			return $this->raw_notes;
		}

		$this->raw_notes = $this->get_meta( '_edd_commission_notes' );

		return (string) $this->raw_notes;

	}

}
