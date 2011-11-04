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

function db_open() {
	$mysqli = new mysqli("localhost", "turner_flashmob", "flash", "turner_flashmob");
	if($mysqli->connect_errno) {
		die($mysqli->connect_error);
		return FALSE;
	}
	
	return $mysqli;
}

?><html lang="tr_TR">
<head>
<title>TEL Flashcards - Mobile</title>
<meta http-equi="Content-type" content="text/html;charset=UTF-8" />
<style type="text/css">
  body, td, input {
    font-size:9px; 
    }
   form {
   	margin:0px;
   	padding:0px;
   	}
</style>
</head>
<body>
<?php 
function cleanCard($card) {
	$loc = strpos($card, "<br />");
	if($loc > 0) {
		$card = substr($card, 0, $loc);
	}
	$loc = strpos($card, "[");
	if($loc > 0) {
		$card = substr($card, 0, $loc);
	}
	return $card;
}

//Load the card data
$cardData = array();
$fileHandle = fopen($_SESSION['deck'] . ".csv", "r");
while(!feof($fileHandle)) {
	$readArray = fgetcsv($fileHandle, null, "\t");
	if(count($readArray) != 0) {
		//var_dump($readArray);
		$cardData[] = $readArray;
	}
}

//Display Menu Link above and below
?>
<a href="index.php">-menu-</a>

<?php 
//Display List
echo "<table>";
for($card = 0; $card < count($cardData); $card++) {
	if($_SESSION['type'] == 8) {
		//Only list it if it is flagged
		$conn = db_open();
		$result = $conn->query("SELECT * FROM flags WHERE (deck='" . 
			$_SESSION['deck'] . "') AND (card=" . ($card + 1) . ")");
		if(!$result || $result->num_rows == 0) {
			continue;
		}
	}
	
	//Clean the card data if I need to
	$question = null;
	$answer = null;
	
	if($_SESSION['clean']) {
		$question = cleanCard($cardData[$card][0]);
		$answer = cleanCard($cardData[$card][1]);
	} else {
		$question = $cardData[$card][0];
		$answer = $cardData[$card][1];
	}
	
	echo "<tr>";
	echo "<td>";
	echo strip_tags($question);
	echo "</td>";
	echo "<td>";
	echo strip_tags($answer);
	echo "</td>";
	echo "</tr>";
}
echo "</table>";


?>

<a href="index.php">-menu-</a>
</html>