=== Current Planetary Positions Plugin for WordPress ===

Author: Isabel Castillo
Author URI: http://isabelcastillo.com
License: GNU GPL Version 2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Current Planetary Positions is a WordPress plugin that adds a widget which displays the positions of the sun, the moon, Mercury, Venus, Mars, Jupiter, Saturn, Uranus, Neptune, Pluto, and Chiron in the zodiac signs. From left to right, the columns display the planet's name, the degree of zodiac sign, zodiac sign symbol, zodiac sign text, the minute of degree, the second of degree, and retrograde motion (when indicated). If there appears an 'R' in the last column, then that planet is in apparent retrograde motion. The sun and moon are never retrograde. Please note: astrologers refer to all 11 of these celestial bodies as "planets" for the sake of convenience.

The zodiac sign symbols are color coded according to their element: red for fire signs, green for earth, yellow for air, and blue for water. The widget also displays the current local date and time of the viewer, as given by the viewer's browser. 

Current Planetary Positions uses the Swiss Ephemeris to get the longitude of the planets/celestial bodies. Information about the Swiss Ephemeris can be found at http://www.astro.com/swisseph/swephinfo_e.htm



=== Languages ===

These languages are included in the plugin:

 - English (default)
 - Arabic
 - French
 - Hindi
 - Spanish

This plugin is translation-ready, and includes a `.pot` file to make it easy for you to translate it into other languages.


=== Installation ===

1. Log in to you WordPress dashboard.
2. Go to 'Plugins -> Add New'
3. Click 'Upload', then upload the plugin file that you purchased.
4. Activate the plugin by clicking "Activate".
5. Now you are ready to use the plugin.
6. The Current Planetary Positions widget will be available in `Appearance -> Widgets`
7. To use the widget, drag the widget to a sidebar widget area like you would any other widget.


=== Requirements ===

WordPress 3.3.1+,  
PHP 4.x+,  

Note: The widget needs a minimum width of 250px to be displayed correctly. Unless, of course, you edit the CSS file to make the font-size smaller.



=== CSS Selectors ===

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



=== CSS Style Suggestions ===

To center the widget title and the date and time, add this to `style.css`:

`.widget_cpp_widget h3, #current-planets #localtime  {
	text-align:center;
}`



=== Included Files ===

cpp-widget.php
current-planetary-positions.php
EDD_SL_Plugin_Updater.php
license.txt
readme.txt
style.css

icons/icon-planets.png
icons/sprites.png
icons/sprites-mini.png

languages/cpp.pot
languages/cpp-ar.mo
languages/cpp-ar.po
languages/cpp-es_ES.mo
languages/cpp-es_ES.po
languages/cpp-fr_FR.mo
languages/cpp-fr_FR.po
languages/cpp-hi_IN.mo
languages/cpp-hi_IN.po

sweph/isabelse
sweph/seas_18.se1
sweph/semo_18.se1
sweph/sepl_18.se1


=== Support ===

Documentation and Instruction Guides:

http://isabelcastillo.com/docs/


If you purchased this software at http://isabelcastillo.com, you can get support at http://isabelcastillo.com/support/


== Changelog ==

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