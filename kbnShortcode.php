<?php
/*
The shortcode [MiniKanban] for pages etc.
*/

function register_shortcode(){
	add_shortcode('MiniKanban', 'MiniKanban');
}

function MiniKanban(){
	include('KbnBoardMinimal.php');
}

add_action('init','register_shortcode');

/**
* The Shortcode [WebKanban] for bigger screens ...
**/
/*
function reg_webkanban(){
        add_shortcode('WebKanban', 'WebKanban');
}

function WebKanban(){
	// echo "Heeeeeloooo Wooooooooorrrrrrrrrlllllld";
        include('KbnBoardPublic.php');
}

add_action('init','reg_webkanban');
*/
?>
