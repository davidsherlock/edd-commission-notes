<?php
/**
 * Scripts
 *
 * @package     EDD\PluginName\Scripts
 * @since       1.0.0
 */


// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


/**
 * Load admin scripts
 *
 * @since       1.0.0
 * @global      array $edd_settings_page The slug for the EDD settings page
 * @global      string $post_type The type of post that we are editing
 * @return      void
 */
function edd_commission_notes_admin_scripts( $hook ) {
    $screen = get_current_screen();

    if ( ! is_object( $screen ) ) {
        return;
    }

    $allowed_screens = array(
        'download_page_edd-commissions',
    );

    $allowed_screens = apply_filters( 'edd-commission-notes-admin-script-screens', $allowed_screens );

    if ( ! in_array( $screen->id, $allowed_screens ) ) {
        return;
    }

    // Use minified libraries if SCRIPT_DEBUG is turned off
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    wp_enqueue_script( 'edd_commission_notes_admin_js', EDD_COMMISSION_NOTES_URL . 'assets/js/admin-scripts' . $suffix . '.js', array( 'jquery' ) );

}
add_action( 'admin_enqueue_scripts', 'edd_commission_notes_admin_scripts', 100 );


/**
 * Load frontend scripts
 *
 * @since       1.0.0
 * @return      void
 */
function edd_commission_notes_scripts( $hook ) {
    global $post;

    // Use minified libraries if SCRIPT_DEBUG is turned off
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'edd_commissions' ) ) {
        wp_enqueue_script( 'featherlight_js', EDD_COMMISSION_NOTES_URL . 'assets/js/featherlight' . $suffix . '.js', array( 'jquery' ) );
        wp_enqueue_style( 'featherlight_css', EDD_COMMISSION_NOTES_URL . 'assets/css/featherlight' . $suffix . '.css' );
    }
}
add_action( 'wp_enqueue_scripts', 'edd_commission_notes_scripts' );
