<?php
/**
 * Extension settings
 *
 * @package     EDD_Commission_Fees
 * @subpackage  Admin/Settings
 * @copyright   Copyright (c) 2018, Sell Comet
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.0
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Add settings under "Downloads" > "Extensions" > "Commissions" for Commission Fees.
 *
 * @access    	public
 * @since     	1.0.0
 * @param     	array $commission_settings The array of settings for the Commissions settings page.
 * @return 		array $commission_settings The merged array of settings for the Commissions settings page.
 */
function edd_commission_notes_settings( $commission_settings ) {
	$new_settings = array(
		array(
			'id'      => 'edd_commission_notes_header',
			'name'    => '<strong>' . __( 'Note Settings', 'edd-commission-notes' ) . '</strong>',
			'desc'    => '',
			'type'    => 'header',
			'size'    => 'regular',
		),
		array(
			'id'      => 'edd_commission_notes_note_on_refund',
			'name'    => __( 'Note on Refund', 'edd-commission-notes' ),
			'desc'    => __( 'If checked EDD will automatically add a note on refund to the commission record containing the Payment ID.', 'edd-commission-notes' ),
			'type'    => 'checkbox',
		),
		array(
			'id'      => 'edd_commission_notes_note_on_discounts',
			'name'    => __( 'Note on Discounts', 'edd-commission-notes' ),
			'desc'    => __( 'If checked EDD will automatically add a note to the commission record containing a list of discount codes applied to the payment.', 'edd-commission-notes' ),
			'type'    => 'checkbox',
		),
  );

  $new_settings = apply_filters( 'edd_commission_notes_settings', $new_settings );

  return array_merge( $commission_settings, $new_settings );
}
add_filter( 'eddc_settings', 'edd_commission_notes_settings', 10, 1 );
