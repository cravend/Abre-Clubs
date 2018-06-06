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
	$club_id=mysqli_real_escape_string($db, $_POST["clubIDduplicateid"]);

	if($club_id!="")
	{

		//Duplicate the club
		$sqllookup2 = "SELECT Private, Name, Description, Email, Editors, Image, Building, Categories FROM club_info WHERE ID='$club_id'";
		$result3 = $db->query($sqllookup2);
		while($row2 = $result3->fetch_assoc())
		{
			$Club_Private=$row2["Private"];
			$Club_Name=$row2["Name"];
			$Club_Name="$Club_Name - Duplicated";
			$Club_Description=$row2["Description"];
			$Club_Email=$row2["Subject"];
			$Club_Editors=$row2["Editors"];
			$Club_Image=$row2["Image"];
			$Club_Building=$row2["Building"];
			$Club_Categories=$row2["Categories"];

			$stmt = $db->stmt_init();
			$sql = "INSERT INTO club_info (Private, Name, Description, Email, Editors, Image, Building, Categories) VALUES ('$Club_Private', '$Club_Name', '$Club_Name', '$Club_Description', '$Club_Email', '$Club_Editors', '$Club_Image', '$Club_Building', '$Club_Categories');";
			$stmt->prepare($sql);
			$stmt->execute();
			$new_clubID = $stmt->insert_id;
			$stmt->close();
		}
		$db->close();

		echo "The club has NOT been duplicated.!!$club_id";
	}


?>
