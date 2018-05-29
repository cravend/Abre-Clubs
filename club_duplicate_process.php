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
		$sqllookup2 = "SELECT ID, Title, Level, Subject, Grade, Image FROM club_info WHERE ID='$club_id'";
		$result3 = $db->query($sqllookup2);
		while($row2 = $result3->fetch_assoc())
		{
			$Club_ID=$row2["ID"];
			$Club_Title=$row2["Title"];
			$Club_Title="$Club_Title - Duplicated";
			$Club_Level=$row2["Level"];
			$Club_Subject=$row2["Subject"];
			$Club_Grade=$row2["Grade"];
			$Club_Image=$row2["Image"];

			$stmt = $db->stmt_init();
			$sql = "INSERT INTO club_info (Title, Level, Subject, Grade, Image) VALUES ('$Club_Title', '$Club_Level', '$Club_Subject', '$Club_Grade', '$Club_Image');";
			$stmt->prepare($sql);
			$stmt->execute();
			$new_clubID = $stmt->insert_id;
			$stmt->close();
		}
		$db->close();

	}

	echo "The club has been duplicated.";

?>
