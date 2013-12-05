<?php
/*
* File: KbnSelectBoardAndStates.php
* Purpose: Set state and save it in a session
*/
include_once('config.php');
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

<!-- Display the note -->
<?
if($_POST['NewKanbanChosen']==1){
	$_SESSION['ActiveKanbanName'] = $_POST['SelectAKanban'];
	echo "OK, I'll remember your choice. The active kanban is: ";
}
else {
	echo "Please select a kanban board.";
}
?>
