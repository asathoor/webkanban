<?php
/*
* File: KbnSettings.php
* Purpose: Select a kanban
*/
if($_POST['KanbanChosen'] == 1){
		echo $_POST['Name'];
		$_SESSION['KbnActive'] = "MyKanban";
}
?>

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
