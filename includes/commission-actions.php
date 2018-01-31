<?php
/**
 * Commission Fee Actions.
 *
 * @package     EDD_Commission_Fees
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
 * Adds a note to the commission record on refund containing the payment ID
 *
 * @since       1.0.0
 * @param       $payment EDD_Payment object.
 * @return      void
 */
function edd_commission_notes_add_note_on_refund( $payment ) {
	$note_on_refund = edd_get_option( 'edd_commission_notes_note_on_refund', false );

	if ( false === $note_on_refund ) {
		return;
	}

	$commissions = eddc_get_commissions( array(
		'payment_id' => $payment->ID,
		'status'     => 'revoked',
	) );

	if ( ! empty( $commissions ) ) {
		foreach ( $commissions as $commission ) {

            $note = new EDDC_Notes( $commission->id );

            $refund_note  = sprintf(
                __( 'Payment %s changed from Complete to Refunded', 'edd-commission-notes' ),
                esc_attr( $payment->ID )
            );

            $refund_note = apply_filters( 'edd_commission_notes_add_note_on_refund', $refund_note, $payment, $commission );

            $note->add_note( $refund_note );

		}
	}
}
add_action( 'edd_post_refund_payment', 'edd_commission_notes_add_note_on_refund', 10, 1 );


/**
 * Adds a note to the commission record if the order contains any discount codes.
 *
 * @access      public
 * @since       1.0.0
 * @param       int $recipient The commission recipient user ID
 * @param       float $commission_amount The commission amount
 * @param       float $rate The commission recipient rate
 * @param       int $download_id The commission download ID
 * @param       int $commission_id The commission ID
 * @param       int $payment_id The commission payment ID
 * @return      void
 */
function edd_commission_notes_add_discount_notes( $recipient, $commission_amount, $rate, $download_id, $commission_id, $payment_id ) {
	$note_on_discounts = edd_get_option( 'edd_commission_notes_note_on_discounts', false );

	if ( false === $note_on_discounts ) {
		return;
	}

    $note = new EDDC_Notes( $commission_id );
    $payment = new EDD_Payment( $payment_id );

    // Check for discount codes in the payment
    $found_discounts = array();
    if ( 'none' !== $payment->discounts ) {
        $discounts = $payment->discounts;
        if ( ! is_array( $discounts ) ) {
            $discounts = explode( ',', $discounts );
        }

        foreach ( $discounts as $discount ) {
            $discount_obj = edd_get_discount_by_code( $discount );

            if ( false === $discount_obj ) {
                $found_discounts[] = $discount;
            } else {
                $found_discounts[] = $discount_obj->code;
            }

        }
    }

    if ( ! empty( $found_discounts ) ) {

        $found_discounts = implode( ", ", $found_discounts );

        $discount_note  = sprintf(
            __( 'Discount code(s) applied: %s', 'edd-commission-notes' ),
            esc_attr( $found_discounts )
        );

        $discount_note = apply_filters( 'edd_commission_notes_add_discount_notes', $discount_note, $recipient, $commission_amount, $rate, $download_id, $commission_id, $payment_id );

        $note->add_note( $discount_note );

    }

}
add_action( 'eddc_insert_commission', 'edd_commission_notes_add_discount_notes', 10, 6 );
