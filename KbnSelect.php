<?php
/*
* File: KbnSelectBoardAndStates.php
* Purpose: Set state and save it in a session
*/
include_once('config.php');

if(!isset($wpdb)){
	"wpdb not found";
	global $wpdb;
}

?>

<!-- Select Kanban -->
<h2>Select Kanban Board</h2>
<form action='#' method='POST' enctype='multipart/form-data'>
	<select name='SelectAKanban'>

		<? // echo options from database
		$selected = $wpdb->get_results("SELECT * FROM `KbnProjects`");
			foreach($selected as $row){
			echo "<option value='{$row->Id}'> $row->Name </option>";
			}
		?>

	</select>
	<button name='NewKanbanChosen' value='1' type='submit'>Change kanban board</button>
</form>

<?
if($_POST['NewKanbanChosen']==1){
	$_SESSION['ActiveKanbanName'] = $_POST['SelectAKanban'];
		echo "Ok, Kanban chosen. 
		<a href='admin.php?page=web_kanban'>Click here to continue</a>
		";
		//require('KbnBoard.php');
		//KbnGetHeaders($_SESSION['ActiveKanbanName']);
}
if(isset($_SESSION['ActiveKanbanName'])){
	$showName = $wpdb->get_results("SELECT * FROM `KbnProjects` WHERE `Id` = {$_SESSION['ActiveKanbanName']} ");

	foreach($showName as $row){
	// echo $row->Name;
	$_SESSION['ActiveKanbanTitle'] = $row->Name;
	//include_once('iconPanel.php');
	}

}
else {
	echo "Please select a kanban board.";
}
?>
