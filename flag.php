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

if(!isset($_SESSION['id']) || $_SESSION['id'] != "8b1a9953c4611296a827abf8c47804d7") {
	header("Location:./index.php");
}

function db_open() {
	$mysqli = new mysqli("localhost", "turner_flashmob", "flash", "turner_flashmob");
	if($mysqli->connect_errno) {
		die($mysqli->connect_error);
		return FALSE;
	}
	
	return $mysqli;
}

//Check to see if there is already a flag
$query = "SELECT * FROM flags WHERE 
	(deck='" . $_POST['deck'] . "') AND 
	(card='" . $_POST['cardid'] . "')";
$conn = db_open();

if(!$conn) {
	die("ERROR");
}

$result = $conn->query($query);

//If not, set one
if(!$result || ($result->num_rows == 0)) {
	$query = "INSERT INTO flags (deck, card) VALUES 
		('" . $_POST['deck'] . "', 
		" . $_POST['cardid'] . ")";
	$conn->query($query);
}

header("Location:./card.php");