<? 
//global $wpdb; // henter klassen
include('config.php');

echo "<div class='wrap'>";
screen_icon();
echo "<h2>New Log</h2>";

if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `KbnLog` ( `Id` ,  `Date` ,  `KbnProjects_Id` ,  `KbnNotes_Id` ,  `KbnStates_Id`  ) VALUES(  '{$_POST['Id']}' ,  '{$_POST['Date']}' ,  '{$_POST['KbnProjects_Id']}' ,  '{$_POST['KbnNotes_Id']}' ,  '{$_POST['KbnStates_Id']}'  ); "; 
// id og date skal fjernes ellers kommer fejl i autofunkt.

// mysql_query($sql) or die(mysql_error()); 
$wpdb->query($wpdb->prepare($sql)); // Query

echo "Added row.<br />"; 
} 
?>

<form action='' method='POST'> 
<p><b>Id:</b><br /><input type='text' name='Id'/> 
<p><b>Date:</b><br /><input type='text' name='Date'/> 
<p><b>KbnProjects Id:</b><br /><input type='text' name='KbnProjects_Id'/> 
<p><b>KbnNotes Id:</b><br /><input type='text' name='KbnNotes_Id'/> 
<p><b>KbnStates Id:</b><br /><input type='text' name='KbnStates_Id'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
