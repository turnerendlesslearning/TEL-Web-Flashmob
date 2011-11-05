<?php session_start();

/*
* Copyright (C) 2011 Michael Turner <michael at turnerendlesslearning.com>
*
* This program is free software: you can redistribute it and/or modify it under
* the terms of the GNU General Public License as published by the Free Software
* Foundation, either version 3 of the License, or (at your option) any later
* version.
*
* This program is distributed in the hope that it will be useful, but WITHOUT
* ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
* FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License along with
* this program. If not, see <http://www.gnu.org/licenses/>.
*/

$id="8b1a9953c4611296a827abf8c47804d7";

if(isset($_GET['id'])) {
	header("Location: ./loginProcess.php?id=" . $_GET['id']);
}

?><html lang="tr_TR">
<head>
<title>TEL Flashcards - Mobile</title>
<meta name="viewport" content="width=320" />


</head>
<body>
<?php 

	//Handle Login
	if(!isset($_SESSION['id']) || $_SESSION['id'] != $id) {
		echo "<form method=\"post\" action=\"loginProcess.php\">" . PHP_EOL;
		echo "id <input type=\"text\" name=\"id\" /><br />" . PHP_EOL;
		echo "<input type=\"submit\" />" . PHP_EOL;		
		echo "</form>" . PHP_EOL;
		
		
		echo "</body></html>";
		die();
	}


	//Deck Info
	$decks = array();
	$decks[] = array("Turkish 1", "Turkish1", "1");
	$decks[] = array("Turkish 2", "Turkish2", "0");
	$decks[] = array("PHP" , "php", "0");
	$decks[] = array("PHP Arrays" , "php-arrays", "0");
	$decks[] = array("PHP Basics" , "php-basics", "0");
	$decks[] = array("PHP 4/5" , "php-php45", "0");
	$decks[] = array("PHP Arrays" , "php-arrays", "0");
	$decks[] = array("PHP Security" , "php-security", "0");
	$decks[] = array("PHP Streams" , "php-streams", "0");
	$decks[] = array("PHP Strings" , "php-strings", "0");
	$decks[] = array("PHP Web" , "php-web", "0");
	$decks[] = array("PHP Xml" , "php-xml", "0");
?>

	<table>
		<tr>
			<td><b>Deck</b></td>
			<td><b>Options</b></td>
		</tr>
		<?php 
		foreach($decks as $deck) {
			echo "<tr>";
			echo "<td>" . $deck[0] . "</td>";
			echo "<td>";
			echo "<form method=\"post\" action=\"launcher.php\">";
			echo "<input type=\"hidden\" name=\"deck\" value=\"".
				$deck[1]."\" />";
			echo "	<input type=\"hidden\" name=\"clean\" value=\"".
				$deck[2]."\" />";
			echo "	<select name=\"type\" style=\"font-size:9px;\">";
			echo "		<option value=\"1\">Random</option>";
			echo "		<option value=\"2\">Sequential</option>";
			echo "		<option value=\"3\">Random - Front</option>";
			echo "		<option value=\"4\">Random - Back</option>";
			echo "		<option value=\"5\">Sequential - Front</option>";
			echo "		<option value=\"6\">Sequential - Back</option>";
			echo "		<option value=\"7\">List All</option>";
			echo "		<option value=\"8\">List Flagged</option>";
			echo "	</select>";
			echo "	<input type=\"submit\" value=\"&gt;\" />";
			echo "	</form>";
			echo "</td>";
			echo "</tr>";
		}
		?>
	</table>
</body>
</html>
