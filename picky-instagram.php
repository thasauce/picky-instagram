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

add_action('admin_init', 'picky_instragram_intialize');
function picky_instagram_intialize(){
	add_settings_sections('picky_instagram_settings_section', 'Picky Instagram Settings', '', 'picky_instagram' );
}

/* Add Options Page */
function picky_instagram_add_menu() {
	add_submenu_page('options-general.php', 'Picky Instagram', 'Picky Instagram', 'administrator', 'picky_instagram', 'picky_instagram_display_page');
}
add_action('admin_menu', 'picky_instagram_add_menu');

function picky_instagram_display_page(){ ?>
	<div class="wrap">
		<h2>Sticky Instagram</h2>
	</div>
<?php }