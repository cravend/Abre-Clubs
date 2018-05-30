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
	require(dirname(__FILE__) . '/../../configuration.php');
	require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
	require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
	require_once('permissions.php');

	if($pagerestrictions=="")
	{

		//Get Variables Passed to Page
		if(isset($_GET["clubid"])){ $ClubID=htmlspecialchars($_GET["clubid"], ENT_QUOTES); }else{ $ClubID=""; }

		if($ClubID!="")
		{

			echo "<div style='position: absolute; top:0; bottom:0; left:0; right:0; overflow-y: hidden;'>";


				//Dashboard Data
				echo "<div id='overview' style='position:absolute; width: 100%; left:0; top:0; bottom:0; right:0; overflow-y: scroll; padding:20px;'>";
					echo "<div id='p2' class='mdl-progress mdl-js-progress mdl-progress__indeterminate landingloader' style='width:100%;'></div>";
					echo "<div id='dashboard'>";

					echo "</div>";
				echo "</div>";

			echo "</div>";

			?>
			<script>

				//Load the Overview
				var ClubID="<?php echo $ClubID; ?>";
				$("#dashboard").load('modules/<?php echo basename(__DIR__); ?>/club_info_dashboard.php?ClubID='+ClubID, function(){ $(".landingloader").hide(); });

			</script>
			<?php

		}


	//End Page Restrictions
	}
?>
