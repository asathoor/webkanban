<? 
include('config.php'); // settings

//print_r($_POST);

echo "<h2>Change Project Name</h2>";
screen_icon();

if (isset($_POST['EditKbnProject'])) {

	$what = $_POST['EditKbnProject'];

	$sql2 = "SELECT * FROM `KbnProjects` WHERE `Id`= '" . $what . "'";

	$retenpost = $wpdb->get_results( $sql2 );
	print_r($retenpost);

	foreach($retenpost as $row){

		echo "	<form action='' method='POST'> 
		<p><b>Name: </b><br /><input type='text' name='Name' value='" . $row->Name . "' /> 
		<input type='hidden' name='UpdateField' value='" . $_POST['EditKbnProject'] . "' />
		<input type='Submit' name='KbnBoardUpdated' value='OK'  />
		</form> ";
		}
	}

	else {
		echo "Post is not defined";
		print_r($_POST);
	}
?>