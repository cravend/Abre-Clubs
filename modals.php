<?php
/*
* Copyright (C) 2016-2017 Abre.io LLC
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
require_once(dirname(__FILE__) . '/../../core/abre_functions.php');
require_once('permissions.php');

if($pagerestrictions == ""){

}

if($_GET){
	if(isset($_GET['addStudent'])){
		echo "addstudent was called ";
		addStudent();
	}
}

?>
<div id="newclub" class="modal modal-fixed-footer modal-mobile-full">
	<form class="col s12" id="form-addclub" method="post" action="modules/<?php echo basename(__DIR__); ?>/club_process.php">
	<div class="modal-content" style="padding: 0px !important;">
		<div class="row" style='background-color: <?php echo getSiteColor(); ?>; padding: 24px;'>
			<div class='col s11'><span class="truncate" style="color: #fff; font-weight: 500; font-size: 24px; line-height: 26px;">Add Club</span></div>
			<div class='col s1 right-align'><a class="modal-close"><i class='material-icons' style='color: #fff;'>clear</i></a></div>
		</div>
		<div style='padding: 0px 24px 0px 24px;'>
			<div class="row">
				<div class="input-field col s6">
					<input id="club_name" name="club_name" placeholder="Name of the club" type="text" required>
					<label class="active" id="club_name">Club Name</label>
				</div>

				<div class="input-field col s6">
					<input id="club_email" name="club_email" placeholder="Contact email for the club" type="email" required>
					<label id="club_email">Club Email</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input id="club_description" name="club_description" placeholder="Description of the club" type="text" required>
					<label id="club_description">Club Description</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<div class="form-group row">
						<div class="col s12"><p style="font-weight: 500;">Club Categories</p></div>
						<div class="col s4">
					    <p style="font-weight: 500;">STEM</p>
			        <input type="checkbox" name="categories[]" value="science" id="science" class="filled-in">
							<label for="science">Science</label><br>
			        <input type="checkbox" name="categories[]" value="technology" id="technology" class="filled-in">
							<label for="technology">Technology</label><br>
			        <input type="checkbox" name="categories[]" value="engineering" id="engineering" class="filled-in">
							<label for="engineering">Engineering</label><br>
			        <input type="checkbox" name="categories[]" value="math" id="math" class="filled-in">
							<label for="math">Math</label><br>
						</div>
						<div class="col s4">
					    <p style="font-weight: 500;">Humanities</p>
			        <input type="checkbox" name="categories[]" value="history" id="history" class="filled-in">
							<label for="history">History</label><br>
			        <input type="checkbox" name="categories[]" value="reading" id="reading" class="filled-in">
							<label for="reading">Reading</label><br>
			        <input type="checkbox" name="categories[]" value="writing" id="writing" class="filled-in">
							<label for="writing">Writing</label><br>
			        <input type="checkbox" name="categories[]" value="debate" id="debate" class="filled-in">
							<label for="debate">Debate</label><br>
						</div>
						<div class="col s4">
					    <p style="font-weight: 500;">Arts</p>
			        <input type="checkbox" name="categories[]" value="drama" id="drama" class="filled-in">
							<label for="drama">Drama</label><br>
			        <input type="checkbox" name="categories[]" value="music" id="music" class="filled-in">
							<label for="music">Music</label><br>
			        <input type="checkbox" name="categories[]" value="visual-arts" id="visual-arts" class="filled-in">
							<label for="visual-arts">Visual Arts</label>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input id="club_leaders" name="club_leaders" placeholder="Club Leaders (Emails Separated by Commas)" type="text">
					<label for="club_leaders">Club Leaders</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input id="club_building" name="club_building" placeholder="Club building code" type="text" required>
					<label id="club_building">Club Building</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field col s12">
					<input type="checkbox" name="club_private" id="club_private" class="filled-in" value="0">
					<label for="club_private">Private Club</label><br>
				</div>
			</div>

				<input type="hidden" name="course_id" id="course_id">
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="modal-action waves-effect btn-flat white-text" style='margin-left:5px; background-color: <?php echo getSiteColor(); ?>'>Save</button>
			<a class="modal-close waves-effect btn-flat white-text"  style='background-color: <?php echo getSiteColor(); ?>'>Cancel</a>
	</div>
	</form>
</div>

<script>

$(function()
{

	$('select').material_select();

	//Add/Edit a Course
	$('#form-addclub').submit(function(event){
		event.preventDefault();

		var form = $('#form-addclub');
		var formMessages = $('#form-messages');

		$('#addclub').closeModal({
			in_duration: 0,
			out_duration: 0,
		});
		var formData = $(form).serialize();
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		})

		//Show the notification
		.done(function(response) {

			$("#content_holder").load( "modules/<?php echo basename(__DIR__); ?>/clubs_display.php", function(){

				mdlregister();

				var notification = document.querySelector('.mdl-js-snackbar');
				var data = { message: response };
				notification.MaterialSnackbar.showSnackbar(data);

			});

		})
	});




	var wrapper         = $(".leader_emails");
	var add_button      = $(".add_email");

	var x = 1;
	$(add_button).click(function(e){
		e.preventDefault();
		x++;
		$(wrapper).append('<div class="row"><div class="col s10"><input type="text" id="leader_' + x + '" name="leader_' + x + '></div><div class="col s1"><i class="material-icons remove_email">remove_circle</i></div><div class="col s1"><i class="material-icons add_email">add_circle</i></div></div>'); //add input box
	});
	$(wrapper).on("click",".remove_email", function(e){
		e.preventDefault(); $(this).parent('div').parent('div').remove();
  })
});
</script>
