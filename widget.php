<?php

class Modal_Widget extends WP_Widget
{

    protected $widget_slug = 'Modal_Widget';

    public function __construct()
    {

        // load plugin text domain
        add_action('init', array($this, 'widget_textdomain'));

        // Hooks fired when the Widget is activated and deactivated
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        //widget description
        parent::__construct(
            $this->get_widget_slug(),
            __('Modal', $this->get_widget_slug()),
            array(
                'classname' => $this->get_widget_slug() . '-class',
                'description' => __('Call modals within site content using class names.', $this->get_widget_slug())
            )
        );

        // Register admin styles and scripts
        add_action('admin_print_styles', array($this, 'register_admin_styles'));
        add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));

        // Register site styles and scripts
        add_action('wp_enqueue_scripts', array($this, 'register_widget_styles'));
        add_action('wp_enqueue_scripts', array($this, 'register_widget_scripts'));

        // Refreshing the widget's cached output with each new post
        add_action('save_post', array($this, 'flush_widget_cache'));
        add_action('deleted_post', array($this, 'flush_widget_cache'));
        add_action('switch_theme', array($this, 'flush_widget_cache'));

    }

    public function get_widget_slug()
    {
        return $this->widget_slug;
    }

    public function widget($args, $instance)
    {
        // Check if there is a cached output
        $cache = wp_cache_get($this->get_widget_slug(), 'widget');

        if (!is_array($cache))
            $cache = array();

        if (!isset ($args['widget_id']))
            $args['widget_id'] = $this->id;

        if (isset ($cache[$args['widget_id']]))
            return print $cache[$args['widget_id']];

        // go on with your widget logic, put everything into a string and …
        extract($args, EXTR_SKIP);

        $widget_string = $before_widget;

        //manipulate widget's values based on their input fields

        include(plugin_dir_path(__FILE__) . 'views/widget.php');
        $widget_string .= ob_get_clean();
        $widget_string .= $after_widget;

        $cache[$args['widget_id']] = $widget_string;

        wp_cache_set($this->get_widget_slug(), $cache, 'widget');

        print $widget_string;

    }


    public function flush_widget_cache()
    {
        wp_cache_delete($this->get_widget_slug(), 'widget');
    }

    public function update($new_instance, $old_instance)
    {

        $instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;

    }

    /**
     * Generates the administration form for the widget.
     *
     * @param array instance The array of keys and values for the widget.
     */
    public function form($instance)
    {
        //Define default values for your variables if needed

        // Display the admin form
        include(plugin_dir_path(__FILE__) . 'views/admin.php');

    }

    /*--------------------------------------------------*/
    /* Public Functions
    /*--------------------------------------------------*/

    /**
     * Loads the Widget's text domain for localization and translation.
     */
    public function widget_textdomain()
    {
        load_plugin_textdomain($this->get_widget_slug(), false, plugin_dir_path(__FILE__) . 'lang/');

    }

    /**
     * Fired when the plugin is activated.
     *
     * @param  boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
     */
    public function activate($network_wide)
    {
        // TODO define activation functionality here
    }

    /**
     * Fired when the plugin is deactivated.
     *
     * @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
     */
    public function deactivate($network_wide)
    {
        // TODO define deactivation functionality here
    }

    /**
     * Registers and enqueues admin-specific styles.
     */
    public function register_admin_styles()
    {

        wp_enqueue_style($this->get_widget_slug() . '-admin-styles', plugins_url('css/admin.css', __FILE__));
		wp_enqueue_style($this->get_widget_slug() . '-colorpicker-styles', plugins_url('css/jquery.simplecolorpicker.css', __FILE__));

    }

    /**
     * Registers and enqueues admin-specific JavaScript.
     */
    public function register_admin_scripts()
    {
        	
		wp_enqueue_script($this->get_widget_slug() . '-admin-colorpicker', plugins_url('js/colorpicker/jquery.simplecolorpicker.js', __FILE__), array('jquery'), 1.0, true);
        wp_enqueue_script($this->get_widget_slug() . '-admin-script', plugins_url('js/admin.js', __FILE__), array('jquery'), 1.0, true);

    }

    /**
     * Registers and enqueues widget-specific styles.
     */
    public function register_widget_styles()
    {

        wp_enqueue_style($this->get_widget_slug() . '-widget-styles', plugins_url('css/widget.css', __FILE__));
		wp_enqueue_style($this->get_widget_slug() . '-widget-styles', plugins_url('css/modal.css', __FILE__));
    }

    /**
     * Registers and enqueues widget-specific scripts.
     */
    public function register_widget_scripts()
    {

        wp_enqueue_script($this->get_widget_slug() . '-script', plugins_url('js/widget.js', __FILE__), array('jquery'), 1.0, true);
		wp_enqueue_script($this->get_widget_slug() . '-script', plugins_url('js/gfc/GFC.js', __FILE__), array('jquery'), 1.0, true);
		wp_enqueue_script($this->get_widget_slug() . '-script', plugins_url('js/gfc/app.js', __FILE__), array('jquery'), 1.0, true);
		wp_enqueue_script($this->get_widget_slug() . '-script', plugins_url('js/gfc/init.js', __FILE__), array('jquery'), 1.0, true);
		wp_enqueue_script($this->get_widget_slug() . '-script', plugins_url('js/gfc/modal.js', __FILE__), array('jquery'), 1.0, true);

    }

}


add_action('widgets_init', create_function('', 'register_widget("Modal_Widget");'));
