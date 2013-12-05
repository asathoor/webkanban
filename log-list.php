<? 
include('config.php');

/**
* Class creating buttons etc.
*/

class kbnButton {

	public function edit($action, $value) {
		return "
		<form action='"
		. $action
		."' method='post' enctype='multipart/form-data'>
			<button name='EditLog' value='"
			. $value
			. "' type='submit'>Edit Log</button>
		</form>
		";
	}

	public function delete($action, $deleteMe) {
		return "
		<form action='"
		. $action
		. "' method='post' enctype='multipart/form-data'>
			<button name='DeleteLog' value='"
			. $deleteMe
			."' type='submit'>Delete Log</button>
		</form>	";
		echo $deleteMe;
				

	}

	public function newKbn() {
		return "
		<form action='' method='post' enctype='multipart/form-data'>
			<button name='NewLog' value='value' type='submit'>New Log Entry</button>
		</form>
		";
	}
}

$kbnBtn = new kbnButton(); // klassen instantieres via config.php

/**
* Update Form
*/

if(isset($_POST['EditLog'])) {
      include('log-edit.php'); // log-edit.php redigerer felterne
}

/**
* New Entry in the log
*/

if(isset($_POST['NewLog'])) {
      include('log-new.php'); // log-edit.php redigerer felterne
}

/**
* Detect if new Log post is created
*/

	if (isset($_POST['submitted'])) { 
	foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
	$sql = "INSERT INTO `KbnLog` ( `Id` ,  `Date` ,  `KbnProjects_Id` ,  `KbnNotes_Id` ,  `KbnStates_Id`  ) VALUES(  '{$_POST['Id']}' ,  '{$_POST['Date']}' ,  '{$_POST['KbnProjects_Id']}' ,  '{$_POST['KbnNotes_Id']}' ,  '{$_POST['KbnStates_Id']}'  ); "; 
		$wpdb->query($wpdb->prepare($sql)); // Query
		echo "Added row.<br />"; 
	}

/*
* From edit-log.php check submit sql logic
*/

if (isset($_POST['NewKbnProjectSubmit'])) { 
	echo "<div class='wrap'> Opdaterer databasen </div>";
	
	$sql = "UPDATE `KbnLog` 
		SET `Id`= '" 
		. $_POST['Id'] 
		. "',`Date`='" 
		. $_POST['Date']
		. "', `KbnProjects_Id`='" 
		. $_POST['KbnProjects_Id']
		. "', `KbnNotes_Id`='" 
		. $_POST['KbnNotes_Id']
		. "',`KbnStates_Id`='"
		. $_POST['KbnStates_Id'] 
		. "' WHERE `Id`='"
		. $_POST['Id']
		. "'";

	echo $sql; // test
	
	$wpdb->query($wpdb->prepare($sql)); // wpdb - > update virker ikke
	} 




/**
* Table 
*/
screen_icon();
echo "<div class='wrap'>";
echo "<table class='widefat fixed' cellspacing='0'>"; 
echo "<caption>  The Kanban Log  </caption>";
echo "<tr>"; 
echo "<th class='manage-column column-columnname'><b>Id</b></th>"; 
echo "<th class='manage-column column-columnname'><b>Date</b></th>"; 
echo "<th class='manage-column column-columnname'><b>KbnProjects Id</b></th>"; 
echo "<th class='manage-column column-columnname'><b>KbnNotes Id</b></th>"; 
echo "<th class='manage-column column-columnname'><b>KbnStates Id</b></th>"; 
echo "<th class='manage-column column-columnname'><b>Edit / Delete</b></th>";
echo "</tr>"; 

$result = $wpdb->get_results("SELECT * FROM `KbnLog`") or trigger_error(mysql_error()); 

foreach($result as $row){
	echo "<tr>";  
	echo "<td class='manage-column column-columnname'>" . $row->Id . "</td>";  
	echo "<td class='manage-column column-columnname'>" . $row->Date . "</td>";  
	echo "<td class='manage-column column-columnname'>" . $row->KbnProjects_Id . "</td>";  
	echo "<td class='manage-column column-columnname'>" . $row->KbnNotes_Id . "</td>";  
	echo "<td class='manage-column column-columnname'>" . $row->KbnStates_Id . "</td>";  
	echo "<td class='manage-column column-columnname'>" 
	. $kbnBtn->edit('', $row->Id)
	. $kbnBtn->delete('', $row->Id) 
	. $kbnBtn->newKbn()
	.  "</td> "; // formatterer knapperne og giver dem en value
	echo "</tr>"; 
}

echo "</table>";
echo "</div>";

/**
* Delete
*/

if(isset($_POST['DeleteLog'])) {
      echo "Deleted: ";
      echo $_POST['DeleteLog']; // Har vaerdien 'value' ;-)
      $sql = "DELETE FROM `KbnLog` WHERE `id` ='" . $_POST['DeleteLog'] . "';";
      $wpdb->query($sql);
}
?>
