<?php
/**
 * Commission Notes Filters.
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
 * Register a tab in the single commission view for Commission Notes.
 *
 * @since  1.0.0
 * @param  array $views An array of existing views
 * @return array $tabs The altered list of views
 */
function eddcn_commissions_tab( $tabs ) {
	$tabs['notes'] = array( 'dashicon' => 'dashicons-admin-comments', 'title' => __( 'Notes', 'edd-commission-fees' ) );

	return $tabs;
}
add_filter( 'eddc_commission_tabs', 'eddcn_commissions_tab' );


/**
 * Register a view in the single commission view for Commission Notes.
 *
 * @since  1.0.0
 * @param  array $views An array of existing views
 * @return array $views The altered list of views
 */
function eddcn_commissions_view( $views ) {
	$views['notes'] = 'edd_commission_notes_single_view';

	return $views;
}
add_filter( 'eddc_commission_views', 'eddcn_commissions_view' );
