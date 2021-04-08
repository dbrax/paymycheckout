<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://github.com/dbrax/wopay
 * @since      1.0.0
 *
 * @package    wopay
 * @subpackage wopay/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    wopay
 * @subpackage wopay/includes
 * @author     Emmanuel Mnzava <epmnzava@gmail.com>
 */
class wopay_Deactivator {

	/**
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// my deactication logic here
		//currently we have no interfaces or database etc hence nothing to deactivate as a logic

	}

}
