<?php
/**
* File: KbnBoardMinimal.php
* 
* Purpose: 
* Experimental minimal design for display on a public page.
* Notes shown by headlines.
* Inline CSS
*
* By: Per Thykjaer Jensen
* URL: http://multimusen.dk/
* Copyright: GPLv3 
* Date: 20130519
*/


/**
* Display the minimal kanban
**/

KbnGetHeaders(); 

include('config.php'); // settings file 
// include('iconPanel.php'); // icon panel

// echo "<div style='clear:both'> </div>"; // clear row

if(!isset($wpdb)){
	global $wpdb; // testing wp database connection
}
?>

<!-- KbnBoardMinimal -->

<div class="wrap">

<?php

/**
* Columns (basic layout)
*/
function KbnGetHeaders(){
	include('config.php');

	if(!isset($wpdb)){
		echo "WPDB - trying to reconnect to the db."; // functions need to call wpdb again for some reason
		global $wpdb;
	}


/**
* SELECTING THE NOTES
* (sql via join)

CHOOSE THE ACTIVE KANBAN
Below you can choose either the active kanban or a particular kanban using the id
uncomment what should be active
**/

$showKbn = 78; // in this case it's a test kanban
// $showKbn = $_SESSION['ActiveKanbanName']; // this will display whatever kanban is the active session

// SQL: combining two tables ordering by 'Order'
$getNotesSQL = "SELECT * FROM `kbnNotes`\n"
    . "INNER JOIN `KbnStates`\n"
    . "ON `KbnStates`.`Id`=`kbnNotes`.`KbnStatesId`\n"
    . "AND `kbnNotes`.`KbnProjectsId`=" . $showKbn  .    "\n"
    . "ORDER BY `KbnStates`.`Order`";

// Executing the query
	$KbnGetNote = $wpdb->get_results($getNotesSQL) or trigger_error(mysql_error()); 

// Looping through the array and formatting the HTML via CSS

	echo "<!-- Minimal Kanban Begins --> \n";
	
	foreach($KbnGetNote as $row){
		echo "<div style='
			position:relative;
        		float: left;
        		//height: 50px;
        		text-align: left;
        		padding: 10px 10px 10px 10px;
        		margin: 5px 5px 5px 5px;
        		width: 150px;
        		overflow: auto;
        		border: 1px solid black;
			background-color:"
			. $row->Color
			. "'>
			<div> <strong> $row->State </strong> <br /> </div> 
				 $row->Title 
			</div>";
			} // loop ends
		
	} // ends KbnGetHeaders() 

/**
* CRUD NOT IMPLEMENTED
* - But possible it is... (Yoda)

Below are the functions that will enable editing etc.
You may add logic displaying links or buttons invoking the options.
However in this case we're strictly minimal, hence the functions are not in use.

*/

 
/**
* Edit Form Inkluderes
*/

if(isset($_POST['EditKbnNote'])) {
	include('KbnNotes-edit.php'); 
}

/**
* UPDATE after edit
*/

/*
* Edit UPDATE SQL
*/

if (isset($_POST['NewNote'])) { 

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
				'Created' => $_POST['Created']
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
			),
			array(
			'%d'
			)
		
		);
	//$wpdb->last_query();		
	//$wpdb->show_errors();
}
else{
	// echo "Submit button in KbnNotes-edit.php doesn't work";
}

?>
</div>
