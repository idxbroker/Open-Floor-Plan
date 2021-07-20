<?php
/**
 * Recommends plugins for use in Open Floor Plan theme
 *
 * @package Open Floor Plan\Plugins
 * @author  Agent Evolution
 * @license GPL-2.0+
 * @link    
 */

add_action( 'tgmpa_register', 'open_floor_plan_register_required_plugins' );
/**
 * Register the recommended plugins for this theme.
 * 
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function open_floor_plan_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $ofp_plugins = array(
        // Soliloquy
        array(
            'name'      => 'Soliloquy',
            'slug'      => 'soliloquy',
            'source'    => get_stylesheet_directory() . '/plugins/soliloquy.zip',
            'required'  => false,
        ),
        // IMPress Listings
        array(
            'name'      => 'IMPress Listings',
            'slug'      => 'wp-listings',
            'required'  => false,
        ),
        // Regen
        array(
            'name'      => 'Regenerate Thumbnails',
            'slug'      => 'regenerate-thumbnails',
            'required'  => false,
        ),        
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $ofp_config = array(
    	'domain'       => 'open-floor-plan',        // Text domain - likely want to be the same as your theme.
        'id'           => 'equity-plugins',         // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                       // Default absolute path to pre-packaged plugins.
        'menu'         => 'equity-install-plugins', // Menu slug.
        'has_notices'  => true,                     // Show admin notices or not.
        'dismissable'  => true,                     // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                    // Automatically activate plugins after installation or not.
        'message'      => __( 'The following plugins are either recommended or required to get the most out of your theme.', 'open-floor-plan' ), // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'open-floor-plan' ),
            'menu_title'                      => __( 'Install Plugins', 'open-floor-plan' ),
            'installing'                      => __( 'Installing Plugin: %s', 'open-floor-plan' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'open-floor-plan' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'open-floor-plan' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'open-floor-plan' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'open-floor-plan' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'open-floor-plan' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'open-floor-plan' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'open-floor-plan' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'open-floor-plan' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'open-floor-plan' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'open-floor-plan' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'open-floor-plan' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'open-floor-plan' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'open-floor-plan' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'open-floor-plan' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $ofp_plugins, $ofp_config );

}