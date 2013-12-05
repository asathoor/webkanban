<?php 
/**
* KbnLog-list.php 
* Purpose - listing the log
*/

include('config.php');

// pagination simpel variable
$perPage = 10;
$number = $wpdb->get_results("SELECT * FROM `KbnLog` WHERE `KbnProjectsId` =" . $_SESSION['ActiveKanbanName'] . " ORDER BY `KbnNotesName` DESC");
$pages = ceil(count($number) / $perPage);
$i = 1;
$start = 1;

// sql
if(isset($_GET['start'])){
	$result = $wpdb->get_results("SELECT * FROM `KbnLog` WHERE `KbnProjectsId` =" . $_SESSION['ActiveKanbanName'] . " ORDER BY `KbnNotesName` DESC LIMIT " . $_GET['start'] . ", "  . $_GET['slut']);
}
else{
	$result = $wpdb->get_results("SELECT * FROM `KbnLog` WHERE `KbnProjectsId` =" . $_SESSION['ActiveKanbanName'] . " ORDER BY `KbnNotesName` DESC LIMIT 0," . $perPage . "");
}

// filters to a echo of one particular note

if(isset($_GET['KbnNoteFilter'])){
	$result = $wpdb->get_results("SELECT * FROM `KbnLog` WHERE `KbnNotesId` =" . $_GET['KbnNoteFilter']);
}

// when the seek formula is in use copied from seek.inc

if (isset($_POST['KbnLogSeek'])){
	$seeking = "SELECT * FROM `KbnLog` WHERE `KbnNotesName` LIKE '%" . $_POST['KbnLogSeek'] . "%'";
	$seeking = sanitize_text_field($seeking);
        $result = $wpdb->get_results($seeking);
	// echo "Logseek er def. <br />";
	// echo "SQL = " . $seeking;
	// echo "Post er: " . $_POST['KbnLogSeek'] . "<br />";
	// print_r( $result );
}

// print_r( $result );


class KbnLogPages {

	function showPages(){
		
		global $wpdb;

		echo "Page(s): ";

		// pagination simpel variable
		$perPage = 10;
		$number = $wpdb->get_results("SELECT * FROM `KbnLog` WHERE `KbnProjectsId` =" . $_SESSION['ActiveKanbanName'] . " ORDER BY `KbnNotesName` DESC");
		$pages = ceil(count($number) / $perPage);
		$i = 1;
		$start = 1;

		while($i <= $pages){
			$i++;
			$start = $start;
			$slut = $start + $perPage;
			echo "<a href='admin.php?page=Webkanban_log_list&start=" 
			. $start
			. "&slut=" 
			. $slut 
			. "' /> " 
			. ($i - 1)
			. "</a> - ";
			$start = $start+$perPage;
		}


	}

} // ends the class

$kpagn = new KbnLogPages();
?>

<div class='wrap'>
	<div id='icon-edit-pages' class='icon32'></div>
	<h2>Log</h2>
		<table class='KbnTd widefat'>
			<tr>
				<th>
					<div id='KbnLogSeek'>
						<? include_once('seek.inc'); // display the seek field ?>
					</div>
					<br />
					<? $kpagn->showPages(); // display page numbers in th ?>
				 </th>

			</tr>
<?
// navigation menu
include_once('iconPanel.php');

// sql according to the state of $result
foreach($result as $row){

	echo	"<tr>
			<td class='KbnTd'>
				<a href='http://multimusen.dk/wp-admin/admin.php?page=Webkanban_log_list&KbnNoteFilter="
				. $row->KbnNotesId
				. "'> Filter Note:  $row->KbnNotesId </a> <br />
				$row->KbnNotesName
		
			</td>
		</tr>
	";
}
	echo 	"<tr><td>";
	$kpagn->showPages();
	echo	"</td><tr>";

?>
</table>
</div>
