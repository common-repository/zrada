<?php
/**
 * @package Zrada
 * @version 0.3
 */
/*
Plugin Name: Zrada
Plugin URI: http://wordpress.org/plugins/zrada/
Description: Lets your users see word "Zrada" in admin_notices place of your site. In such a way you will show your attitude to the government of Ukraine.
Author: Alexander Butyuhin
Version: 0.3
Author URI: https://roboteye.biz/
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

function zrada_get_txt() {
	/** Different types of Zrada word to show user */
	$text = "Зрада!!!
Зрада не раптова, а, швидше за все, вона схожа на бомбу уповільненої дії.
Зрада! Іуди теж навчилися носити хрести.
Зрада! Немає сенсу обороняти фортецю, якщо всередині неї є зрадники, що допомагають ворогові.
ЗРАДА! Країна в небезпеці.
ЗРАДА!!! Президент продав Україну.
Зрада! Ціни ростуть.
Зрада!!! Немає долі...";

	// Here we split it into lines
	$text = explode( "\n", $text );

	// And then randomly choose a line
	return wptexturize( $text[ mt_rand( 0, count( $text ) - 1 ) ] );
}


function zrada_get_clr() {
	/** Different types of Zrada word color */
	$clr = array ('#e6194b', '#3cb44b', '#ffe119', '#4363d8', '#f58231', '#911eb4', '#46f0f0', '#f032e6', '#bcf60c', '#fabebe', '#008080', '#e6beff', '#9a6324', '#fffac8', '#800000', '#aaffc3', '#808000', '#ffd8b1', '#000075', '#808080', '#ffffff', '#000000');

	// And then randomly choose a line
	return wptexturize( $clr[ mt_rand( 0, count( $clr ) - 1 ) ] );
}


function zrada_get_size() {
	/** Different types of Zrada word size */
	$sze = array ('11px', '12px', '14px', '16px', '18px', '20px', '22px', '24px');

	// And then randomly choose a line
	return wptexturize( $sze[ mt_rand( 0, count( $sze ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function zrada() {
        // Get written form of Zrada
	$word_zrada = zrada_get_txt();
        
        //Get image of the Ukrainian Flag
        $zrada_image = plugins_url('zrada/image/flag_ua.png');
        
	echo "<p id='zrada'>$word_zrada <img src='$zrada_image'></p>";

}

function zrada2() {
        // Get written form of Zrada
	$word_zrada = zrada_get_txt();
        
        //Get image of the Ukrainian Flag
        $zrada_image = plugins_url('zrada/image/flag_ua.png');
        
	return "<p id='zrada'>$word_zrada <img src='$zrada_image'></p>";

}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'zrada' );

// We need some CSS to position the paragraph
function zrada_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';
        $zrada_color = zrada_get_clr();
        $zrada_size = zrada_get_size();
	echo "
	<style type='text/css'>
	#zrada {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: $zrada_size;
                color: $zrada_color;
	}
	</style>
	";
}

add_action( 'admin_head', 'zrada_css' );


// Adding Zrada before or after content
    function wpdev_before_after($content) {

        $x = zrada2();
        $rz = array ("<p id='zrada'>$word_zrada <img src='$zrada_image'></p>", '', $x);
        $beforecontent = wptexturize( $rz[ mt_rand( 0, count( $rz ) - 1 ) ] );
        $aftercontent = wptexturize( $rz[ mt_rand( 0, count( $rz ) - 1 ) ] );
        $fullcontent = $beforecontent . $content . $aftercontent;

        return $fullcontent;
    }
    add_filter('the_content', 'wpdev_before_after');

?>
