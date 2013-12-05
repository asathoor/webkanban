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
			<button name='NewKbnProjectSubmit' value='value' type='submit'>New State</button>
		</form>
		";
	}

}

$KbnStatesCRUD = new KbnProjects(); // klassen instantieres via config.php

/**
* Edit Form Inkluderes
*/

if(isset($_POST['EditKbnProject'])) {
	include('KbnStates-edit.php'); 
}

/**
* New Entry in the log
*/

if(isset($_POST['NewKbnProjectSubmit'])) {
      include('KbnStates-new.php'); // redigerer felterne
}

/**
* New Entry Entered in DB
*/

if ($_POST['NewKbnProjectSubmit2'] == 1) { 
	// echo "Ok, der er altså klikke på submitknappen";
	// "INSERT INTO `multimusen_dk`.`KbnStates` (`Id`, `KbnProjects_Id`, `Color`, `Limit`, `State`) VALUES (NULL, \'1\', \'Greenish\', \'3\', \'Wakeup\');";	

	// $sql = "INSERT INTO `KbnStates` (`Id`, `KbnProjects_Id`, `Color`, `Limit`, `State`) VALUES (NULL, '{$_POST['KbnProjectsId']}', '{$_POST['Color']}', '{$_POST['Limit']}', '{$_POST['State']}');";
	echo $sql;
	
	// $wpdb->query($wpdb->prepare($sql)); // Query

	print_r($_POST);

	// a la codex
	$wpdb->insert(
		'KbnStates',
		array(
			'Id' => NULL,
			'KbnProjectsId' => $_POST['KbnProjectsId'],
			'Color' => $_POST['Color'],
			'Limit' => $_POST['Limit'],
			'State' => $_POST['State']
		),
		array(
			'%d',
			'%d',
			'%s',
			'%d',
			'%s'
		)

	);

} 

/**
* Delete
*/

if(isset($_POST['DeleteKanbanProject'])) {
      echo $_POST['Kanban Project']; // Har vaerdien 'value' ;-)
      $sql = "DELETE FROM `KbnStates` WHERE `id` ='" . $_POST['DeleteKanbanProject'] . "';";
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
* Edit update SQL
*/

if (isset($_POST['KbnStatesEdited'])) { 

	 // echo "Ok vi er gennem if sætningen og sessionen er lig ..." . $_SESSION['KillBill'];
	 // echo "Projekt ID:" . $_POST['Id'];

//$wpdb->show_errors = true;
//print_r($_POST);

	// Below: updating the relevant fields in the DB:
	$wpdb->update(
			'KbnStates',
			array(
				
				 'KbnProjectsId' => $_POST['KbnProjectsId'],
				'Color' => $_POST['Color'],
				'Limit' => $_POST['Limit'],
				'State' => $_POST['State'],
				'Order' => $_POST['Order']
			),
			array(
				'ID' => $_POST['Id']
			),
			array('%d','%s','%d','%s','%d'),
			array('%d')
		
		);

	




		$_SESSION['KillBill'] = 0;

}

/**
* Table 
*/
screen_icon();
echo "<div class='wrap'>";
echo "<div id='icon-edit-pages' class='icon32'></div><br />
	<h2>Kanban States Editor</h2>";

include_once('iconPanel.php');

echo	"
	<div style='clear:both'>
	<p>
	  <strong>States</strong><br />
	  A state is the present situation of one of your tasks. You could call it something like 'Todo', 'Backlog', 'Done' or whatever suits your purpose. 
	</p>
	<ul>
	  <li><strong>Board</strong><br /> The name of the kanban board.</li>
	  <li><strong>Color</strong><br /> The color of the note in hex code e.g. #ff9900.</li>
	  <li><strong>Limit</strong><br /> In the kanban philosophy we limit the number of tasks, that you kan do in a working day or session. It is the limit of the work in progress. 0 = unlimited.</li>
	  <li><strong>State</strong><br /> The name of the process, such as 'Backlog', 'To Do', 'Done' etc.</li>
	  <li><strong>Order</strong><br /> Defines the order of the colums. The colums are sorted by numbers, for instance 1 will be to the left of 7.</li>
	</ul>
	</div>
	";
echo "<table class='widefat'>"; 
echo "<caption>  Kanban States  </caption>";
echo "<tr>"; 
echo "
<thead><tr>
<th class='draggable'>Id
</th><th class='manage-column column-columnname'>Board
</th><th class='manage-column column-columnname'>Color
</th><th class='manage-column column-columnname'>Limit
</th><th class='manage-column column-columnname'>State
</th><th class='manage-column column-columnname'>Order
<th class='manage-column column-columnname'><b>Edit / Delete</b></th>
</th></tr>
</thead>
";


echo "</tr>"; 

$result = $wpdb->get_results("SELECT * FROM `KbnStates` ORDER BY `KbnProjectsId`, `Order`") or trigger_error(mysql_error()); 

foreach($result as $row){

	$sql = "SELECT `KbnProjects`.`Name` FROM `KbnProjects` WHERE `Id`=". $row->KbnProjectsId; // $id is the 
	// echo $sql;
	$BoardTitle = $wpdb->get_results($sql);
	foreach($BoardTitle as $vis){
		$KanbanTavle =  $vis->Name;
	}



	echo "<tr>";  
	echo "<td class='manage-column column-columnname'>" . $row->Id . "</td>";  
	echo "<td class='manage-column column-columnname'>" 
	. $KanbanTavle 
	. "</td>";
	echo "<td class='manage-column column-columnname' style='background-color:" . $row->Color . "'>" . $row->Color . "</td>";  
	echo "<td class='manage-column column-columnname'>" . $row->Limit . "</td>";  
	echo "<td class='manage-column column-columnname'>" . $row->State . "</td>";
	echo "<td class='manage-column column-columnname'>" . $row->Order . "</td>";    
  
	echo "<td class='manage-column column-columnname'>" 
	. $KbnStatesCRUD->edit('', $row->Id)
	. $KbnStatesCRUD->delete('', $row->Id) 
	. $KbnStatesCRUD->newKbn()
	.  "</td> "; // formatterer knapperne og giver dem en value
	echo "</tr>"; 
}

echo "</table>";
echo "</div>";
?>
