=== Program Output ===
Contributors: vickyagravat
Tags: programs, output, formatted output, code
Requires at least: 2.5
Tested up to: 6.4
Stable tag: 1.1.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Simple plugin to display formatted output of any program.

== Description ==

This Plugin is useful for developers blog, tutorial site where to display formatted output of any program, like C, C++, JAVA, VB, C#, JSP, ASP, PHP, HTML etc.
The output is purely created using CSS so it is responsive, and display perfectly on any browser.
It use shortcode to display output. Just add <strong>[output] Hello World! [/output]</strong> to your Post or Page.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Plugin Name screen to configure the plugin
1. (Make your instructions match the desired user flow for activating and installing your plugin. Include any steps that might be needed for explanatory purposes)

== Frequently Asked Questions ==

= How to use Shortcodes? =

Just add <strong>[output]</strong> Text to Display <strong>[/output]</strong> to your Post or Page.

= How to use Shortcodes with Parameters? =

This plug-in accepts three parameters with Shortcodes. 1) <strong>type</strong> 2) <strong>title</strong> 3) <strong>header</strong> all three are optional.

= How to use "type" Parameters with Shortcodes? =

Just add <strong>type</strong> with <strong>value</strong> in starting shortcode. For Example <strong>[output type="browser"]</strong> Here <strong>browser</strong> is value of type.
Currently this plug-in supports two values of type, 1) <strong>cmd</strong> 2) <strong>browser</strong>.
If you not provide any <strong>type</strong> it will use <strong>cmd</strong> as by default type.


= How to use "title" Parameters with Shortcodes? =

Just add <strong>title</strong> with <strong>value</strong> in starting shortcode. For Example <strong>[output type="browser" title="Any thing you display in Title bar"]</strong>.
The <strong>value</strong> of <strong>title</strong> is display on Title Bar of browser output. The <strong>title</strong> is only work with <strong>type="browser"</strong>
If <strong>title</strong> is not specified in Shortcode, This Plug-in display <strong>New Tab</strong> on Title Bar of browser output by default.
The <strong>cmd</strong> is not support <strong>title</strong> parameter, as it only display <strong>Command Prompt</strong> on <strong>cmd</strong> Title Bar.

= How to use "header" Parameters with Shortcodes? =

This Plug-in is display <strong>Output:</strong> before it prints actual output.
If you have to change text of <strong>Output:</strong>, Just add <strong>header</strong> with <strong>value</strong> in starting shortcode.
For Example <strong>[output header="Result:]"</strong>. It will display <strong>Result:</strong> before prints actual output.
If don't want to display any header, Just add <strong>header</strong> with <strong>blank value</strong> in starting shortcode.
For Example <strong>[output header=""]</strong>. It will not display any header before prints actual output.

== Screenshots ==

1. This is Console (CMD) Output. Useful for Command Line Output such as C, C++, JAVA etc.
2. This is Browser Output. Useful for Web Languages such as ASP, PHP, JSP, HTML, JS, CSS etc.

== Changelog ==

= 1.0 =
* Created A New Plugin.
* No change.

== Upgrade Notice ==

= 1.1.0 =
* TinyMCE Buttons Added.
* Two Buttons Added to TinyMCE Editor.
1. Console Output Button
1. Browser Output Button

= 1.0 =
Created New Plugin no upgrade.

Features:

1. Formatted Program Output
1. Support Console Output (CMD)
1. Support Browser Output
