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

	$Club_ID = htmlspecialchars($_GET["ClubID"], ENT_QUOTES);

	if($pagerestrictions == "")
	{
			$sqllookup = "SELECT Name, Description, Email, Image, Building, Categories, Editors FROM club_info WHERE ID='$Club_ID'";
			$result2 = $db->query($sqllookup);
			$setting_preferences=mysqli_num_rows($result2);
			$row = $result2->fetch_assoc();
			$Name=htmlspecialchars($row["Name"], ENT_QUOTES);
			$Description=htmlspecialchars($row["Description"], ENT_QUOTES);
			$Email=htmlspecialchars($row["Email"], ENT_QUOTES);
			$Building=htmlspecialchars($row["Building"], ENT_QUOTES);
			$Categories=htmlspecialchars($row["Categories"], ENT_QUOTES);
			$Image=htmlspecialchars($row["Image"], ENT_QUOTES);
			$Editors=htmlspecialchars($row["Editors"], ENT_QUOTES);
			if($Image==""){ $Image="generic.jpg"; }


	    echo "<div class='row'>";

	    	//Main Content
	    	echo "<div class='col l8 m12 s12'>";

	    		echo "<div class='mdl-shadow--2dp' style='background-color:#fff; padding:20px 40px 40px 40px; margin-bottom:20px; width:100%;'>";
		    		echo "<div class='light' style='margin-bottom:40px;'>";
						echo "<ul class='tabs' style='background-color:rgba(0, 0, 0, 0)'>";
							echo "<li class='tab col s3'><a href='#announcements'><i class='material-icons hide-on-large-only'>announcement</i><span class='hide-on-med-and-down'>Announcements</span></a></li>";
							echo "<li class='tab col s3'><a href='#resources'><i class='material-icons hide-on-large-only'>folder_shared</i><span class='hide-on-med-and-down'>Resources</span></a></li>";
							echo "<li class='tab col s3'><a href='#enrollment'><i class='material-icons hide-on-large-only'>people</i><span class='hide-on-med-and-down'>Enrollment</span></a></li>";
						echo "</ul>";
					echo "</div>";

					//Body
					echo "<div id='announcements'>";
						include "club_info_announcements.php";
					echo "</div>";

					echo "<div id='resources'>";
						include "club_info_resources.php";
					echo "</div>";

					echo "<div id='enrollment'>";
						include "club_info_roster.php";
					echo "</div>";

				echo "</div>";

			echo "</div>";

			//Profile
			echo "<div class='col l4 m12 s12'>";
				echo "<div class='mdl-shadow--2dp' style='background-color:#fff; padding:30px 35px 15px 35px;'>";

					//Name
					echo "<div class='center-align'><img src='modules/".basename(__DIR__)."/images/$Image' style='max-width:100%; max-height:100%;'></div>";
					echo "<h4 class='center-align'>$Name</h4>";
					echo "<p>$Description</p>";

					//Break
					echo "<hr>";
					//Basic Information
					echo "<h5>Club Information</h5>";


					$lead = explode(",", $Editors);
					echo "<ul>";
					echo "<li>hi: " . GetStaffFirstName($lead[0]) . "</li>";
					// $i = 0;
					// while (trim($lead[$i]) != NULL) {
					// 	$lead[$i] = trim($lead[$i]);
					// 	if (GetStudentFirstName($lead[$i]) != "") {
					// 		echo "<li>name: " . GetStudentFirstName($lead[$i]) . "</li>";
					// 	} elseif (GetStaffFirstName($lead[$i]) != "") {
					// 		echo "<li>staff name: " . GetStaffFirstName($lead[$i]) . "</li>";
					// 	}
					// 	$i++;
					// }
					echo "</ul>";

						echo "<p>";
							//Student Email
							echo "<b>Email:</b> ";
							if(admin()){
								if($Student_Email != ""){
									echo "<span class='input-field'><input id='studentemail' type='text' value='$Student_Email'></span><br>";
								}else{
									echo "<span class='input-field'><input id='studentemail' type='text' placeholder='No Associated Email'></span><br>";
								}
							}
							else{
								if($Student_Email != ""){
									echo "<span>$Student_Email</span><br>";
								}else{
									echo "<span>No Associated Email</span><br>";
								}
							}
						echo "</p>";

						//Save Button for Email
						if(admin()){
							echo "<button class='waves-effect btn-flat white-text' id='updateemail' style='width:100%; background-color:"; echo getSiteColor(); echo "; margin-bottom:20px;'>Save Email</button>";
						}





				echo "</div>";
			echo "</div>";

		echo "</div>";

	}else{
		echo "<div class='row' style='padding:56px; text-align:center; width:100%;'><span style='font-size: 22px; font-weight:700'>Oops! Something went wrong!</span><br><p style='font-size:16px; margin:20px 0 0 0;'>You do not have access to this student's information.</p></div>";
	}

?>

<script>

	$(function()
	{

	    $('ul.tabs').tabs();

	    $("#myTable").tablesorter({

    	});

		//Reset Parent Access Token
		$("#resettoken").unbind().click(function(event)
		{
			event.preventDefault();
			var Student_ID = $(this).data('studentid');
			var Token = $(this).data('token');
			var result = confirm('Are you sure you want to proceed? This will create new key for this student and invalidate the current parent keys.');
			if(result){
				$("#resettoken").html("Resetting Token...");
				$.post("/modules/Abre-Students/generate_new_key.php", { studentid: Student_ID, token: Token }, function(){ })
				.done(function()
				{
					$("#dashboard").load('modules/<?php echo basename(__DIR__); ?>/student.php?Student_ID='+Student_ID, function()
					{
						$(".landingloader").hide();
						$("#dashboard").fadeTo(0,1);
					});
		  		})

			}
		});

		//Update Student Email
		$("#updateemail").unbind().click(function()
		{
			var Email = $( "#studentemail" ).val();
			var StudentID = $( "#studentid" ).text();

			$.post("modules/<?php echo basename(__DIR__); ?>/savestudentemail.php", { Email: Email, StudentID: StudentID })
			.done(function( data ) {
				var notification = document.querySelector('.mdl-js-snackbar');
				var data = { message: "Email Updated" };
				notification.MaterialSnackbar.showSnackbar(data);
  			});
		});

		var isOpen = false;
		$("#displayInfo").off().on('click', function(){
			isOpen = !isOpen;
			if(isOpen){
				$("#loginInformation").show();
				$("#studentPassword").text("<?php if($Password != ""){ echo decrypt($Password, ''); }else{ echo ""; }?>");
				$("#displayInfo").text('visibility_off');
			}else{
				$("#loginInformation").hide();
				$("#studentPassword").text("");
				$("#displayInfo").text('visibility');
			}
		})

	});

</script>
