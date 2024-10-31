<?php
/*
Plugin Name: Program Output
Plugin URI: https://wordpress.com/program-output
Description: This Plug-in is usefull to developers blog, for display program code output.
Version: 1.1.0
Author: Vicky Agravat
Author URI: https://profiles.wordpress.org/vickyagravat
License: GPLv2 or later
Text Domain: program output
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// WP version check
global $wp_version;
if(version_compare($wp_version, "2.5", "<")) {
	$exit_msg='Program Output Plug-in requires WordPress 2.5 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update Wordpress!</a>';
	exit ($exit_msg);
}

// deffine plugin version
$plugin_data = get_file_data(__FILE__, array('Version' => 'Version'), false);
define('PROGRAM_OUTPUT_PLUGIN_VERSION', $plugin_data['Version'] );
// deffine plugin name or base file name
define('PROGRAM_OUTPUT_PLUGIN_NAME', __FILE__);
// deffine plugin uri
define('PROGRAM_OUTPUT_PLUGIN_URI', plugins_url('', __FILE__));

// Include File
if(file_exists(dirname( __FILE__ ) . '/includes/program-output-functions.php')){
	require_once dirname( __FILE__ ) . '/includes/program-output-functions.php';
};