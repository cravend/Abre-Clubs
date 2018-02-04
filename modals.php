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
?>

<div id="clubmodal" class="modal modal-fixed-footer modal-mobile-full">
	<div class="modal-content">
		<h4>Create a new group</h4>
		<a class="modal-close black-text" style='position:absolute; right:20px; top:25px;'><i class='material-icons'>clear</i></a>
		<div class="row center-align">
			<p id="infoHolder" style=""></p>
		</div>

		<form class="" id="form-club" method="post" action="">
			<!-- <div class='row'>
				<div class="col l4 s12" style='padding-left:5px;'>
					<span style='margin-right:50px;'><input name="duration" type="radio" id="personal" value="1" required /><label for="personal">Permanent (Club)</label></span>
					<span><input name="duration" type="radio" id="office" value="2" /><label for="office">Temporary (Class Project)</label></span>
				</div>
			</div> -->
			<div class='row'>
				<div class='col s12'>
					<b>What type of group do you want to create? </b>
				</div>
				<br><br>
				<div class="col l4 s12" style='padding-left:5px;'>
					<span style='margin-right:50px;'><input name="Duration" type="radio" id="long" value="1" required /><label for="long">Long-term (Club)</label></span>
					<span><input name="Duration" type="radio" id="short" value="2" /><label for="short">Short-term (Project)</label></span>
				</div>
				<div>
					<select class='col l3 s6' id='selectValue' name='selectValue'>
						<option value='1'>Long-term (Club)</option>
						<option value='2'>Short-term (Project)</option>
					</select>
				</div>
			</div>

			<div class='row'>
				<div class='col s12'>
					<b>Faculty Administrator Email</b>
				</div>
				<div class="col l4 s12" style='padding-left:5px;'>
					<div class="input-field">
						<input id="admin-email" name="admin-email" type="text" maxlength="40" placeholder="teacher@masonohioschools.com" autocomplete="off" required>
					</div>
				</div>
			</div>

			<div class='row'>
				<div class='col s12'>
				</div>
				<b>Student Leader Email</b>
				<div class='row'>
					<div class="col l4 s12" style='padding-left:5px;'>
						<div class="input-field">
							<input id="stu-email" name="stu-email" type="text" maxlength="40" placeholder="student@masonohioschools.com" autocomplete="off" required>
						</div>
					</div>
				</div>

				<!-- permissions -->
				<div class='row'>
					<div class='col s12'>
						<b>Who can access this group?</b>
					</div>
					<br><br>
					<div class="col l4 s12" style='padding-left:5px;'>
						<span><input name="Permissions" type="radio" id="public" value="1" required /><label for="public">Public Access</label></span>
						<span><input name="Permissions" type="radio" id="invite" value="2" /><label for="invite">Invite Only</label></span>
						<span><input name="Permissions" type="radio" id="closed" value="3" /><label for="closed">Closed (teacher invite only)</label></span>
					</div>
					<div>
						<select class='col l3 s6' id='selectValue' name='selectValue'>
							<option value='1'>Public Access</option>
							<option value='2'>Invite Only</option>
							<option value='3'>Closed (teacher invite only)</option>
						</select>
					</div>
				</div>

				<!-- <button type="submit" class="modal-action waves-effect btn-flat white-text" style='background-color: <?php echo getSiteColor() ?>;'>Submit</button> -->
			</form>
		</div>
		<!-- </div> -->
</div>
		<div class="modal-footer">
			<div id ="footerButtonsDiv" style='display: inline-block; float:right'>
				<button type="submit" class="modal-action waves-effect btn white-text" style='margin-left:5px; background-color: <?php echo getSiteColor(); ?>'>Done</button>
				<a class="modal-close waves-effect btn-flat white-text" style=' background-color: <?php echo getSiteColor(); ?>'>Cancel</a>
			</div>
		</div>
</div>
