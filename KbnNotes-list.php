<? 
include('config.php');

/**
* Class creating buttons etc.
*/

class KbnProjects {

	// The edit form
	public function edit($action, $value) {
		return "<form action='"
		. $action
		."' method='post' enctype='multipart/form-data'>
			<button name='EditKbnNote' value='"
			. $value
			. "' type='submit'>Edit</button>
		</form>
		";
	}

	// The delete button
	public function delete($action, $deleteMe) {
		return "
		<form action='"
		. $action
		. "' method='post' enctype='multipart/form-data'>
			<button name='DeleteKanbanNote' value='"
			. $deleteMe
			."' type='submit'>Delete</button>
		</form>	";
		echo $deleteMe;
				

	}

	// The create a new entry button
	public function newKbn() {
		return "
		<form action='' method='post' enctype='multipart/form-data'>
			<button name='NewKbnProjectSubmit' value='value' type='submit'>New</button>
		</form>
		";
	}


}

$KbnNotesCRUD = new KbnProjects(); // klassen instantieres via config.php

/**
* Edit Form Inkluderes
*/

if(isset($_POST['EditKbnNote'])) {
	include('KbnNotes-edit.php'); 
}

/**
* New Entry in the log
*/

if(isset($_POST['NewKbnProjectSubmit'])) {
      include('KbnNotes-new.php'); // redigerer felterne
}

/**
* New Entry Entered in DB
*/

if (isset($_POST['NewKanbanNote'])) { 

	// a la codex
	$wpdb->insert(
		'kbnNotes',
		array(
			'Id' => NULL,
			'KbnProjectsId' => $_POST['KbnProjectsId'],
			'KbnStatesId' => $_POST['KbnStatesId'],
			'Title' => $_POST['Title'],
			'What' => $_POST['What'],
			'Who' => $_POST['Who'],
			'StartDate' => $_POST['StartDate'],
			'DeadLine' => $_POST['DeadLine'],
			'Created' => date('Y-m-d'),
			'URL' => '',
			'Image' => ''
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

		)

	);

}
else { 
	// echo "Cannot find POST SUBMIT=OK<br> POST = " . $_POST['subl']; 
}

/**
* Delete
*/

if(isset($_POST['DeleteKanbanNote'])) {
      echo "<p>Ok DeleteKanbanNote er aktiv, prøver ihærdigt at slette note nr.: " . $_POST['DeleteKanbanNote'] ; // Har vaerdien 'value' ;-)
      $sql = "DELETE FROM `kbnNotes` WHERE `Id` =" . $_POST['DeleteKanbanNote'] . ";";
      echo "<p>" .$sql;
      $wpdb->query($sql);
}

/**
* Detect if new Log post is created
*/

if (isset($_POST['KbnProjectSubmitted'])) { 
	foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
	$sql = "INSERT INTO `KbnProjects` ( `Id` ,  `Name`) VALUES(  '{$_POST['Id']}' ,  '{$_POST['Name']}'); "; 
	$wpdb->query($wpdb->prepare($sql)); // Query
	echo "Added row.<br />"; 
	}

/*
*** Edit UPDATE SQL ***
*/

if (isset($_POST['NewNote'])) { 

// virker Newnote??
echo "NewNote virker";

// test
print_r($_POST);
   			  
	// update the note

// removed...
// 'Id' => NULL,

	$wpdb->update(
			"kbnNotes",
			array(
				'KbnProjectsId' => $_POST['EditedKbnBoard'],
				'KbnStatesId' => $_POST['KbnStatesId'],
				'Title' => $_POST['Title'],
				'What' => $_POST['What'],
				'Who' => $_POST['Who'],
				'StartDate' => $_POST['StartDate'],
				'DeadLine' => $_POST['DeadLine'],
				'Created' => date('Y-m-d'),
				'URL' => '',
				'Image' => ''
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
		echo "Note updated.";

	// add to log
		$wpdb->insert(
			"KbnLog",
			array(
				'Id' => NULL,
				'What' => $_POST['What'],
				'KbnNotesId' => $_POST['Id'],
				'KbnStatesId' => $_POST['KbnStatesId'],
				'KbnProjectsId' => $_POST['KbnProjectsId'],
				'KbnNotesName' => $_POST['Title'],
				'Date' => date('Y-m-d G:i:s')
			),
			array(
				'%d', '%s', '%d', '%d', '%d', '%s', '%s'
			)
		);
		echo "<br /> Log updated.";

		
}
else{
	// echo "Submit button in KbnNotes-edit.php doesn't work";
}

/**
* Table 
*/
screen_icon();
echo "<div class='wrap'>";
echo "<h2>Kanban Notes Editor</h2>";
echo "<table class='widefat fixed' cellspacing='0'>"; 
echo "<caption>  Kanban States  </caption>
<tr>
  <th >Id</th>
  <th >KbnProjects_Id</th>
  <th >KbnStates_Id</th>
  <th >Title</th>
  <th >What</th>
  <th >Who</th>
  <th >StartDate</th>
  <th >DeadLine</th>
  <th >Created</th>
  <th >Edit</th>
  <th >URL</th>
  <th >Image</th>
</tr>

";
 
$result = $wpdb->get_results("SELECT * FROM `kbnNotes`") or trigger_error(mysql_error()); 
// print_r($result);
// td model 	echo "<td class='manage-column column-columnname'>" . $row->Id . "</td>";  

foreach($result as $row){
	echo "
		<tr class='odd'>
			<td align='right' class='data grid_edit not_null    nowrap '>$row->Id</td>
			<td align='right' class='data grid_edit not_null    nowrap '>$row->KbnProjectsId</td>
			<td align='right' class='data grid_edit not_null    nowrap '>$row->KbnStatesId</td>
			<td align='left' class='data grid_edit not_null   '>$row->Title</td>
			<td align='left' class='data grid_edit not_null   '>$row->What</td>
			<td align='left' class='data grid_edit not_null   '>$row->Who</td>
			<td  class='data grid_edit not_null   datefield nowrap '>$row->StartDate</td>
			<td  class='data grid_edit not_null   datefield nowrap '>$row->DeadLine</td>
			<td  class='data grid_edit not_null   datetimefield nowrap '>$row->Created</td>
			<td align='left' class='data grid_edit not_null   '>$row->URL</td>
			<td align='left' class='data grid_edit not_null   '>$row->Image</td>
	";

	// buttons 
	echo "<td class='manage-column column-columnname'>" 
	. $KbnNotesCRUD->edit('', $row->Id)
	. $KbnNotesCRUD->delete('', $row->Id) 
	. $KbnNotesCRUD->newKbn()
	.  "</td> "; // formatterer knapperne og giver dem en value
	echo "</tr>"; 
}

echo "</table>";
echo "</div>";

// test

?>
