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
	require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
	require_once('../../core/abre_functions.php');
	require_once(dirname(__FILE__) . 'functions.php');

	//get the current page the user is on
	if(isset($_POST["page"])){
		if($_POST["page"] == ""){
			$PageNumber = 1;
		}else{
			$PageNumber = $_POST["page"];
		}
	}else{
		$PageNumber = 1;
	}

	$PerPage = 10;

	//set bounds for pagination
	$LowerBound = $PerPage * ($PageNumber - 1);
	$UpperBound = $PerPage * $PageNumber;

	if(isset($_POST["searchquery"])){
		$searchquery = strtolower(mysqli_real_escape_string($db, $_POST["searchquery"]));
	}else{
		$searchquery = "";
	}

	if($searchquery == ""){
		$querycount = "SELECT COUNT(*) FROM club_info";
		$sql = "SELECT ID, Private, Name, Description, Email, Editors, Image, Building, Categories FROM club_info ORDER BY Name LIMIT $LowerBound, $PerPage";
	}else{
		$querycount = "SELECT COUNT(*) FROM club_info WHERE (LOWER(Name) LIKE '%$searchquery%' OR LOWER(Description) LIKE '%$searchquery%' OR LOWER(Categories) LIKE '%$searchquery%')";
		$sql = "SELECT ID, Private, Name, Description, Email, Editors, Image, Building, Categories FROM club_info WHERE (LOWER(Name) LIKE '%$searchquery%' OR LOWER(Description) LIKE '%$searchquery%' OR LOWER(Categories) LIKE '%$searchquery%') ORDER BY Name LIMIT $LowerBound, $PerPage";
	}

	$result = $db->query($sql);
	$totalclubcount=mysqli_num_rows($result);
	$clubcounter=0;
	while($row = $result->fetch_assoc()){

		$clubcounter++;

		if($clubcounter == 1){
		?>
			<div class='page_container mdl-shadow--4dp'>
			<div class='page'>
			<div id='searchresults'>
			<div class='row'><div class='col s12'>
			<table id='myTable' class='highlight'>
			<thead>
			<tr>
			<th class='hide-on-med-and-down'></th>
			<th>Name</th>
			<th class='hide-on-med-and-down'>Description</th>
			<th style='width:30px'></th>
			</tr>
			</thead>
			<tbody>
		<?php
		}
		$Club_ID = htmlspecialchars($row["ID"], ENT_QUOTES);
		$Club_Private = htmlspecialchars($row["Private"], ENT_QUOTES);
		$Club_Name = htmlspecialchars($row["Name"], ENT_QUOTES);
		$Club_Description = htmlspecialchars($row["Description"], ENT_QUOTES);
		$Club_Email = htmlspecialchars($row["Email"], ENT_QUOTES);
		$Club_Editors = htmlspecialchars($row["Editors"], ENT_QUOTES);
		$Club_Image = htmlspecialchars($row["Image"], ENT_QUOTES);
		$Club_Building = htmlspecialchars($row["Building"], ENT_QUOTES);
		$Club_Categories = htmlspecialchars($row["Categories"], ENT_QUOTES);
		if($Club_Image == ""){ $Club_Image = "generic.jpg"; }

		echo "<tr class='clubrow pointer'>";
			echo "<td class='hide-on-med-and-down exploreclub' data-href='#clubs/$Club_ID'>";
				echo "<img src='modules/".basename(__DIR__)."/images/$Club_Image' class='profile-avatar-small'>";
				echo "</td>";
				echo "<td class='exploreclub' data-href='#clubs/$Club_ID'>$Club_Name</td>";
				echo "<td class='hide-on-med-and-down exploreclub' data-href='#clubs/$Club_ID'>$Club_Description</td>";
				echo "<td style='width:30px;'>";

				include "../../core/abre_dbconnect.php";
				$userid = finduseridcore($_SESSION['useremail']);
				$sqllookup = "SELECT COUNT(*) FROM club_libraries WHERE User_ID = '$userid' AND Club_ID = '$Club_ID'";
				$result2 = $db->query($sqllookup);
				$resultrow = $result2->fetch_assoc();
				$foundclub = $resultrow["COUNT(*)"];

				echo "<div class='morebutton' style='position:relative;'>";
					echo "<button id='demo-menu-bottom-left-$Club_ID' class='mdl-button mdl-js-button mdl-button--icon mdl-js-ripple-effect mdl-color-text--grey-600'><i class='material-icons'>more_vert</i></button>";
					echo "<ul class='mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect' for='demo-menu-bottom-left-$Club_ID'>";
					if($foundclub == 0){
						echo "<li class='mdl-menu__item addclub'><a href='modules/".basename(__DIR__)."/club_addlibrary.php?libraryclubid=".$Club_ID."' class='mdl-color-text--black' style='font-weight:400'>Add to My Clubs</a></li>";
					} else {
						echo "<li class='mdl-menu__item remclub'><a href='modules/".basename(__DIR__)."/club_remove_process.php?libraryclubid=".$Club_ID."' class='mdl-color-text--black' style='font-weight:400'>Remove from My Clubs</a></li>";
					}

					if(checkEditors($Club_ID)) {
						echo "<li class='mdl-menu__item editclub' href='#newclub' data-id='$Club_ID' data-private='$Club_Private' data-name='$Club_Name' data-description='$Club_Description' data-email='$Club_Email' data-editors='$Club_Editors' data-image='$Club_Image' data=building='$Club_Building' data-categories='$Club_Categories' style='font-weight:400'>Edit</a></li>";
						echo "<li class='mdl-menu__item duplicateclub' data-clubid='$Club_ID'>Duplicate</li>";
						echo "<li class='mdl-menu__item deleteclub' data-clubid='$Club_ID'>Delete</li>";
					}
					echo "</ul>";
				echo "</div>";
			echo "</td>";
		echo "</tr>";
	}

	if($totalclubcount == $clubcounter){
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
		echo "</div>";

		//getting count for pagination
		$result = $db->query($querycount);
		$dbreturnpossible = $result->fetch_assoc();
		$totalpossibleresults = $dbreturnpossible["COUNT(*)"];

		//Paging
		$totalpages = ceil($totalpossibleresults / $PerPage);
		if($totalpossibleresults > $PerPage){
			$previouspage = $PageNumber-1;
			$nextpage = $PageNumber+1;
			if($PageNumber > 5){
				if($totalpages > $PageNumber + 5){
					$pagingstart = $PageNumber - 5;
					$pagingend = $PageNumber + 5;
				}else{
					$pagingstart = $PageNumber - 5;
					$pagingend = $totalpages;
				}
			}else{
				if($totalpages >= 10){ $pagingstart = 1; $pagingend = 10; }else{ $pagingstart = 1; $pagingend = $totalpages; }
			}

			echo "<div class='row'><br>";
				echo "<ul class='pagination center-align'>";
					if($PageNumber != 1){ echo "<li class='pagebutton' data-page='$previouspage'><a href='#'><i class='material-icons'>chevron_left</i></a></li>"; }
					for($x = $pagingstart; $x <= $pagingend; $x++){
						if($PageNumber == $x){
							echo "<li class='active pagebutton' style='background-color: ".getSiteColor().";' data-page='$x'><a href='#'>$x</a></li>";
						}else{
							echo "<li class='waves-effect pagebutton' data-page='$x'><a href='#'>$x</a></li>";
						}
					}
					if($PageNumber != $totalpages){ echo "<li class='waves-effect pagebutton' data-page='$nextpage'><a href='#'><i class='material-icons'>chevron_right</i></a></li>"; }
				echo "</ul>";
			echo "</div>";
		}
		echo "</div>";
		echo "</div>";
	}

	if($totalclubcount == 0){
		echo "<div class='row' style='padding:56px; text-align:center; width:100%;'><span style='font-size: 22px; font-weight:700'>No Clubs Found</span><br><p style='font-size:16px; margin:20px 0 0 0;'>Click the '+' in the bottom right to create a club.</p></div>";
	}
	echo "</div>";



?>

<script>

	//Process the profile form
	$(function(){

		//Make Explore clickable
		$(".exploreclub").unbind().click(function() {
			 window.open($(this).data('href'), '_self');
		});

		//Duplicate club
		$(".duplicateclub").unbind().click(function(event){
			event.preventDefault();
			var ClubIDDuplicate = $(this).data('clubid');
			$.ajax({
				type: 'POST',
				url: 'modules/<?php echo basename(__DIR__); ?>/club_duplicate_process.php',
				data: { clubIDduplicateid : ClubIDDuplicate }
			})
			.done(function(response) {
				$("#displayclubs").load( "modules/<?php echo basename(__DIR__); ?>/clubs_directory_all.php", {page: '<?php echo $PageNumber ?>', searchquery: '<?php echo $searchquery ?>'}, function(){
					mdlregister();
					var notification = document.querySelector('.mdl-js-snackbar');
					var data = { message: response };
					notification.MaterialSnackbar.showSnackbar(data);
				});
			})
		});

		//Delete club
		$(".deleteclub").unbind().click(function(event){
			event.preventDefault();
			var Club_ID = $(this).data('clubid');
			var result = confirm("Delete the entire club?");
			if (result) {

				var address = $(this).find("a").attr("href");
				$.ajax({
					type: 'POST',
					url: 'modules/<?php echo basename(__DIR__); ?>/club_delete.php?libraryclubid='+Club_ID,
					data: '',
				})

				//Show the notification
				.done(function(response) {

					$( "#displayclubs" ).load( "modules/<?php echo basename(__DIR__); ?>/clubs_directory_all.php", {page: '<?php echo $PageNumber ?>', searchquery: '<?php echo $searchquery ?>'}, function(){
						//Register MDL Components
						mdlregister();
						var notification = document.querySelector('.mdl-js-snackbar');
						var data = { message: response };
						notification.MaterialSnackbar.showSnackbar(data);
					});
				})
			}
		});

		$(".newclub").off().on("click", function () { //data-id='$Club_ID' data-editors='$Club_Editors' data-image='$Club_Image' data=building='$Club_Building' data-categories='$Club_Categories'
			var Club_ID = $(this).data('id');
			$(".modal-content #club_id").val(Club_ID);
			var Club_Private = $(this).data('private');
			if(Club_Private == '1'){
				$(".modal-content #club_private").prop('checked',true);
			}else{
				$(".modal-content #club_private").prop('checked',false);
			}
			var Club_Name = $(this).data('name');
			$("#club_name").val(Club_Name);
			var Club_Description = $(this).data('description');
			$(".modal-content #club_description").val(Club_Description);
			var Club_Email = $(this).data('email');
			$(".modal-content #club_email").val(Club_Email);
			var Club_Leaders = $(this).data('editors');
			$(".modal-content #club_email").val(Club_Leaders);
			var Club_Building = $(this).data('building');
			$(".modal-content #club_building").val(Club_Building);


			$('#newclub').openModal({
				in_duration: 0,
				out_duration: 0,
				ready: function() { $("#club_name").focus(); }
			});

		});

		//Add club
		$( ".addclub" ).unbind().click(function(event) {
			event.preventDefault();
			$(this).hide();
			var address = $(this).find("a").attr("href");
			$.ajax({
				type: 'POST',
				url: address,
				data: '',
			})

			//Show the notification
			.done(function(response) {
				mdlregister();
				var notification = document.querySelector('.mdl-js-snackbar');
				var data = { message: response };
				notification.MaterialSnackbar.showSnackbar(data);
			})

		});

	});


</script>
