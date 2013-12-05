<?php
/**
* File: KbnBoard.php
* Purpose: view the webkanban, CRUD notes
*/

include('config.php');

if(!isset($wpdb)){
	echo "the WPDB class not found";
}

/**
* Display the kanban board
*/
echo 	"
	<div class='wrap'>
		<div id='icon-edit-pages' class='icon32'></div>
			<h2>Kanban Board: ";
	echo $_SESSION['ActiveKanbanTitle'];
	echo "</h2>";

echo	"	<div style='clear:both;margin-left: auto;margin-right: auto'>";

include_once('iconPanel.php'); // menu of icons

echo "<div style='width:100%;clear:both'>";

/**
* FUNCTION DISPLAYING THE KANBAN
* the attribute will select a kanban project by that name
*/

function KbnGetHeaders($KanbanName){
	include('config.php');
	
	if(!isset($wpdb)){
		echo "WPDB MISSING"; // fik fejlmedd. om query on non-object, fordi wpdb manglede
	}

	/**
	* Selecting the active kanban by id derived from name
	*/

	// get name and id from KbnProjects
	if($KanbanName == 777){
		// selecting all
		// echo "Okidoki";
		$KanbanSelector = $wpdb->get_results("SELECT * FROM `KbnProjects`") or trigger_error(mysql_error());
	}
	else{
		// echo "blah blah";
		$KanbanSelector = $wpdb->get_results("SELECT * FROM `KbnProjects` WHERE `Id` = '$KanbanName'") or trigger_error(mysql_error());
	}

	// defines Name and Id for active kanban board
	foreach($KanbanSelector as $row) {
		// echo 'Id: ' . $row->Id . ' Name: ' . $row->Name;
		$KbnId = $row->Id;
		$KbnName = $row->Name;
	}

	// Selects the kanban to display ($KbnId)
	$KbnBoardHeaders = $wpdb->get_results("SELECT * FROM `KbnStates` WHERE `KbnProjectsId` = $KbnId ORDER BY `Order`") or trigger_error(mysql_error()); 

	// Headers and div begin
	foreach($KbnBoardHeaders as $row){

		$bredde =  (floor(100 / count($KbnBoardHeaders))) - 3;
		
		if($row->Limit > 0){
			$limit = '(' . $row->Limit . ')';
		}
		else {
			$limit = '';
		}
	
		echo "<div class='KbnHead' style='float: left;width:"
			. (string)$bredde 
			. "%;margin:5px; border: thin solid #000; padding: 5px; text-align: center; -moz-border-radius: 10px;-webkit-border-radius: 10px;-khtml-border-radius: 10px;border-radius: 10px; background-color:"
			. $row->Color
			. "'> <h3>" 
		. $row->State 
		. "  $limit </h3>
		";

	// get the notes
	$getNotesSQL = "SELECT * FROM `kbnNotes` WHERE `KbnStatesId` = $row->Id ORDER BY `DeadLine` ASC";
	
	$KbnGetNote = $wpdb->get_results($getNotesSQL) or trigger_error(mysql_error()); 

	foreach($KbnGetNote as $row){
		echo "<div class='KbnNote'>
			<strong>";
			
			// link or just the title
			if($row->URL > ''){
				echo "<a href='$row->URL'> $row->Title </a>";
			}
			else{
				echo $row->Title;
			}

			// if image exists display it on the screen
			if($row->Image > ''){
				echo "<img src='$row->Image' alt='$row->Title' class='KbnImage' width='100%' height='*' />";
			}

		echo "</strong><br />
			Who: $row->Who <br />
			Start: $row->StartDate<br />
			Deadline $row->DeadLine<br />
			

			<form method='post' enctype='multipart/form-data' action='#'>
			<input type='hidden' name='EditKbnNote' value='$row->Id' />
			<button name='KbnNoteEdit' value='KbnNoteUpdated'>Edit</button>
			<button name='DeleteKanbanNote' value='$row->Id'>Delete</button>
			</form>
			</div>";

	}

		echo "</div>";
		}
}

/**
* NEW
*/
if(isset($_POST['NewKanbanNote'])){
	unset($_POST['EditKbnNote']);
}


/**
* DELETE A NOTE
*/

if(isset($_POST['DeleteKanbanNote'])) {
	$sql = "DELETE FROM `kbnNotes` WHERE `Id` =" . $_POST['DeleteKanbanNote'] . ";";
	$wpdb->query($sql);
	unset($_POST['EditKbnNote']);
	// echo "Note deleted.";
}

/**
* EDIT Form Inkluderes
*/

if(isset($_POST['EditKbnNote'])) {
	include('KbnNotes-edit.php'); 
}

/*
* UPDATE SQL
*/

if (isset($_POST['NewNote'])) { 
	//echo "Note KbnNoteEdited er sat";
	$wpdb->update(
			'kbnNotes',
			array(
				'Id' => $_POST['Id'],
				'KbnProjectsId' => $_POST['KbnProjectsId'],
				'KbnStatesId' => $_POST['KbnStatesId'],
				'Title' => $_POST['Title'],
				'What' => $_POST['What'],
				'Who' => $_POST['Who'],
				'StartDate' => $_POST['StartDate'],
				'DeadLine' => $_POST['DeadLine'],
				'Created' => $_POST['Created'],
				'URL' => $_POST['URL'],
				'Image' => $_POST['Image'],
			),
			array(
				'ID' => $_POST['Id']
			),
			array(
			'%d',
			'%d',
			'%d',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s'
			),
			array(
			'%d'
			)
		
		);


		// get the state name
		$KbnStateName = $wpdb->get_results("SELECT `State` FROM `KbnStates` WHERE `Id` =" . $_POST['KbnStatesId'] . ";");
		// print_r($KbnStateName);
		foreach($KbnStateName as $row){
			$KbnState = $row->State;
		}

		// add to the log
		$wpdb->insert(
			"KbnLog",
			array(
				'Id' => NULL,
				'What' => $_POST['What'],
				'KbnNotesId' => $_POST['Id'],
				'KbnStatesId' => $_POST['KbnStatesId'],
				'KbnProjectsId' => $_POST['KbnProjectsId'],
				'KbnNotesName' => date('Y-m-d H:i:s') . '<br /><strong>' . $_POST['Title'] . '</strong><br />' . $_POST['What'] . ' Team: ' . $_POST['Who'] .  '. Deadline: ' . $_POST['DeadLine'] . '. Startdate: ' . $_POST['StartDate'] . '<br /> State: ' . $KbnState,
				'Date' => date('Y-m-d H:i:s')
			),
			array(
				'%d', '%s', '%d', '%d', '%d', '%s', '%s'
			)
		);
}
else{
	// echo "Submit button in KbnNotes-edit.php doesn't work";
}

/*
* Show the kanbans
*/

// select the active kanban board
if(isset($_SESSION['ActiveKanbanName'])){
	KbnGetHeaders($_SESSION['ActiveKanbanName']); // display alternative kanban		
}
else {
	// the board displayed if the user has not set an active board
	// default is KbnGetHeaders(777);
	// KbnGetHeaders(777); // will show all notes			
	KbnGetHeaders(78); 
}

?>



	</div>
</div>
