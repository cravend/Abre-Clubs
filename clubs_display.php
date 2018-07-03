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
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');

	echo "<div class='page_container'>";
	echo "<div class='row'>";

	$userid=finduseridcore($_SESSION['useremail']);
	$sql = "SELECT Club_ID, ID FROM club_libraries WHERE User_ID='$userid'";
	$result = $db->query($sql);
	$numrows = $result->num_rows;
	$clubcount=0;
	while($row = $result->fetch_assoc())
	{
		$Club_ID=htmlspecialchars($row["Club_ID"], ENT_QUOTES);
		$Library_ID=htmlspecialchars($row["ID"], ENT_QUOTES);
		$sqllookup = "SELECT Name, Description, Image, Building, Categories FROM club_info WHERE ID='$Club_ID'";
		$result2 = $db->query($sqllookup);
		$setting_preferences=mysqli_num_rows($result2);
		while($row = $result2->fetch_assoc())
		{

			$Name=htmlspecialchars($row["Name"], ENT_QUOTES);
			$Description=htmlspecialchars($row["Description"], ENT_QUOTES);
			$Building=htmlspecialchars($row["Building"], ENT_QUOTES);
			$Categories=htmlspecialchars($row["Categories"], ENT_QUOTES);
			$Image=htmlspecialchars($row["Image"], ENT_QUOTES);
			if($Image==""){ $Image="generic.jpg"; }

			echo "<div class='mdl-card mdl-shadow--2dp card_clubs'>";
				echo "<div class='mdl-card__media mdl-color--grey-100 mdl-card--expand' style='height:120px; background-image: url(modules/".basename(__DIR__)."/images/$Image);'></div>";
				echo "<div class='mdl-card__title'><div class='mdl-card__title-text truncate'><span class='truncate'>$Name</span></div></div>";
				echo "<div class='mdl-card__supporting-text'>$Description</div>";
				echo "<div class='mdl-card__actions'>";
					echo "<a class='mdl-button mdl-js-button mdl-js-ripple-effect' style='color: ".getSiteColor()."' href='#clubs/$Club_ID'>Explore</a>";
					echo "<div class='mdl-layout-spacer'></div>";
					echo "<div class='removeclub'><a class='mdl-button mdl-js-button mdl-button--icon mdl-color-text--grey-600' href='modules/".basename(__DIR__)."/club_remove_process.php?libraryclubid=".$Library_ID."'><i class='material-icons'>delete</i></a></div>";
				echo "</div>";
			echo "</div>";
			$clubcount++;
		}
	}

	if($clubcount==0)
	{
		echo "<div class='row' style='padding:56px; text-align:center; width:100%;'><span style='font-size: 22px; font-weight:700'>No Clubs Yet</span><br><p style='font-size:16px; margin:20px 0 0 0;'>Click the 'All Clubs' at the top to browse the club catalog.</p></div>";
	}
	echo "</div>";
	echo "</div>";

?>
