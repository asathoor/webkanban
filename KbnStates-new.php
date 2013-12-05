<? 
include('config.php');




echo "<div class='wrap'>";
echo "<h2>New State</h2>";

if (isset($_POST['NewKbnProjectSubmit2'])) { 
	// echo "Hva så er der klikket eller hva? Fra --new fil";
	// $sql = "INSERT INTO `KbnStates` (`Name`) VALUES( '{$_POST['Id']}','{$_POST['KbnProjects_Id']}', '{$_POST['Color']}','{$_POST['Limit']}','{$_POST['State']}' ); "; // Id kan ikke indsaettes, autopdaterer
	// $wpdb->insert( $table, $data, $format );

	/*

	$sql = $wpdb->insert(
		'KbnStates',
		array(
			'Id' => '',
			'KbnProjects_Id' => 'Ale is good',
			'Color' => '{$_POST['Color']}',
			'Limit' => '{$_POST['Limit']}',
			'State' => '{$_POST['State']}'
		),
		array(
			'%d',
			'%d',
			'%s',
			'%d',
			'%s'
		)

	);


	$wpdb->query($wpdb->prepare($sql)); // Query


	*/
} 

/**
* Drop down board list
**/

class KbnListBoards {

	public function boards(){

		global $wpdb;

		$result = $wpdb->get_results("SELECT * FROM `KbnProjects`") or trigger_error(mysql_error());

		foreach($result as $row){
			echo "<li><input type='radio' name='KbnProjectsId' value='" . $row->Id  . "' />" , $row->Name  , "</li>";
		} 

	} // funct, list ends here		
} // class ends here

$tavler = new KbnListBoards();
// $tavler::boards();

?>
<div class ='wrapper'>
<form action='' method='POST'> 
	<fieldset>
			<p><b>Name of the new state</b> <input type='text' name='State' /> 
			<!-- p><b>Kanban Project Id:</b><br /><input type='text' name='KbnProjectsId'/ -->
  			
			<!-- herfra radio buttons -->
			<p><strong>Select a kanban board</strong></p>
			<ul>
			<? $tavler::boards(); // radio buttons ?>
			</ul>

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

			<p><b>Limit</b><input type='text' name='Limit' value='0' /> (0 = unlimited)</p> 

			<!-- input type='hidden' name='KbnProjects_Id'/ --> 
			<p><input type='Submit' value='Add Row' />
			<input type='hidden' value='1' name='NewKbnProjectSubmit2' /> 
	</fieldset>
</form> 
</div>
