<?php
/**
 * Commission Notes Actions.
 *
 * @package     EDD_Commission_Notes
 * @subpackage  Core
 * @copyright   Copyright (c) 2018, Sell Comet
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Save a commission note being added
 *
 * @since  1.0.0
 * @param  array $args The $_POST array being passeed
 * @return int         The Commission ID that was saved, or 0 if nothing was saved
 */
function edd_commission_notes_save_note( $args ) {
    
	if ( ! is_admin() || ! current_user_can( 'edit_shop_payments' ) ) {
		wp_die( __( 'You do not have permission to edit this commission record', 'edd-commission-notes' ) );
	}

	if ( empty( $args ) ) {
		return;
	}

	$commission_note = trim( sanitize_text_field( $args['commission_note'] ) );
	$commission_id   = (int)$args['commission_id'];
	$nonce           = $args['add_commission_note_nonce'];

	if ( ! wp_verify_nonce( $nonce, 'add-commission-note' ) ) {
		wp_die( __( 'Cheatin\' eh?!', 'edd-commission-notes' ) );
	}

	if ( empty( $commission_note ) ) {
		edd_set_error( 'empty-commission-note', __( 'A note is required', 'edd-commission-notes' ) );
	}

	if ( edd_get_errors() ) {
		return;
	}

	$note = new EDDC_Notes( $commission_id );
	$new_note = $note->add_note( $commission_note );

	do_action( 'edd_pre_insert_commission_note', $commission_id, $new_note );

	if ( ! empty( $new_note ) && ! empty( $commission_id ) ) {

		ob_start();
		?>
		<div class="customer-note-wrapper dashboard-comment-wrap comment-item">
			<span class="note-content-wrap">
				<?php echo stripslashes( $new_note ); ?>
			</span>
		</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			echo $output;
			exit;
		}

		return $new_note;

	}

	return false;

}
add_action( 'edd_add-commission-note', 'edd_commission_notes_save_note', 10, 1 );
