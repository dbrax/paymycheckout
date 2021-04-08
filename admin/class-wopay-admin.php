<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/dbrax/wopay
 * @since      1.0.0
 *
 * @package    wopay
 * @subpackage wopay/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    wopay
 * @subpackage wopay/admin
 * @author     Emmanuel Mnzava <epmnzava@gmail.com>
 */
class wopay_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $wopay    The ID of this plugin.
	 */
	private $wopay;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $wopay       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($wopay, $version)
	{

		$this->wopay = $wopay;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in wopay_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The wopay_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->wopay, plugin_dir_url(__FILE__) . 'css/wopay-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in wopay_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The wopay_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->wopay, plugin_dir_url(__FILE__) . 'js/wopay-admin.js', array('jquery'), $this->version, false);
	}
}
