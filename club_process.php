<?php

	/*
	* Copyright (C) 2016-2018 Abre.io Inc.
	*
	* This program is free software: you can redistribute it and/or modify
    * it under the terms of the Affero General Public License version 3
    * as published by the Free Software Foundation.
	*
    * This program is distributed in the hope that it will be useful,
    * but WITHOUT ANY WARRANTY; without even the implied warranty of
    * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    * GNU Affero General Public License for more details.
	*
    * You should have received a copy of the Affero General Public License
    * version 3 along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
    */

	//Required configuration files
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require_once(dirname(__FILE__) . '/../../core/abre_dbconnect.php');

	//Add the club
	$club_title=mysqli_real_escape_string($db, $_POST["club_title"]);
	$club_grade=$_POST["club_grade"];
	$club_grade = implode (", ", $club_grade);
	$club_subject=$_POST["club_subject"];
	$club_editors=$_POST["club_editors"];
	$club_image="generic.jpg";
	if($club_subject=="Mathematics"){ $club_image="mathematics.jpg"; }
	if($club_subject=="Science"){ $club_image="science.jpg"; }
	if($club_subject=="Social Studies"){ $club_image="socialstudies.jpg"; }
	if($club_subject=="English Language Arts"){ $club_image="english.jpg"; }
	if($club_subject=="Technology"){ $club_image="generic.jpg"; }
	$club_id=$_POST["club_id"];
	$club_hidden=isset($_POST["club_hidden"]);
	if($club_hidden==""){ $club_hidden="0"; }

	//Add or update the club
	if($club_id=="")
	{
		$stmt = $db->stmt_init();
		$sql = "INSERT INTO club_info (Hidden, Title, Subject, Grade, Image, Editors) VALUES ('$club_hidden', '$club_title', '$club_subject', '$club_grade', '$club_image', '$club_editors');";
		$stmt->prepare($sql);
		$stmt->execute();
		$stmt->close();
		$db->close();
	}
	else
	{
		mysqli_query($db, "UPDATE club_info set Hidden='$club_hidden', Title='$club_title', Subject='$club_subject', Grade='$club_grade', Editors='$club_editors' where ID='$club_id'") or die (mysqli_error($db));
	}

	//Give message
	echo "The club has been saved.";

?>
