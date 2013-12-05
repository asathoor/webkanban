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
			<button name='EditKbnProject' value='"
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
			<button name='DeleteKanbanProject' value='"
			. $deleteMe
			."' type='submit'>Delete</button>
		</form>	";
		echo $deleteMe;
				

	}

	// The create a new entry button
	public function newKbn() {
		return "
		<form action='' method='post' enctype='multipart/form-data'>
			<button name='NewKbnProjectSubmit' value='value' type='submit'>New Kanban Board</button>
		</form>
		";
	}
}

$KbnProjectsCRUD = new KbnProjects(); // klassen instantieres via config.php

/**
* Edit Form Inkluderes
*/

if(isset($_POST['EditKbnProject'])) {
	include('KbnProjects-edit.php'); 
}

/**
* New Entry in the log
*/

if(isset($_POST['NewKbnProjectSubmit'])) {
      include('KbnProjects-new.php'); // redigerer felterne
}

/**
* New Entry Entered in DB
*/

if (isset($_POST['NewKbnProjectSubmit2'])) { 
	// foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
	$sql = "INSERT INTO `KbnProjects` (`Name`) VALUES( '{$_POST['Name']}' ); "; // Id kan ikke indsaettes, autopdaterer
	$wpdb->query($wpdb->prepare($sql)); // Query
} 



/**
* Delete
*/

if(isset($_POST['DeleteKanbanProject'])) {
      echo $_POST['Kanban Project']; // Har vaerdien 'value' ;-)
      $sql = "DELETE FROM `KbnProjects` WHERE `id` ='" . $_POST['DeleteKanbanProject'] . "';";
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
* Edit UPDATE SQL
*/

if ($_POST['submit'] == 'OK') { 

	// virker:
	// $wpdb->update("KbnProjects", array('Name' => 'Yabbadabbadoo'), array('ID' => 0));  
	//$wpdb->update("KbnProjects", array('Name' => $_POST['Name']), array('ID' => $_POST['UpdateField']));  
	
	echo "### ### The kanban board is updated";
	//exit(var_dump($wpdb->last_query));
	
	}
	else {
		// echo "Error: POST submit = " . $_POST['submit'];
	}

/**
* Table 
*/
screen_icon();
echo 	"<div class='wrap'>
	<div id='icon-edit-pages' class='icon32'></div><br />
	<h2>The Kanban Boards</h2>
	<p>You can compare the kanban boards to whiteboards for kanban notes. Give your project a name such as 'Work', 'My New Book' or whatever you're working on.
	</p>
";

echo "<table class='widefat fixed' cellspacing='0'>"; 
echo "<caption>  Kanban Projects  </caption>";
echo "<tr>"; 
echo "<th class='manage-column column-columnname'><b>Id</b></th>"; 
echo "<th class='manage-column column-columnname'><b>Name</b></th>"; 
echo "<th class='manage-column column-columnname'><b>Edit / Delete</b></th>";
echo "</tr>"; 

$result = $wpdb->get_results("SELECT * FROM `KbnProjects`") or trigger_error(mysql_error()); 

foreach($result as $row){
	echo "<tr>";  
	echo "<td class='manage-column column-columnname'>" . $row->Id . "</td>";  
	echo "<td class='manage-column column-columnname'>" . $row->Name . "</td>";  
	echo "<td class='manage-column column-columnname'>" 
	. $KbnProjectsCRUD->edit('', $row->Id)
	. $KbnProjectsCRUD->delete('', $row->Id) 
	. $KbnProjectsCRUD->newKbn()
	.  "</td> "; // formatterer knapperne og giver dem en value
	echo "</tr>"; 
}

echo "</table>";
echo "</div>";
?>
