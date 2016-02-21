=== CBX Flexible Countdown ===
Contributors: codeboxr, manchumahara, wpboxr
Donate link: http://codeboxr.com
Tags: countdown, event, launch, countdown
Requires at least: 3.5
Tested up to: 4.2.2
Stable tag: 1.7.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Flexible Event Countdown using different styles and 3rd party event plugin integration

== Description ==

This plugin shows countdown for event, launch date using various display method.

= Three Countdown Styles =
* Light (Step Countdonwn).
* Circular Countdown
* KK(Text Based)

= Integration =
* Widget
* Shortcode
* Custom Function call

= Flexible Options =
* Event Start Date
* Event Start Hour
* Event Start Minute
* Count Number Color (On Responsive)

= Light Countdown Specific Option =
* Text Color (On Responsive)
* Event Start Minute

= Circular Countdown Specific Option =
* Background Color
* Count Number And Text Color
* Text Color (On Responsive)
* Seconds Border Color
* Minutes Border Color
* Hours Border Color
* Days Border Color

= KK Countdown Specific Option =

* Countdown Font Size
* Countdown Number Color
* Countdown Text Color


= More Features =

*   Can set date
*   Can set hours
*   Can set minutes
*   Can choose background color
*   Can choose font color
*   Can choose circle color for days, hours minutes and seconds

View Demo: http://codeboxr.com/wordpress/cbx-flexible-countdown-cbfc/

Pro Version Available:

We tried to inegrate the plugin with 6 most popular event plugin to show the event count for any event date

Supported Plugins:

*   The Events Calendar (https://wordpress.org/plugins/the-events-calendar/) 2M+ active installs
*   Events Manager (https://wordpress.org/plugins/events-manager/) 1M+ active installs
*   The Events Calendar (https://wordpress.org/plugins/the-events-calendar/)
*   My Calendar (https://wordpress.org/plugins/my-calendar/) 40k+ active installs
*   Event Organiser (https://wordpress.org/plugins/event-organiser/) 30k+ active installs
*   Events Made Easy (https://wordpress.org/plugins/events-made-easy/)  10k+ active installs

The pro addon plugin just enhance the shortcode, widgets and direction function call. Example: pro addson shortcode
[cbfccountdown type="kk" plugin="my-calendar" id="1"][/cbfccountdown]

New Features

*  Optional Event plugin selection and event id selection from widget
*  If the pro addon plugin is active the shortcode will support two extra params(see below) as well as our direct function call will support same type param or argument extra. If the extra params plugin and id is used then it will override the provided date , hour, minute via shortcode or widget and will show from the relevent plugin as selected

 [cbfccountdown type="kk" plugin="my-calendar" id="1"][/cbfccountdown]

 plugin = 3rd party event plugin, possible values are the-events-calendar, events-manager, the-events-calendar, my-calendar ,event-organiser, events-made-easy


 id = event id from the selected plugin.


For more details please check here http://wpboxr.com/product/cbx-flexible-event-countdown-for-wordpress

More Details: http://wpboxr.com/product/cbx-flexible-event-countdown-for-wordpress

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

Using The WordPress Dashboard

* Navigate to the 'Add New' in the plugins dashboard
* Search for 'Codeboxr Flexible Countdown'
* Click 'Install Now'
* Activate the plugin on the Plugin dashboard

Uploading in WordPress Dashboard

* Navigate to the 'Add New' in the plugins dashboard
* Navigate to the 'Upload' area
* Select `codeboxrflexiblecountdown.zip` from your computer
* Click 'Install Now'
* Activate the plugin in the Plugin dashboard

Using FTP

* Download `codeboxrflexiblecountdown.zip`
* Extract the `codeboxrflexiblecountdown` directory to your computer
* Upload the `codeboxrflexiblecountdown` directory to the `/wp-content/plugins/` directory
* Activate the plugin in the Plugin dashboard

How To Use

*   Use "[cbfccountdown]" this shortcode in your post or page or call cbfc_flexible_countdown() function from anywhere you want to use.
Shortcode 'cbfccountdown'  optional params
style="light" , other possible values  kk, circular, default light, if empty then will take from global config
date=""  mm-dd-yy  if empty will take from global config, start date
hour=""   default  0, value range 0-23, if empty will take from config, hour of start date
minute="" default  0, value range 0-59, if empty will take from config, minute of start date

Available Shortcode

see document file given with this plugin for details shortcode and custom function call.

= How To Add Your Own =
*   To add new tab section or overwrite default use this filter "cbfc_add_sections".
*   To add new options to existing tab or in new tab use this filter "cbfc_add_fields",
*   To add your new countdown style in choose option use this filter "cbfc_add_countdown_style",
*   To add new html css or js for your own countdown style use this filter"cbfc_countdown_html",
*   To get option value cbfc_get_options('option-name', 'you-tab-id' ). The second parameter default value is cbfc_general_settings
*   To get plugin textdomain call cbfc_get_text_domain()



== Frequently Asked Questions ==


== Screenshots ==

1. Light style
2. Light style responsive
3. Circular
4. Circular responsive
5. Text based
6. plugin setting -1
7. plugin setting -2
8. plugin setting -3
9. plugin setting -4
10. widget setting

== Changelog ==
= 1.6.4 =
* Fixed color chooser issue in visual shortcode popup window
= 1.6.4 =
* Fixed bug for circular with bootstrap conflict
* Removed general name for constant 'VERSION' and replaced with 'CBXFCVERSION'

= 1.6.3 =
* First Release