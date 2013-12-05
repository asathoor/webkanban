<? 
//global $wpdb; // henter klassen
include('config.php');

echo "<div class='wrap'>";
echo "<h2>New Kanban Board</h2>";

// NewKbnProjectSubmit

if (isset($_POST['NewKbnProjectSubmit2'])) { 
	// foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
	$sql = "INSERT INTO `KbnProjects` (`Name`) VALUES( '{$_POST['Name']}' ); "; // Id kan ikke indsaettes, autopdaterer
	$wpdb->query($wpdb->prepare($sql)); // Query
	echo "Added entry.<br />"; 
} 
?>
<div class ='wrapper'>
<form action='' method='POST'> 
	<fieldset>
		<legend>New board</legend>
			<p><b>Name:</b><br /><input type='text' name='Name'/> 
			<input type='hidden' name='KbnProjects_Id'/> 
			<p><input type='Submit' value='Add Row' />
			<input type='hidden' value='1' name='NewKbnProjectSubmit2' /> 
	</fieldset>
</form> 
</div>
