<?php
//-----------------------------------------------------
// Front End
//-----------------------------------------------------

/**
 * Prepare output of shortcode.
 */
function program_output_shortcode($atts = [], $content = null, $tag = '') {
    // Normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);

	// if type is set to empty string, it will be set to console.
	if(empty($atts['type'])) {
		$atts['type'] = 'cmd';
	}
	// Override default attributes with user attributes
    $output_atts = shortcode_atts(
		[
			'title' => '',
			'type' => 'cmd',
			'header' => 'Output:'
		], $atts, $tag);

	// Check if output type is cmd, then title would be Command Prompt.
	if($output_atts['type'] == 'cmd') {
		$output_atts['title'] = 'Command Prompt';
	}

	// Check if output type is browser and title is empty, add Untitled.
	if($output_atts['type'] == 'browser' && $output_atts['title'] == '') {
		$output_atts['title'] = 'New Tab';
	}

	// Start output
    $output= '';
	if(!empty($output_atts['header'])) {
		$output= '<h3>' . esc_html__($output_atts['header'] , 'output') . '</h3>';
	}
    // Start program-output box
    $output.= '<div id="program-output" class="' . esc_html__($output_atts['type'], 'output') . '">';
    $output.= '<div class="title-bar">';
    // title
    $output.= '<div class="title">' . esc_html__($output_atts['title'], 'output') . '</div>';
	$output.= '</div>';

	$output.= '<div class="body">';

	// Enclosing tags
    if (!is_null($content)) {
        // secure output by executing the_content filter hook on $content
        apply_filters('the_content', $content);
        // run shortcode parser recursively
        $output.= do_shortcode($content);
    }

	$output.= '</div>';
    $output.= '</div>';
    // end box

    // return output
    return $output;
}

/**
 *  Intitializes the plugin shortcode
 */
function program_output_shortcodes_init()
{
    add_shortcode('output', 'program_output_shortcode');
}
add_action('init', 'program_output_shortcodes_init');

/**
 *  Enqueue stylesheet
 */
function program_output_enqueue_style() {
	wp_enqueue_style( 'program-output', PROGRAM_OUTPUT_PLUGIN_URI . '/public/css/style.css', array(), PROGRAM_OUTPUT_PLUGIN_VERSION );
}
add_action('wp_head', 'program_output_enqueue_style');

//-----------------------------------------------------
// Admin Side
//-----------------------------------------------------

/**
 * Add Settings Page to Admin Menu
 */
function program_output_admin_page() {
    if (function_exists('add_submenu_page'))
        add_options_page(__('Program Output Settings'), __('Program Output'), 'manage_options', 'program-output', 'program_output_settings_page');
}
add_action('admin_menu', 'program_output_admin_page');

/**
 * Add Settings link to plugin page
 */
function program_output_add_settings_link($links, $file) {
	if ( $file == plugin_basename( PROGRAM_OUTPUT_PLUGIN_NAME ) ) {
      $links[] = '<a href="options-general.php?page=program-output">' . __('Settings') . '</a>';
    }
    return $links;
}
add_filter('plugin_action_links', 'program_output_add_settings_link', 10, 2);

/**
 * Register and enqueue a custom stylesheet in the WordPress admin.
 */
function program_output_enqueue_custom_admin_style_script() {
   global $pagenow;
    if ($pagenow != 'options-general.php') {
        return;
    }
	wp_register_style( 'program-output-admin-css', PROGRAM_OUTPUT_PLUGIN_URI . '/admin/css/style.css', false, PROGRAM_OUTPUT_PLUGIN_VERSION );
	wp_enqueue_style( 'program-output-admin-css' );
	// Add inline js code.
	if ( ! wp_script_is( 'jquery', 'done' ) ) {
		wp_enqueue_script( 'jquery' );
	}
	$script_code = '
	(function($) {
	  $(document).ready(function(){
		$("#browser, #cmd").click(function(){
		  $(this).select();
		  return false;
		})
	 });
	}(jQuery));';
	wp_add_inline_script( 'jquery-migrate', $script_code );
}
add_action( 'admin_enqueue_scripts', 'program_output_enqueue_custom_admin_style_script' );

/**
 * Program Output Settings Page
 */
function program_output_settings_page() {
?>
    <!-- html code of settings page -->
    <div class="wrap">
        <div class="section">
			<h1>Program Output</h1>
			<p>This plug-in is currently allows you two type of outputs to display.</p>
			<p>
				1. CMD (Consloe Output)<br />
				2. Browser Output
			</p>
		</div>
		<div class="row">
			<div class="col-md-6">
				<h3>CMD Output</h3>
				<p>CMD output is helpfull to display console type output of any Programming languages such as C, C++, JAVA etc.</p>
				<h3>Program:</h3>
				<p>Here is example of a C Language program.</p>
<?php /* The indent of this <pre> is 0, because it should dispaly as it is. */ ?>
<pre class="hljs cpp">
<span class="hljs-meta">#<span class="hljs-meta-keyword">include</span><span class="hljs-meta-string">&lt;stdio.h&gt;</span></span>
<span class="hljs-function"><span class="hljs-keyword">void</span> <span class="hljs-title">main</span><span class="hljs-params">()</span>
</span>{
    <span class="hljs-built_in">printf</span>(<span class="hljs-string">"Hello World"</span>);
}</pre>
				<div class="op">
					<h3>Output:</h3>
					<div id="program-output" class="cmd">
						<div class="title-bar">
							<div class="title">Command Prompt</div>
						</div>
						<div class="body">Hello World</div>
					</div>
				</div>
				<label for="cmd"><abbr title="Copy Short code and paste it on your post"><?php echo __('Shortcode', 'program-output') ?></abbr></label><br />
				<input type="text" name="cmd" value="<?php echo esc_html('[output type="cmd"]Hello World[/output]'); ?>" id="cmd" />
			</div>

			<div class="col-md-6">
				<h3>Browser Output</h3>
				<p>Browser output is helpfull to display WEB technologies languages such as PHP, ASP.NET, JSP, JS or Markup language such as HTML or CSS witch output is display on browser.</p>
				<h3>Program:</h3>
				<p>Here is example of a PHP program.</p>
<?php /* The indent of this <pre> is 0, because it should dispaly as it is. */ ?>
<pre class="hljs php">

<span class="php"><span class="hljs-meta">&lt;?php</span>
    <span class="hljs-keyword">echo</span> <span class="hljs-string">"Hello World"</span>;
<span class="hljs-meta">?&gt;</span></span>

</pre>
				<div class="op">
					<h3>Output:</h3>
					<div id="program-output" class="browser">
						<div class="title-bar">
							<div class="title">New Tab</div>
						</div>
						<div class="body">Hello World</div>
					</div>
				</div>
				<label for="browser"><abbr title="Copy Short code and paste it on your post"><?php echo __('Shortcode', 'program-output') ?></abbr></label><br />
				<input type="text" name="browser" value="<?php echo esc_html('[output type="browser"]Hello World[/output]'); ?>" id="browser" />
			</div>
		</div>
        <div class="section">
			<h1>How to use</h1>
			<p class="que">Q. How to use Shortcodes?</p>
			<p class="ans">A. Just add <b><?php echo esc_html('[output]'); echo "</b> <i>Text to Display</i> <b>"; echo esc_html('[/output]'); ?></b> to your Post or Page.</p>

			<p class="que">Q. How to use Shortcodes with Parameters?</p>
			<p class="ans">A. This plug-in accepts three parameters with Shortcodes. 1) <b>type</b> 2) <b>title</b> 3) <b>header</b> all three are optional.

			<p class="que">Q. How to use "type" Parameters with Shortcodes?</p>
			<p class="ans">A. Just add <b>type</b> with <b>value</b> in starting shortcode. For Example <b><?php echo esc_html('[output type="browser"]'); ?></b> Here <b>browser</b> is value of type.</p>
			<p class="ans"> &nbsp;&nbsp;&nbsp;&nbsp;Currently this plug-in supports two values of type, 1) <b>cmd</b> 2) <b>browser</b>.</p>
			<p class="ans"> &nbsp;&nbsp;&nbsp;&nbsp;If you not provide any <b>type</b> it will use <b>cmd</b> as by default type.</p>

			<p class="que">Q. How to use "title" Parameters with Shortcodes?</p>
			<p class="ans">A. Just add <b>title</b> with <b>value</b> in starting shortcode. For Example <b><?php echo esc_html('[output type="browser" title="Any thing you display in Title bar"]'); ?></b>.</p>
			<p class="ans"> &nbsp;&nbsp;&nbsp;&nbsp;The <b>value</b> of <b>title</b> is display on Title Bar of browser output. The <b>title</b> is only work with <b>type="browser"</b></p>
			<p class="ans"> &nbsp;&nbsp;&nbsp;&nbsp;If <b>title</b> is not specified in Shortcode, This Plug-in display <b>New Tab</b> on Title Bar of browser output by default.</p>
			<p class="ans"> &nbsp;&nbsp;&nbsp;&nbsp;The <b>cmd</b> is not support <b>title</b> parameter, as it only display <b>Command Prompt</b> on <b>cmd</b> Title Bar.</p>

			<p class="que">Q. How to use "header" Parameters with Shortcodes?</p>

			<p class="ans">A. This Plug-in is display <b>Output:</b> before it prints actual output.</p>
			<p class="ans"> &nbsp;&nbsp;&nbsp;&nbsp;If you have to change text of <b>Output:</b>, Just add <b>header</b> with <b>value</b> in starting shortcode.</p>
			<p class="ans"> &nbsp;&nbsp;&nbsp;&nbsp;For Example <b><?php echo esc_html('[output header="Result:]"'); ?></b>. It will display <b>Result:</b> before prints actual output.</p>
			<p class="ans"> &nbsp;&nbsp;&nbsp;&nbsp;If don't want to display any header, Just add <b>header</b> with <b>blank value</b> in starting shortcode.</p>
			<p class="ans"> &nbsp;&nbsp;&nbsp;&nbsp;For Example <b><?php echo esc_html('[output header=""]'); ?></b>. It will not display any header before prints actual output.</p>
			<hr />
			<p class="ans">Note: This plugin is only display formated output, not program!</p>
		</div>
	</div>
    <!-- /html code of settings page -->
<?php
}

add_action( 'admin_init', 'my_tinymce_button' );

function my_tinymce_button() {
     if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
          add_filter( 'mce_buttons', 'my_register_tinymce_button' );
          add_filter( 'mce_external_plugins', 'my_add_tinymce_button' );
     }
}

function my_register_tinymce_button( $buttons ) {
     array_push( $buttons, "button_console", "button_browser" );
     return $buttons;
}

function my_add_tinymce_button( $plugin_array ) {
     $plugin_array['my_button_script'] = PROGRAM_OUTPUT_PLUGIN_URI . '/admin/js/tinymice-buttons.js' ;
     return $plugin_array;
}