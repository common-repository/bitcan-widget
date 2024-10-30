=== Bitcan Widget ===
Contributors: litpay
Tags: bitcoin, widget, cryptocurrency, crypto, bitcan
Requires at least: 4.0
Tested up to: 5.2.3
Requires PHP: 5.6
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The official plugin containing the widget and shortcode of the secure bitcoin purchase platform - bitcan.pl.

== Description ==
This plugin allows you to place on your own site anywhere - a widget that allows you to buy bitcoins safely and easily using the Bitcan platform.

The widget can be freely modified according to your needs, including overwriting the default style sheet.

The current functionalities offered by the plugin are:
* The ability to add any number of widgets as panels in the prepared places in the template. Using the Appearance -> Widgets subpage in the admin panel.
* The ability to add anywhere (subpage, post, etc.) shortcode creating a widget and its adjustment using parameters.

For information on using the plugin and matching it, see the FAQ section.

Functionalities planned for implementation:
* It is easier and more pleasant to customize the appearance of widgets and create styles using the form on a special subpage.
* Easier parameter management and the ability to save your own configurations for later use.

== Installation ==
1. Install the plugin through the WordPress repository or by unpacking/uploading the package directly to the /wp-content/plugins/ directory.
2. Activate the plugin on the "Plugins" subpage that you will refer to in the WordPress menu.
3. Post your first widget.

Details on customizing can be found in the FAQ section.

== Frequently Asked Questions ==
= How can I embed a widget on the page? =

* Using the form in a specific panel prepared in the template: go to the subpage "Appearance -> Widgets" select the Bitcan widget and place it in the appropriate place. There you can also adjust all parameters.
* Using shortcode anywhere: `[bitcan-widget]`

If you choose the option associated with shortcode use the information on the parameters also found in the FAQ.

= How can I customize the shortcode? =

It is really easy. Default shortcode `[bitcan-widget]` uses the default parameters, but you can modify them by simply adding the appropriate information between the square brackets. Examples and information about the parameters are below.

Supported parameters are:

* `partner_id` – affiliate code which you can find in your panel on bitcan.pl.
* `header_text` – Header text that will be in the widget. The default is: "Fast and secure Bitcoin exchange".
* `default_amount` – The amount of exchange showing up in the start widget. It cannot be less than 50 or greater than 1000. The default is 100.
* `type` – The widget's size style. The options are: "small" and "big". Depending on the chosen place, it is worth checking which size fits better. The default is "small".
* `css_path` – Path to your own file overwriting the default widget styles. The path can be relative or absolute.

Examples:

* `[bitcan-widget type="big" header_text="Welcome exchange"]`
* `[bitcan-widget type="big" default_amount="999" ]`

= How can I overwrite styles? =

At the moment, to overwrite styles you need to have some knowledge of CSS, in the future a suitable generator will appear.

1. The first step is to save the default styles anywhere you find at: https://cdn.bitcan.pl/purchase_box/css/style.css?v=2
2. Saved styles should be modified at your own discretion and posted on the server or in a place where you can add a reference to them. For example, in the main directory of the site.
3. Now just add the path with the new styles to the appropriate parameter in the shortcode or to the field in the widget panel.

Example:

`[bitcan-widget css_path="custom-widget-style.css"]`

The example is based on placing a modified style sheet in the main page directory.

== Changelog ==
= 1.0 =
First release.
