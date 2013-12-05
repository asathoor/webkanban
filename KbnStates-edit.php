<? 
include('config.php'); // settings

//print_r($_POST);
echo 	"<h2>Edit State</h2>	<p>Here you can change the name of a state, it's color, the limit of work in progress. </p>";

if (isset($_POST['EditKbnProject'])) {

	$_SESSION['KillBill'] = 1;

	$what = $_POST['EditKbnProject'];

	$sql2 = "SELECT * FROM `KbnStates` WHERE `Id`= '" . $what . "'";
	$wpdb->prepare($sql2);

	$retenpost = $wpdb->get_results( $sql2 );

	foreach($retenpost as $row){

		echo "	
		<form action='' method='POST'> 

		<input type='hidden' name='Id' value ='" 
		. $row->Id 
		. "' />

		<input type='hidden' name='KbnProjectsId' value='"
		. $row->KbnProjectsId
		. "' />

		<p><b>State name </b> <input type='text' name='State' value='" . $row->State . "' /> </p> 

		<p><b>Color </b><br />
		(The background color of the column in the kanban board.) </p>

		<!-- Radio buttons select colors -->
		<p>
		<input type='radio' name='Color' value='#FFFFCC' /> White<br />
                <input type='radio' name='Color' value='#FF5050' /> Red<br />
                <input type='radio' name='Color' value='#FFCC00' /> Orange<br />
                <input type='radio' name='Color' value='#99CCFF' /> Blue<br />
                <input type='radio' name='Color' value='#66FF99' checked /> Green<br />
                <input type='radio' name='Color' value='#A9BBA9' /> Grey<br />
		<input type='radio' name='Color' value='#FFFF00' /> Yellow<br />
		</p>

		<p><b>Limit </b> <input type='number' name='Limit' value='" . $row->Limit . "' /> 
		<br /> (The number of tasks that can run at the same time. A value of 0 is unlimited.) </p>
		<p><b>Order </b> <input type='number' name='Order' value='" . $row->Order . "' />
		<br />(A lower number will move the column to the left) </p>
		<input type='hidden' name='UpdateField' value='" . $_POST['EditKbnProject'] . "' /></p>
		<p><input type='Submit' name='KbnStatesEdited' value='OK'  /></p>
		</form> 
		";
		}
	}

	else {
		echo "KbnStates-edit.php error - S_POST['EditKbnProject'] not found ";	
	}
?>
