<? 
include('config.php'); // settings

echo "<h2>Edit Log</h2>";
screen_icon();
/*

Unoedvendig kode - tjekkes af log-list.php

if (isset($_POST['submitted'])) { 


	} 

*/

if (isset($_POST['EditLog'])) {

	$what = $_POST['EditLog'];
	

	$sql2 = "SELECT * FROM `KbnLog` WHERE `Id`= '" . $what . "'";

	$retenpost = $wpdb->get_results( $sql2 );

	foreach($retenpost as $row){

		echo "
		<form action='' method='POST'> 
		<p><b>Id:</b><br /><input type='text' name='Id' value='$row->Id' /> 
		<p><b>Date:</b><br /><input type='text' name='Date' value='$row->Date' /> 
		<p><b>KbnProjects Id:</b><br /><input type='text' name='KbnProjects_Id' value='$row->KbnProjects_Id' /> 
		<p><b>KbnNotes Id:</b><br /><input type='text' name='KbnNotes_Id' value='$row->KbnNotes_Id' /> 
		<p><b>KbnStates Id:</b><br /><input type='text' name='KbnStates_Id' value='$row->KbnStates_Id' /> 
		<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='LogSubmitted' /> 
		</form> 
		";
		}
	}

	else {
		echo "Post is not defined";
		print_r($_POST);
	}
?>



