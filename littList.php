<? 
class littList {

public function BooksAnnotated() {

	global $wpdb; // wp db class

	$result = $wpdb->get_results("SELECT * FROM `libri` ORDER BY `Author`") or trigger_error(mysql_error()); 

	foreach($result as $row){
		echo "<p><strong>" 
		. $row->Author 
		. ":</strong> &quot;" 
		. $row->Title
		. "&quot;, "
		. $row->Where
		. " ("
		. $row->Year
		. ") <br>&nbsp; &nbsp; "
		. $row->Note																																				
		.  "</p> ";
	}

} // end littList

} // ending the class

// test
$Litteraturliste = new littList;

echo "<div class='wrap'>
	<h2>Annoteret kildefortegnelse</h2>";

echo $Litteraturliste->BooksAnnotated();

echo "</div>";
?>


