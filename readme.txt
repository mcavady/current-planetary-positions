=== Current Planetary Positions ===
Contributors: isabel104
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=me%40isabelcastillo%2ecom
Tags: current planets, planetary, positions, astrology, zodiac, planets positions, ephemeris
Requires at least: 3.7
Tested up to: 4.0
Stable Tag: 1.3
License: GNU GPL Version 2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Astrology widget which displays the current positions of the planets in the zodiac signs.

== Description ==

Current Planetary Positions is a WordPress plugin that adds a widget which displays the positions of the sun, the moon, Mercury, Venus, Mars, Jupiter, Saturn, Uranus, Neptune, Pluto, and Chiron in the zodiac signs. From left to right, the columns display the planet's name, the degree of zodiac sign, zodiac sign symbol, zodiac sign text, the minute of degree, the second of degree, and retrograde motion (when indicated). If there appears an 'R' in the last column, then that planet is in apparent retrograde motion. The sun and moon are never retrograde. Please note: astrologers refer to all 11 of these celestial bodies as "planets" for the sake of convenience.

The zodiac sign symbols are color coded according to their element: red for fire signs, green for earth, yellow for air, and blue for water. The widget also displays the current local date and time of the viewer, as given by the viewer's browser. 

Current Planetary Positions uses the Swiss Ephemeris to get the longitude of the planets/celestial bodies. Information about the Swiss Ephemeris can be found at http://www.astro.com/swisseph/swephinfo_e.htm

[Documentation and Troubleshooting](http://isabelcastillo.com/docs/category/current-planetary-positions-wordpress-plugin).

Fork or contribute [on GitHub](https://github.com/isabelc/current-planetary-positions).

**Languages**

These languages are included in the plugin:

- English (default)
- Arabic
- French
- Hindi
- Spanish

This plugin is translation-ready, and includes a `.pot` file to make it easy for you to translate it into other languages.

For more info, see the [FAQ](http://wordpress.org/plugins/daily-moon-forecast/faq/), the Installation instructions (link above), or the [plugin web page](http://isabelcastillo.com/docs/category/daily-moon-forecast-wordpress-plugin).

== Installation ==

1. Log in to your WordPress dashboard.
2. Go to 'Plugins -> Add New'
3. Click 'Upload', then upload the plugin `.zip` file that you downloaded from here.
4. Activate the plugin by clicking "Activate".
5. The Current Planetary Positions widget will be available in `Appearance -> Widgets`. To use the widget, drag the widget to a sidebar widget area like you would any other widget.

== Frequently Asked Questions ==

= How can I change the CSS style of the widget? =

1. To style the entire widget, use this selector:

`.widget_cpp_widget`

2. To style the widget title, use this selector:

`.widget_cpp_widget h3`

3. To style the everything except the title, use this selector:

`#current-planets`

4. To style just the date, use this selector:

`#current-planets #localtime`

5. To style just the table of positions, use this selector:

`#current-planets table`

**CSS Style Suggestions**

To center the widget title and the date and time, add this to `style.css`:

`.widget_cpp_widget h3, #current-planets #localtime  {
	text-align:center;
}`

== Screenshots ==
1. Current Planetary Positions widget
2. Zoomed in - Current Planetary Positions widget

== Changelog ==

= 1.3 =
* Maintenance - Updated widget to work with the WordPress 4.0 live widget customizer.
* Maintenance - Compresses sprites for increased page speed.
* Maintenance - Minify the inline js for increased page speed.
* Maintenance - Removed unused icon.
* Maintenance - Removed one PHP warning.

= 1.2.6 =
* New: changed textdomain to be same as plugin slug. Updated all .pot, .mo, .po translation filenames accordingly.
* New: option to show UTC/GMT time instead of viewer's local time.
* New: singleton class.
* Maintenance: removed PHP warning for using undefined constants and for localized_full_sec.

= 1.2.5 = 
* Maintenance: Fixed typo in description.

= 1.2.4 = 
* New: removed Software Licensing plugin updater class.
* Maintenance: updated .pot file and all translation files.
* Maintenance: Tested and passed for WP 3.9 compatibility

= 1.2.3 = 
* New: plugin updates will now be available in WordPress dashboard.
* New: localized numbers.
* New: added French and Hindi language translations.
* Maintenance: updated .pot file and all translation files.

= 1.2.2 = 
* New: added Spanish language and Arabic language translations.
* New: added better support for rtl languages.
* Tweak: added background transparency to icons.
* Tweak: dynamic icons sizes to fit into thinner-width sidebars.
* Maintenance: added CSS for Twenty Fourteen theme compatibility.
* Maintenance: CSS tweaks: removed font color for compatibility with more themes.
* Maintenance: updated .pot file.

= 1.2.1 = 
* Maintenance: removed _vti_ files.

= 1.2 = 
* New: use sprite map for icons.

= 1.1 = 
* New: set chmod automatically.

= 1.0 =
* Initial release of the WP plugin version.
