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
	
	$deck = $_POST['deck'];
	$type = $_POST['type'];
	$clean = $_POST['clean'];
	
	$_SESSION['deck'] = $deck;
	$_SESSION['type'] = $type;
	$_SESSION['card'] = -1;
	$_SESSION['clean'] = $clean;
	
	if($type == 7 || $type == 8) {
		header("Location: ./list.php");
	} else {
		header("Location: ./card.php");
	}
?>