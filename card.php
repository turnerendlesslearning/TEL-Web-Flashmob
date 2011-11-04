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


?><html lang="tr_TR">
<head>
<title>TEL Flashcards - Mobile</title>
<meta http-equi="Content-type" content="text/html;charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


<script type="text/javascript">
	function showAnswer() {
		if(document.getElementById('ansButton').value=="Answer") {
			document.getElementById('answerDiv').style.display='';
			document.getElementById('ansButton').value="Next";
		} else {
			document.location.href='card.php';
		}
	}
</script>
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

//Initialize the variables
$card = null;
$question = null;
$answer = null;
$front = 0;
$back = 1;
$type = $_SESSION['type'];

//Load card $question and $answer
$card = $_SESSION['card'];

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


//Set the current card number
if($type == 2 || $type == 5 || $type == 6) {
	//Sequential.... just increment the card
	$card++;
} else {
	//Random... randomly select one
	$card = rand(0,  count($cardData) - 1);
}

//Handle loop over
if($card >= count($cardData)) {
	$card = 0;
}

//Set which part will be the front and which the back

//If type = 1 or 2, randomize the display of front or back
if($type == 1 || $type == 2) {
	$front = rand(0, 1);
	if($front) {
		$back = 0;
	} else {
		$back = 1;
	}
} else if($type == 4 || $type == 6) {
	$front = 1;
	$back = 0;
}

//Clean the card data if I need to
if($_SESSION['clean']) {
	$question = cleanCard($cardData[$card][$front]);
	$answer = cleanCard($cardData[$card][$back]);
} else {
	$question = $cardData[$card][$front];
	$answer = $cardData[$card][$back];
}

//Display Card Info
echo "[" . ($card + 1) . "/" . count($cardData) . "]" . "<br />";

//Display the Question
echo $question . "<br />";

//Display the Answer Button
echo "<br /><input type=\"button\" id=\"ansButton\" 
	value=\"Answer\" onclick=\"showAnswer();\" /><br />";
?>



<div id="answerDiv" style="display:none;">
<br />Answer:<br />
<?php echo $answer; ?>
</div><br /><a href="index.php">-menu-</a><br />
<form method="post" action="flag.php">
<input type="hidden" name="cardid" value="<?php echo ($card+1); ?>" />
<input type="hidden" name="deck" value="<?php echo $_SESSION['deck']; ?>" />
<input type="submit" value="Flag" />
</form>
<?php if($type == 2 || $type == 5 || $type == 6) {?>
<form method="post" action="goto.php">
<input type="text" name="card" size="3" />
<input type="submit" value="&gt;" />
</form>
<?php }?>
</body>
<?php 
	//Set the new card value
	$_SESSION['card'] = $card;
?>
</html>