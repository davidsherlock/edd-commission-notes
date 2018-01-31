<?php
/**
 * Commission Notes Functions.
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
 * View the notes of a commission record
 *
 * @since  1.0.0
 * @param  $commission The Commission being displayed
 * @return void
 */
function edd_commission_notes_single_view( $commission ) {
	$notes 	     = new EDDC_Notes( $commission->id );
	$paged       = isset( $_GET['paged'] ) && is_numeric( $_GET['paged'] ) ? $_GET['paged'] : 1;
	$paged       = absint( $paged );
	$note_count  = $notes->get_notes_count();
	$per_page    = apply_filters( 'edd_commission_notes_per_page', 20 );
	$total_pages = ceil( $note_count / $per_page );

	$commission_notes = $notes->get_notes( $per_page, $paged );

	?>
	<div id="edd-item-notes-wrapper">
		<div class="edd-item-notes-header">
			<?php echo get_avatar( $commission->user_id, 30 ); ?> <span><?php echo esc_attr( get_userdata( $commission->user_id )->display_name ); ?></span>
		</div>
		<h3><?php _e( 'Notes', 'edd-commission-notes' ); ?></h3>

		<?php if ( 1 == $paged ) : ?>
		<div style="display: block; margin-bottom: 35px;">
			<form id="edd-add-commission-note" method="post" action="<?php echo admin_url( 'edit.php?post_type=download&page=edd-commissions&view=notes&commission=' . esc_attr( $commission->id ) ); ?>">
				<textarea id="commission-note" name="commission_note" class="customer-note-input" rows="10"></textarea>
				<br />
				<input type="hidden" id="commission-id" name="commission_id" value="<?php echo esc_attr( $commission->id ); ?>" />
				<input type="hidden" name="edd_action" value="add-commission-note" />
				<?php wp_nonce_field( 'add-commission-note', 'add_commission_note_nonce', true, true ); ?>
				<input id="add-commission-note" class="right button-primary" type="submit" value="Add Note" />
			</form>
		</div>
		<?php endif; ?>

		<?php
		$pagination_args = array(
			'base'     => '%_%',
			'format'   => '?paged=%#%',
			'total'    => $total_pages,
			'current'  => $paged,
			'show_all' => true
		);

		echo paginate_links( $pagination_args );
		?>

		<div id="edd-commission-notes">
		<?php if ( count( $commission_notes ) > 0 ) : ?>
			<?php foreach( $commission_notes as $key => $note ) : ?>
				<div class="customer-note-wrapper dashboard-comment-wrap comment-item">
					<span class="note-content-wrap">
						<?php echo stripslashes( $note ); ?>
					</span>
				</div>
			<?php endforeach; ?>
		<?php else: ?>
			<div class="edd-no-commission-notes">
				<?php _e( 'No Commission Notes', 'edd-commission-notes' ); ?>
			</div>
		<?php endif; ?>
		</div>

		<?php echo paginate_links( $pagination_args ); ?>

	</div>

	<?php
}
