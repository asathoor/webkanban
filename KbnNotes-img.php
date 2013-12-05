<? include('config.php'); ?>

<div class='wrap'>
	<h2>Insert Image</h2>

<form action='' method='POST'> 
	<fieldset>
		<legend>Enter the name and the link (url) to the image </legend>

<!-- drop down lister -->
<p>Select Project 
	<select name='KbnProjectsId'>
<?
// KbnBoard select box
$result2 = $wpdb->get_results("SELECT * FROM `KbnProjects`") or trigger_error(mysql_error()); 

foreach($result2 as $row){
	echo "<option value='$row->Id'> $row->Name </option> " ;
}
?>
	</select>
</p>

<p>Select the status of the task 
<select name='KbnStatesId'>
<?
// KbnStates select box
$result = $wpdb->get_results("SELECT * FROM `KbnStates`") or trigger_error(mysql_error()); 

foreach($result as $row){
	echo "<option value='$row->Id'> $row->State </option> " ;
}
?>
</select>
</p>
		<p><b>Title:</b><input type='text' name='Title'/>
		<p><b>Image URL:</b><input type='text' name='What'/>
		<? submit_button( 'Save', 'NewKanbanNote', 'NewKanbanNote' ) ?>
	</form>
</div>

<?
if (isset($_POST['NewKanbanNote'])) { 

	// add image to db
	$wpdb->insert(
		'kbnNotes',
		array(
			'Id' => NULL,
			'KbnProjectsId' => $_POST['KbnProjectsId'],
			'KbnStatesId' => $_POST['KbnStatesId'],
			'Title' => "<img width='100%' height='*' src='" . $_POST['What'] . "' alt='" . $_POST['Title'] . "' />",
			'What' => $_POST['Title'],
			'Who' => wp_get_current_user(),
			'StartDate' => '',
			'DeadLine' => '',
			'Created' => date('Y-m-d')
		),
		array(
			'%d',
			'%d',
			'%d',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s'

		)

	);
	echo "New task created.";

	// add to log
		$wpdb->insert(
			"KbnLog",
			array(
				'Id' => NULL,
				'What' => $_POST['What'],
				'KbnNotesId' => $_POST['Id'],
				'KbnStatesId' => $_POST['KbnStatesId'],
				'KbnProjectsId' => $_POST['KbnProjectsId'],
				'KbnNotesName' => 'Image: ' . $_POST['Title'],
				'Date' => date('Y-m-d G:i:s')
			),
			array(
				'%d', '%s', '%d', '%d', '%d', '%s', '%s'
			)
		);

}
?>
