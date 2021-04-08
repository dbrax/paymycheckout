=== Wopay ===
Contributors: dbrax
Tags: e-commerce, payment gateways, tigopesa, mpesa, woo, shop, cart, checkout, downloadable, downloads, payments, woo commerce
Requires at least: 5.4
Woocommerce at least: 5.1
Tested up to: 5.7
Requires PHP: 7.0
Stable tag: 1.0.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Wopay is a unified mobile money payment gateway to be used in woocommerce plugin.Helps merchants to receive money seemlessly using mobile money ( Tigopesa , Mpesa and Airtel Money)
== Description ==

Wordpress and woocommerce users and developers can use this plugin to ensure that their stores can receive money through mobile payments gateways such as tigopesa and mpesa.
The plugin works well with woocommerce to add extra functionality to enable users to pay with tigopesa.

A few notes about the sections above:

*   "Contributors" is a comma separated list of wp.org/wp-plugins.org usernames
*   "Tags" is a comma separated list of tags that apply to the plugin
*   "Requires at least" is the lowest version that the plugin will work on
*   "Tested up to" is the highest version that you've *successfully used to test the plugin*. Note that it might work on
higher versions... this is just the highest one you've verified.
*   Stable tag should indicate the Subversion "tag" of the latest stable version, or "trunk," if you use `/trunk/` for
stable.

    Note that the `readme.txt` of the stable tag is the one that is considered the defining one for the plugin, so
if the `/trunk/readme.txt` file says that the stable tag is `5.4`, then it is `/tags/5.4/readme.txt` that'll be used
for displaying information about the plugin.  In this situation, the only thing considered from the trunk `readme.txt`
is the stable tag pointer.  Thus, if you develop in trunk, you can update the trunk `readme.txt` to reflect changes in
your in-development version, without having that information incorrectly disclosed about the current stable version
that lacks those changes -- as long as the trunk's `readme.txt` points to the correct stable tag.

    If no stable tag is provided, it is assumed that trunk is stable, but you should specify "trunk" if that's where
you put the stable version, in order to eliminate any doubt.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `Wopay.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php do_action('Wopay_hook'); ?>` in your templates




== Changelog ==

= 1.0.0 =
* Intial Release with tigopesa as the only mobile payment gateway

