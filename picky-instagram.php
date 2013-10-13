<?php
/**
 * Plugin Name: Picky Instagram
 * Plugin URI: https://github.com/thasauce/picky-instagram/
 * Description: A WordPress plugin for choosing photos from an instagram steam to show on your website.
 * Version: 0.0.1
 * Author: ThaSauce Network, LLC
 * Author URI: https://github.com/thasauce
 * License: MIT
 * License URI: https://github.com/thasauce/picky-instagram/blob/master/LICENSE
 */

/* Create Plugin Admin Page */
function picky_instagram_display_page(){ ?>
	<div class="wrap">
        <div id="icon-themes" class="icon32"></div> 

		<h2>Picky Instagram</h2>
		<?php settings_errors(); ?>

        <form action="options.php" method="post">  
            <?php   
            	settings_fields('picky_instagram');   
            	do_settings_sections('picky_instagram');   
            ?>  
              
			<?php submit_button(); ?> 
        </form> 
    </div>
<?php }


/* Create Sub-Menu Item for Plugin */
function picky_instagram_add_menu() {
	add_submenu_page('options-general.php', 'Picky Instagram', 'Picky Instagram', 'administrator', 'picky_instagram', 'picky_instagram_display_page');
}

/* Add Sub-Menu Item to Settings Top-Menu */
add_action('admin_menu', 'picky_instagram_add_menu');

/* Initialize plugin */ 
add_action('admin_init', 'picky_instagram_initialize');
function picky_instagram_initialize(){
	// If the options don't exist, create them.  
    if( false == get_option( 'picky_instagram' ) ) {    
        add_option( 'picky_instagram' );
    }

	add_settings_section('picky_instagram_settings_section', 'Picky Instagram Settings', 'picky_instagram_settings_section_description', 'picky_instagram' );

	add_settings_field(
		'picky_instagram_userid',
		'Instagram User ID',
		'picky_instagram_callback',
		'picky_instagram',
		'picky_instagram_settings_section',
		array('picky_instagram_userid', 'text')
	);

	add_settings_field(
		'picky_instagram_accessid',
		'Instagram Access ID',
		'picky_instagram_callback',
		'picky_instagram',
		'picky_instagram_settings_section',
		array('picky_instagram_accessid', 'text')
	);

	add_settings_field(
		'picky_instagram_searchtype',
		'Instagram Search Type',
		'picky_instagram_callback',
		'picky_instagram',
		'picky_instagram_settings_section',
		array('picky_instagram_searchtype', 'radio', array('Username', 'Hashtag'))
	);

	add_settings_field(
		'picky_instagram_searchterm',
		'Instagram Search Term',
		'picky_instagram_callback',
		'picky_instagram',
		'picky_instagram_settings_section',
		array('picky_instagram_searchterm', 'text')
	);


	register_setting('picky_instagram', 'picky_instagram');

}

function picky_instagram_callback($arg) { 
	$pi_options = get_option( 'picky_instagram' );

	$value = array_key_exists($arg[0], $pi_options) ? $pi_options[$arg[0]] : '';

	switch ($arg[1]) {
		case 'text':
			echo '<input type="text" id="' . $arg[0] . '" name="picky_instagram[' . $arg[0] . ']" value="' . $value . '"></input>';
			break;
		case 'radio':
		default:
			for($i = 0; $i < count($arg[2]); $i++) {
				$checked = ($value == $i) ? 'checked' : '';
				echo '<label><input type="radio" name="picky_instagram[' . $arg[0] . ']" value="' . $i . '" ' . $checked . '></input> '. $arg[2][$i] .'</label><br />';
			}
			break;
	}
}

function picky_instagram_settings_section_description() {
	echo 'My dick.';
}