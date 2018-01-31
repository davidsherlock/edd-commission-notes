<?php
/**
 * Short Code Functions.
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
 * Commissions [edd_commissions] shortcode - table header
 *
 * @access      public
 * @since       1.0.0
 * @access      public
 * @return      void
 */
function edd_commission_notes_user_commission_notes_table_header() {
	?>

	<th class="edd_commission_notes"><?php _e( 'Notes', 'edd-commission-notes' ); ?></th>

	<?php
}
add_action( 'eddc_user_commissions_unpaid_head_row_end', 'edd_commission_notes_user_commission_notes_table_header', 10 );
add_action( 'eddc_user_commissions_paid_head_row_end', 'edd_commission_notes_user_commission_notes_table_header', 10 );
add_action( 'eddc_user_commissions_revoked_head_row_end', 'edd_commission_notes_user_commission_notes_table_header', 10 );


/**
 * Commissions [edd_commissions] shortcode - table row
 *
 * @access      public
 * @since       1.0.0
 * @param		object $commission commission object which use to get the meta
 * @return      void
 */
function edd_commission_notes_user_commission_notes_table_row( $commission ) {
    $notes = new EDDC_Notes( $commission->id );
    $notes = implode( "\n", $notes->get_notes() );

    if ( ! empty( $notes ) ) { ?>
        <td class="edd_commission_notes"><a href="#" data-featherlight="<?php echo "<pre>" . esc_html( $notes ) . "</pre>"; ?>"><?php _e( 'View Notes', 'edd-commission-notes' ); ?></a></td><?php
    } else { ?>
        <td class="edd_commission_notes"><?php _e('No Notes', 'edd-commission-notes'); ?></td><?php
    }
}
add_action( 'eddc_user_commissions_unpaid_row_end', 'edd_commission_notes_user_commission_notes_table_row', 10, 1 );
add_action( 'eddc_user_commissions_paid_row_end', 'edd_commission_notes_user_commission_notes_table_row', 10, 1 );
add_action( 'eddc_user_commissions_revoked_row_end', 'edd_commission_notes_user_commission_notes_table_row', 10, 1 );
