<?php
/*
CREATE TABLES IN THE WPDB
Checks whether the requred tables exists or no.
If the table isn't present a new table is created.
Source of inspiration: http://jacobschatz.com/?p=23 - however the versioncheck is disabled by now.
The code is basically the same for other database tables.
*/

include('config.php');

check_Kbn_database(); // Is the table present?

function check_Kbn_database()
{
	global $wpdb;

// Creating table KbnLog
	$table_name = "KbnLog";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (

			`Id` int(11) NOT NULL AUTO_INCREMENT,
			`What` text NOT NULL,
			`KbnNotesId` int(11) NOT NULL,
			`KbnStatesId` int(11) NOT NULL,
			`KbnProjectsId` int(11) NOT NULL,
			`KbnNotesName` text NOT NULL,
			`Date` date NOT NULL,
			PRIMARY KEY (`Id`),
			UNIQUE KEY `Id` (`Id`)
			);";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); // henter upgrade klassen
		dbDelta($sql);
 
// insert test values into the DB

	$wpdb->insert(
			'KbnLog',
			array(
				'Id' => '1',
				'What' => 'Test log',
				'KbnNotesId' => '1',
				'KbnStatesId' => '1',
				'KbnProjectsId' => '1',
				'KbnNotesName' => 'Test Log Entry',
				'Date' => date('Y-m-d'),

			),
			array('%d', '%s', '%d', '%d', '%d', '%s', '%s'  )

		);
	return "KbnLog table created and test data inserted";
	} // if ends
	else {
		return "OK: the table KbnLog found."; // only needed for test purposes
	}

// create table kbnNotes
	$table_name = "kbnNotes";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (

			  `Id` int(8) NOT NULL AUTO_INCREMENT,
			  `KbnProjectsId` int(8) NOT NULL,
			  `KbnStatesId` int(11) NOT NULL,
			  `Title` text CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
			  `What` text CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
			  `Who` text CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
			  `StartDate` date NOT NULL,
			  `DeadLine` date NOT NULL,
			  `Created` date NOT NULL,
			  `URL` text NOT NULL,
			  `Image` text NOT NULL,
			  PRIMARY KEY (`Id`)

			);";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); // henter upgrade klassen
		dbDelta($sql);
 
// insert test values into the DB

	$wpdb->insert(
			$table_name,
			array(
				'Id' => '1',
				'KbnProjectsId' => '1',
				'KbnStatesId' => '1',
				'Title' => 'Test title',
				'What' => 'Sample',
				'Who' => 'User',
				'StartDate' => date('Y-m-d'),
				'DeadLine' => date('Y-m-d'),
				'Created' => date('Y-m-d'),
				'URL' => '',
				'Image' => '',
			),
			array('%d', '%d', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'  )

		);
	return "$table_name table created and test data inserted";
	}

// insert the table KbnProjects

	$table_name = "KbnProjects";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (
			`Id` int(11) NOT NULL AUTO_INCREMENT,
			`Name` text CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
			PRIMARY KEY (`Id`)
			);";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); // henter upgrade klassen
		dbDelta($sql);
 
// insert test values into the DB

	$wpdb->insert(
			$table_name,
			array(
				'Id' => '1',
				'Name' => 'Kanban'
			),
			array('%d', '%s'  )

		);
	return "$table_name table created and test data inserted";
	}

// insert the table KbnStates

	$table_name = "KbnStates";
	if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name)
	{
		$sql = "CREATE TABLE " . $table_name . " (
			`Id` int(11) NOT NULL AUTO_INCREMENT,
			`KbnProjectsId` int(11) NOT NULL,
			`Color` text CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
			`Limit` int(11) NOT NULL,
			`State` text CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
			`Order` int(11) NOT NULL,
			PRIMARY KEY (`Id`)
			);";
 
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php'); // henter upgrade klassen
		dbDelta($sql);
 
// insert test values into the DB

	$wpdb->insert(
			$table_name,
			array(
				'Id'=> '1',
				'KbnProjectsId'=> '1',
				'Color'=> 'yellow',
				'Limit'=> '0',
				'State'=>  'Backlog',
				'Order' => '1'),
			array('%d', '%d', '%s', '%d', '%s', '%d'  )

		);

	$wpdb->insert(
			$table_name,
			array(
				'Id'=> '1',
				'KbnProjectsId'=> '1',
				'Color'=> 'blue',
				'Limit'=> '3',
				'State'=>  'In Progress',
				'Order' => '2'),
			array('%d', '%d', '%s', '%d', '%s', '%d'  )

		);

	$wpdb->insert(
			$table_name,
			array(
				'Id'=> '1',
				'KbnProjectsId'=> '1',
				'Color'=> 'yellow',
				'Limit'=> '0',
				'State'=>  'Done',
				'Order' => '3'),
			array('%d', '%d', '%s', '%d', '%s', '%d'  )

		);




	return "$table_name table created and test data inserted";
 	} // if ends

	else {
		return "OK: the table $table_name found."; // only needed for test purposes
	}
}
?>
