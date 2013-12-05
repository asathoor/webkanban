<? 
include('config.php'); // settings

if(!isset($wpdb)){
	echo "WPDB missing
	</li> try: add dashboard page ...";
}
echo "
<!-- div id='icon-edit-pages' class='icon32'></div><br / -->
	<h3>Edit Note</h3>";

include_once('iconPanel.php');

/**
* FORM EDIT NOTE
**/

echo "<!-- NOTEFORMEDITOR  -->";

echo	"<form action='' method='POST'>
	<ul>
	";

?>


<li><strong>Board:  

<?
// KbnBoard select box

$result2 = $wpdb->get_results("SELECT * FROM `KbnProjects` WHERE `Id` =" . $_SESSION['ActiveKanbanName']) or trigger_error(mysql_error()); 

foreach($result2 as $row){	 
	echo $row->Name ; // name of Board

	// pass to POST via hidden

}

// hidden field POSTing KbnProjectsId to the DB
echo "<input type='hidden' name='EditedKbnBoard' value='". $_SESSION['ActiveKanbanName']  . "' />";
?>


</strong>
</li>

<li>Select the status of the task 
<select name='KbnStatesId'>

<?
// KbnStates select box
$result3 = $wpdb->get_results("SELECT * FROM `KbnStates` WHERE `KbnProjectsId` =" . $_SESSION['ActiveKanbanName']) or trigger_error(mysql_error()); 

foreach($result3 as $row){
	echo "<option value='$row->Id'> $row->State </option> " ;
}
?>

</select>
</li>

<?
$what = $_POST['EditKbnNote'];
$sql2 = "SELECT * FROM `kbnNotes` WHERE `Id`= '" . $what . "'";
$retenpost3 = $wpdb->get_results( $sql2 );
// print_r($_POST);

foreach($retenpost3 as $row){

	echo "	<li>Id " . $row->Id;

	echo "<input type='hidden' name='Id' value='" . $row->Id  . "' /> </li>";

	echo	"<li><b>Title </b><input type='text' name='Title' value='" . $row->Title . "' /></li> 
		<li><b>Blog </b><input type='text' name='What' value='" . $row->What . "' />
		 (Reflections, notes etc.) </li> 
		<li><b>Who </b><input type='text' name='Who' value='" . $row->Who . "' /></li> 
		<li><b>StartDate </b><input type='text' name='StartDate' value='" . $row->StartDate . "' /> </li>
		<li><b>DeadLine </b><input type='text' name='DeadLine' value='" . $row->DeadLine . "' /> </li>
		<li><b>Created </b><input type='text' name='Created' value='" . $row->Created . "' /></li>
		<li><b>Title URL </b><input type='text' name='URL' value='" . $row->URL . "' /></li>
		<li><b>Image </b><input type='text' name='Image' value='" . $row->Image . "' /></li>
		<li>";
	echo	submit_button( 'OK', 'submit', 'NewNote');
	echo	"<button name='cancel' type='reset'>Cancel</button>
		</li>
		";
		}
		

	echo "	</li>	
		</ul>
		</form>";

?>

