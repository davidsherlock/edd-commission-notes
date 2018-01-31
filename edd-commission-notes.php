<?php
/**
 * Plugin Name:     Easy Digital Downloads - Commission Notes
 * Plugin URI:      https://wordpress.org/plugins/edd-commission-notes/
 * Description:     Record commission notes and allow your vendors to easily view them.
 * Version:         1.0.0
 * Author:          Sell Comet
 * Author URI:      https://sellcomet.com
 * Text Domain:     edd-commission-notes
 * Domain Path:     languages
 *
 * @package         EDD\Commission_Notes
 * @author          Sell Comet
 * @copyright       Copyright (c) Sell Comet
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'EDD_Commission_Notes' ) ) {

    /**
     * Main EDD_Commission_Notes class
     *
     * @since       1.0.0
     */
    class EDD_Commission_Notes {

        /**
         * @var         EDD_Commission_Notes $instance The one true EDD_Commission_Notes
         * @since       1.0.0
         */
        private static $instance;

        /**
         * Get active instance
         *
         * @access      public
         * @since       1.0.0
         * @return      object self::$instance The one true EDD_Commission_Notes
         */
        public static function instance() {
            if( !self::$instance ) {
                self::$instance = new EDD_Commission_Notes();
                self::$instance->setup_constants();
                self::$instance->includes();
                self::$instance->load_textdomain();
                self::$instance->hooks();
            }

            return self::$instance;
        }

        /**
         * Setup plugin constants
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function setup_constants() {
            // Plugin version
            define( 'EDD_COMMISSION_NOTES_VER', '1.0.0' );

            // Plugin path
            define( 'EDD_COMMISSION_NOTES_DIR', plugin_dir_path( __FILE__ ) );

            // Plugin URL
            define( 'EDD_COMMISSION_NOTES_URL', plugin_dir_url( __FILE__ ) );
        }

        /**
         * Include necessary files
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function includes() {

            if ( is_admin() ) {

                // Include admin commission functions
                require_once EDD_COMMISSION_NOTES_DIR . 'includes/admin/commissions.php';

                // Include admin commission filters
                require_once EDD_COMMISSION_NOTES_DIR . 'includes/admin/commissions-filters.php';

                // Include admin commission actions
                require_once EDD_COMMISSION_NOTES_DIR . 'includes/admin/commissions-actions.php';

                // Include admin settings
                require_once EDD_COMMISSION_NOTES_DIR . 'includes/admin/settings.php';

            }

            // Include scripts
            require_once EDD_COMMISSION_NOTES_DIR . 'includes/scripts.php';

            // Include commission actions
            require_once EDD_COMMISSION_NOTES_DIR . 'includes/commission-actions.php';

            // Include frontend short-codes
            require_once EDD_COMMISSION_NOTES_DIR . 'includes/short-codes.php';

            // Include EDDC_Notes class
            require_once EDD_COMMISSION_NOTES_DIR . 'includes/classes/class-edd-commission-notes.php';

        }

        /**
         * Internationalization
         *
         * @access      public
         * @since       1.0.0
         * @return      void
         */
        public function load_textdomain() {
            // Set filter for language directory
            $lang_dir = EDD_COMMISSION_NOTES_DIR . '/languages/';
            $lang_dir = apply_filters( 'edd_commission_notes_languages_directory', $lang_dir );

            // Traditional WordPress plugin locale filter
            $locale = apply_filters( 'plugin_locale', get_locale(), 'edd-commission-notes' );
            $mofile = sprintf( '%1$s-%2$s.mo', 'edd-commission-notes', $locale );

            // Setup paths to current locale file
            $mofile_local   = $lang_dir . $mofile;
            $mofile_global  = WP_LANG_DIR . '/edd-commission-notes/' . $mofile;

            if( file_exists( $mofile_global ) ) {
                // Look in global /wp-content/languages/edd-commission-fees/ folder
                load_textdomain( 'edd-commission-notes', $mofile_global );
            } elseif( file_exists( $mofile_local ) ) {
                // Look in local /wp-content/plugins/edd-commission-fees/languages/ folder
                load_textdomain( 'edd-commission-notes', $mofile_local );
            } else {
                // Load the default language files
                load_plugin_textdomain( 'edd-commission-notes', false, $lang_dir );
            }
        }

        /**
         * Run action and filter hooks
         *
         * @access      private
         * @since       1.0.0
         * @return      void
         */
        private function hooks() {

            if ( is_admin() ) {

                // Make sure we are at the minimum version of EDD Commissions - which is 3.3.
                add_action( 'admin_notices', array( $this, 'version_check_notice' ), 10 );

            }

        }

        /**
    	 * Make sure we are at the minimum version of EDD Commissions - which is 3.4.6.
    	 *
    	 * @since       1.0.0
    	 * @access      public
    	 * @return      void
    	 */
    	public function version_check_notice() {

            if ( defined( 'EDD_COMMISSIONS_VERSION' ) && version_compare( EDD_COMMISSIONS_VERSION, '3.4.5' ) == -1 ) {
            	?>
            	<div class="notice notice-error">
    	        <p><?php echo __( 'EDD Commission Notes: Your version of EDD Commissions must be updated to version 3.4.6 or later to use the Commission Notes extension in conjunction with Commissions.', 'edd-commission-notes' ); ?></p>
            	</div>
            	<?php
            }
    	}

    }
} // End if class_exists check

/**
 * The main function responsible for returning the one true EDD_Commission_Notes
 * instance to functions everywhere
 *
 * @since       1.0.0
 * @return      \EDD_Commission_Notes The one true EDD_Commission_Notes
 */
function EDD_Commission_Notes_load() {
    if ( ! class_exists( 'Easy_Digital_Downloads' ) || ! class_exists( 'EDDC' ) ) {
        if ( ! class_exists( 'EDD_Extension_Activation' ) || ! class_exists( 'EDD_Commissions_Activation' ) ) {
          require_once 'includes/classes/class-activation.php';
        }

        // Easy Digital Downloads activation
		if ( ! class_exists( 'Easy_Digital_Downloads' ) ) {
			$edd_activation = new EDD_Extension_Activation( plugin_dir_path( __FILE__ ), basename( __FILE__ ) );
			$edd_activation = $edd_activation->run();
		}

        // Commissions activation
		if ( ! class_exists( 'EDDC' ) ) {
			$edd_commissions_activation = new EDD_Commissions_Activation( plugin_dir_path( __FILE__ ), basename( __FILE__ ) );
			$edd_commissions_activation = $edd_commissions_activation->run();
		}

    } else {

      return EDD_Commission_Notes::instance();
    }
}
add_action( 'plugins_loaded', 'EDD_Commission_Notes_load' );
