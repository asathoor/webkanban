<?php
/**
* KANBAN - MENUS FOR THE DASHBOARD
* Project: webkanban
*/


/**
* The Menu
*/

// hooks into the menu
add_action( 'admin_menu', 'kbn_webkanban' );

// the menu
function kbn_webkanban() {
	add_menu_page( 'Kanban Log', 'Kanban', 'edit_posts', 'web_kanban', 'kanban_plugin_options' );
	add_submenu_page('web_kanban', 'Webkanban', 'Minimal board', 'edit_posts', 'Webkanban_board_minimal_view', 'KbnBoardMinimal' );
	add_submenu_page('web_kanban', 'Webkanban', 'Select Board', 'edit_posts', 'Webkanban_Select', 'KbnSelect' );
	add_submenu_page('web_kanban', 'Webkanban', 'New task', 'edit_posts', 'Webkanban_New_Note', 'WebKanbanNewNote' );
	add_submenu_page('web_kanban', 'Webkanban', 'Log', 'edit_posts', 'Webkanban_log_list', 'KbnLog_menu' );
//	add_submenu_page('web_kanban', 'Webkanban', 'Settings', 'edit_posts', 'Webkanban_Settings', 'WebKanbanSettings' );
	add_submenu_page('web_kanban', 'Webkanban', 'Kanban Boards', 'edit_posts', 'Webkanban_Projects_Editor', 'KbnProjectsEditor' );
	add_submenu_page('web_kanban', 'Webkanban', 'Settings: Notes, States and Colors', 'edit_posts', 'Webkanban_edit_states', 'KbnEditStates_menu' );
//	add_submenu_page('web_kanban', 'Webkanban', 'Show all Notes', 'edit_posts', 'Webkanban_edit_notes', 'KbnEditNotes_menu' );
//	add_submenu_page('web_kanban', 'Webkanban', 'Add Image', 'edit_posts', 'kbn_add_image', 'KbnAddImage' );
	add_submenu_page('web_kanban', 'Webkanban', 'Litterature list', 'edit_posts', 'Webkanban_litterature', 'KbnLitterature' );
	add_submenu_page('web_kanban', 'Webkanban', 'Help', 'edit_posts', 'webkanban_help', 'KbnHelp' );
}

// view main kanban board
function kanban_plugin_options() {
	include('KbnBoard.php');
}

// new note
function WebKanbanNewNote(){
	include('KbnNotes-new.php');
	};

// new note
function KbnSelect(){
	include('KbnSelect.php');
	};

// submenu kanban states editor
function KbnEditStates_menu(){
	include('KbnStates-list.php');
}

// submenu kanban projects editor
function KbnProjectsEditor(){
	include('KbnProjects-list.php');
}

// submenu kanban notes editor
function KbnEditNotes_menu(){
	include('KbnNotes-list.php');
}

// submenu that will not show ud in the menu
function KbnEditThisNote(){
	require_once('KbnNotes-edit.php');
	}
function KbnBoardMinimal(){
	require_once('KbnBoardMinimal.php');
	}

function KbnAddImage(){
	require_once('KbnNotes-img.php');
	}

function KbnLog_menu(){
	require_once('KbnLogList.php');
	}

function WebKanbanSettings(){
	require_once('KbnSettings.php');
	}

function KbnLitterature(){
	require_once('littList.php');
}

function KbnHelp(){
	require_once('help.php');
}

/**
* Brugermenu
* Hooks into options-general.php 
*/
/*
add_action('admin_menu', 'register_my_custom_submenu_page');

function register_my_custom_submenu_page() {
	add_submenu_page( 'options-general.php', 'Kanban', 'Kanban', 'manage_options', 'kanbanLog-custom-submenu-page', 'kbnMenu_callback' ); 
}

function kbnMenu_callback() {
	echo "<div class='wrap'>";
	//screen_icon();
	echo "<h1>Kanban Settings</h1>";
	//include('log-new.php');
	//include('log-list.php');
	//include('native-wp-tables.php');
	//include('KbnProjects-list.php');

	echo "</div>";
}
*/
?>
