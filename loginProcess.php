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
	if($_GET['id'] == $id) {
		$_SESSION['id'] = $id;
		header("Location:./index.php");
	} else {
		header("Location:./index.php");
	}
} else if(isset($_POST['id'])) {
	if($_POST['id'] == $id) {
		$_SESSION['id'] = $id;
		header("Location:./index.php");
	} else {
		header("Location:./index.php");
	}
} else {
	header("Location:./index.php");
}