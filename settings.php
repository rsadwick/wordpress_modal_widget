<?php
if (!class_exists('Modal_Template_Settings')) {
    class Modal_Template_Settings
    {
        public function __construct()
        {
            // register actions
            add_action('admin_init', array($this, 'admin_init'));
            add_action('admin_menu', array($this, 'add_menu'));
        }

        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
            // register your plugin's settings
            register_setting('wp_plugin_template-group', 'setting_a');
            register_setting('wp_plugin_template-group', 'setting_b');

            // add your settings section
            add_settings_section(
                'wp_plugin_template-section',
                'Modal Settings',
                array($this, 'settings_section_wp_plugin_template'),
                'wp_plugin_template'
            );

            // setting fields
            add_settings_field(
                'wp_plugin_template-setting_a',
                'Setting A',
                array($this, 'settings_field_input_text'),
                'wp_plugin_template',
                'wp_plugin_template-section',
                array(
                    'field' => 'setting_a'
                )
            );
            add_settings_field(
                'wp_plugin_template-setting_b',
                'Setting B',
                array($this, 'settings_field_input_text'),
                'wp_plugin_template',
                'wp_plugin_template-section',
                array(
                    'field' => 'setting_b'
                )
            );
        }

        public function settings_section_wp_plugin_template()
        {
            // Think of this as help text for the section.
            echo 'Settings for GFC Modals.';
        }

        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        }

        /**
         * add a menu
         */
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
            add_options_page(
                'Modal Settings',
                'Modal Settings',
                'manage_options',
                'wp_plugin_template',
                array($this, 'plugin_settings_page')
            );
        }

        /**
         * Menu Callback
         */
        public function plugin_settings_page()
        {
            if (!current_user_can('manage_options')) {
                wp_die(__('You do not have sufficient permissions to access this page.'));
            }

            // Render the settings template
            include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        }

    }
}