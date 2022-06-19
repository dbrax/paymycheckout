<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/dbrax/paymycheckout
 * @since      1.0.0
 *
 * @package    paymycheckout
 * @subpackage paymycheckout/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * @package    paymycheckout
 * @subpackage paymycheckout/public
 * @author     Emmanuel Paul Mnzava <epmnzava@gmail.com>
 */
class paymycheckout_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $paymycheckout    The ID of this plugin.
	 */
	private $paymycheckout;

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
	 * @param      string    $paymycheckout       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($paymycheckout, $version)
	{

		$this->paymycheckout = $paymycheckout;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in paymycheckout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The paymycheckout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->paymycheckout, plugin_dir_url(__FILE__) . 'css/paymycheckout-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in paymycheckout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The paymycheckout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->paymycheckout, plugin_dir_url(__FILE__) . 'js/paymycheckout-public.js', array('jquery'), $this->version, false);
	}
}
