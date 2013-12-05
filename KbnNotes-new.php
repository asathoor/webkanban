<? include('config.php'); ?>

<div class='wrap'>
<div id="icon-edit-pages" class="icon32"></div><br />
	<h2>New task</h2>

<? include_once('iconPanel.php'); // menu ?>
<div style='clear:both'>
<form action='' method='POST'> 

	<ul>

		<!-- drop down lister -->
		<li>Project 
			<select name='KbnProjectsId'>
		<?
		// KbnBoard select box
		// burde aendre naeste select box
		$result2 = $wpdb->get_results("SELECT * FROM `KbnProjects` WHERE `Id` =" . $_SESSION['ActiveKanbanName']) or trigger_error(mysql_error()); 

		foreach($result2 as $row){
			echo "<option value='$row->Id'> $row->Name </option> " ;
		}
		?>
			</select>
		</li>

		<li>Select the status of the task 
		<select name='KbnStatesId'>
		<?
		// KbnStates select box
		$result = $wpdb->get_results("SELECT * FROM `KbnStates` WHERE `KbnProjectsId` = {$_SESSION['ActiveKanbanName']}") or trigger_error(mysql_error()); 

		foreach($result as $row){
			echo "<option value='$row->Id'> $row->State </option> " ;
		}
		?>
		</select>
		</li>
		<li><b>Title:</b>
			<textarea name='Title' rows='0' cols='20'></textarea></li>

		<li><b>Blog:</b><textarea name='What' rows='0' cols='20'></textarea><li>

		<li><b>Who:</b><textarea name='Who' rows='1' cols='20'><?
							global $current_user;
							get_currentuserinfo();
							echo $current_user->user_firstname;
						?></textarea></li>

		<li><b>StartDate:</b><input type='text' name='StartDate' value='<? echo date('Y-m-d'); ?>' /></li>
		<li><b>DeadLine:</b><input type='text' name='DeadLine' value='<? echo date('Y-m-d'); ?>' /></li>
		<li><b>Created:</b><input type='text' name='Created' value='<? echo date('Y-m-d'); ?>' /></li>
		<li>If you want to add an image or set the title as a link please enter the web address below.</li>
		<li><b>Title URL:</b><input type='text' name='URL'/></li>
		<li><b>Image SRC:</b><input type='text' name='Image'/></li>
		<li>
			<? submit_button( 'Save', 'NewKanbanNote', 'NewKanbanNote' ) ?>
		</li>

	</ul>
</form>

</div>

<?
if (isset($_POST['NewKanbanNote'])) { 

	// a la codex
	$wpdb->insert(
		'kbnNotes',
		array(
			'Id' => NULL,
			'KbnProjectsId' => $_POST['KbnProjectsId'],
			'KbnStatesId' => $_POST['KbnStatesId'],
			'Title' => $_POST['Title'],
			'What' => $_POST['What'],
			'Who' => $_POST['Who'],
			'StartDate' => $_POST['StartDate'],
			'DeadLine' => $_POST['DeadLine'],
			'Created' => $_POST['Created'],
			'URL' => $_POST['URL'],
			'Image' => $_POST['Image']
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
			'%s',
			'%s',
			'%s',
		)

	);


/**
* Logging
**/

	// looking for the number of the last id increment
	$last = $wpdb->get_row("SHOW TABLE STATUS LIKE 'kbnNotes'");
	$lastid = $last->Auto_increment -1;
	// echo $lastid; // virker; men traek een fra pga. array ....
	// det er kanbannotesid som skal indsaettes saadan

	// adding the entry to the log
	$title = date('Y-m-d G:i:s') . '<br /><strong> ' . $_POST['Title'] . '</strong><br />' .  $_POST['What'];


		// indsaetter ingen vaerdi i Id ... hvordan opdateres den?
		$wpdb->insert(
			"KbnLog",
			array(
				'Id' => NULL,
				'What' => $_POST['What'],
				'KbnNotesId' => $lastid,
				'KbnStatesId' => $_POST['KbnStatesId'],
				'KbnProjectsId' => $_POST['KbnProjectsId'],
				'KbnNotesName' => $title,
				'Date' => date('Y-m-d G:i:s')
			),
			array(
				'%d', '%s', '%d', '%d', '%d', '%s', '%s'
			)
		);

/**
* Log entry (corrected)
**/

// get the Id of this note entry from DB
//	$getNoteId = $wpdb->query("SELECT * FROM `kbnNotes` WHERE `Title` = 'fff' AND `Created` = '2013-05-15'");
//	echo "Id = " . $getNoteId;



// then enter the data to the log database


} // ends: if isset NewKanbanNote
?>
