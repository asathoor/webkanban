<?php
/**
* Icon Menu
*/
echo "<div id='KbnIconMenu'>

	<ul class='KbnIconUl'>";


// Select active kanban
//echo "<li>";
//	include_once('KbnSettings.php');
//echo "</li>";

// New task icon
$icon = $fil = plugin_dir_url(__FILE__) . 'PNG/33.png'; // sti til ikonfil
echo "<li style='display: inline; margin:10px'><a href='admin.php?page=web_kanban'>
	<img src='$icon' alt='Home' />
	Kanban
	</a></li>";


// New task icon
$icon = $fil = plugin_dir_url(__FILE__) . 'PNG/14.png'; // sti til ikonfil
echo "<li style='display: inline; margin:10px'><a href='admin.php?page=Webkanban_New_Note'>
	<img src='$icon' alt='New Task' />
	Add New Task
	</a></li>";

// Select Board
$icon = $fil = plugin_dir_url(__FILE__) . 'PNG/48.png'; // sti til ikonfil
echo "<li style='display: inline; margin:10px'><a href='admin.php?page=Webkanban_Select'>
	<img src='$icon' alt='Select Board' />
	Select Board
	</a></li>";

// KbnBoards
$icon = $fil = plugin_dir_url(__FILE__) . 'PNG/33.png'; // sti til ikonfil
echo "<!-- li style='display: inline; margin:10px'><a href='admin.php?page=Webkanban_Projects_Editor'>
	<img src='$icon' alt='Kanban Boards' />
	Edit Kanban Boards
	</a></li -->";

// KbnLog
$icon = $fil = plugin_dir_url(__FILE__) . 'PNG/46.png'; // sti til ikonfil
echo "<li style='display: inline; margin:10px'><a href='admin.php?page=Webkanban_log_list'>
	<img src='$icon' alt='Log' />
	Log
	</a></li>";

// KbnLog
$icon = $fil = plugin_dir_url(__FILE__) . 'PNG/30.png'; // sti til ikonfil
echo "<li style='display: inline; margin:10px'><a href='http://multimusen.dk/wp-admin/admin.php?page=webkanban_help'>
	<img src='$icon' alt='Help' />
	Help
	</a></li>";


// ends the div
echo 	"	</ul>";

echo	"</div>";

?>
