<div id='wrap'>
	<div class='KbnHelp'>
	<h1>Webkanban Help</h1>

	<p>
		<strong> - a planning tool for the reflective practiconer </strong>
	</p>

	<p>
		The webkanban is a kanbansystem for groups or individuals. 
		Basicly a kanban is a board with signs on it.
		The board is divided in columns with headers such as 'Todo' - 'Doing' - 'Done'.
		These colums represent the workflow from the beginning of a task
		to the end.
	</p>
	<p>
	  The word kanban is japanese.
	  The litteral meaning of the word is "sign-board".
	  Kanbans are used in project planning. 
	</p>
	<p>
	  Probably 'sign-boards' are as old as the human efforts to paint
	  and write. But the word kanban was used from around 1950 at the 
	  Toyota factories.
	</p>
	</div>

	<div class='KbnHelp'> 
      <h2>The Icon Panel</h2>
      <? require('iconPanel.php'); ?>

	<div style='clear:both'></div>
      <p>
         The Icon Panel is a shortcut to the features of this webkanban.      
      </p>
	</div>


	<div class='KbnHelp'>

	  <h2>The Dashboard Menu</h2>
	  <p>
	     To the left you find the Dashboard menu. A click on 'Kanban' will give
	     you these options:
	  </p>

<!-- menu copy -->

<ul class='wp-submenu wp-submenu-wrap'>
<li class='wp-submenu-head'>Kanban</li>
<li class="wp-first-item"><a href='admin.php?page=web_kanban' class="wp-first-item">Kanban</a></li>
<li><a href='admin.php?page=Webkanban_board_minimal_view'>Minimal board</a></li>
<li><a href='admin.php?page=Webkanban_Select'>Select Board</a></li>
<li><a href='admin.php?page=Webkanban_New_Note'>New task</a></li>
<li><a href='admin.php?page=Webkanban_log_list'>Log</a></li>
<li><a href='admin.php?page=Webkanban_Projects_Editor'>Kanban Boards</a></li>
<li><a href='admin.php?page=Webkanban_edit_states'>Settings: Notes, States and Colors</a></li>
<li><a href='admin.php?page=Webkanban_litterature'>Litterature list</a></li>
<li class="current"><a href='admin.php?page=webkanban_help' class="current">Help</a></li></ul>

<!-- ends menu --> 

	</div>


	<div class='KbnHelp'>
      <h2>Kanban</h2>	
      <p>
         Click here - and the active kanban is displayed      
      </p>
      <p>
         You can choose another kanban in 'Select Board'
         or create a new one in 'Kanban Boards'.      
      </p>
	</div>
	<div class='KbnHelp'> 
      <h2>Minimal Board (shortcode)</h2>
      <p>
         This is just a demo of a shortcode.
         If you write the shortcode 'MiniKanban' in sharp brackets
         a minimal kanban will be displayed in posts or pages.      
      </p>
      <p>
	[MiniKanban]
	</p>
	</div>
	<div class='KbnHelp'> 
      <h2>Select Board</h2>
      <p>
         You can work with several boards. 
         There might be one for personal work,
         another for group efforts,
         and so on.      
      </p>
      <p>
         Click the dropdownlist, and select a board. Then click the link
         and the chosen kanban will be active.      
      </p>
	</div>
	<div class='KbnHelp'> 
      <h2>Log</h2>	
      <p>
         After working on a project
         or during the project
         you may reflect on what is happening - and why.
         The log will save all changes to states,
         and blog posts.      
      </p>
      <p>
         Your blog posts or comments to the notes
         will be saved too.   
      </p>
      <p>
         'Filter note: XYZ'will show you the 'fate'
         of just one task. If you want to know
         how and when you worked on 'Fix the bike' the
         'Filter note' will show you the log entries.
      </p>
	</div>
		<div class='KbnHelp'> 
      <h2>Kanban Boards</h2>
      <p>
         A list of the boards.      
      </p>	
	</div>
		<div class='KbnHelp'> 
      <h2>Settings: Notes, States, and Colors</h2>
      <p>
         Opens a menu, where you can add or edit settings on the notes.       
      </p>
	</div>
		<div class='KbnHelp'> 
      <h2>Litterature list</h2>
      <p>
         References to litterature used when I wrote the master thesis.
         Inspired by Umberto Eco I thought that the cards for notes
         looked like something a database could do better.
         So I hacked something to display the list.      
      </p>	
	</div>
	<div class='KbnHelp'>
      <h2>Copyright</h2>
      <p>
         <strong>WEBKANBAN - a planning tool for the reflective practiconer</strong>
      </p>       
      <p>    
    Copyright &copy; 2013  Per Thykjaer Jensen
</p><p>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
</p><p>

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
</p><p>

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <a href='http://www.gnu.org/licenses'> here </a>.      
      </p>      
	</div>
</div>