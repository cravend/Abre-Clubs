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
<div id="clubmodal" class="modal modal-fixed-footer modal-mobile-full">
	<form class="col s12" id="form-club" method="post" action="">
		<div class="modal-content" style="padding: 0px !important">
			<!-- header -->
			<div class="row" style='background-color: <?php echo getSiteColor(); ?>; padding: 24px;'>
				<div class='col s11'>
					<span class="truncate" style="color: #fff; font-weight: 500; font-size: 24px; line-height: 26px;">Create a new club</span>
				</div>
				<div class='col s1 right-align'>
					<a class="modal-close"><i class='material-icons' style='color: #fff;'>clear</i></a>
				</div>
			</div>


			<div class='row' style='padding: 0px 24px 0px 24px;'>
				<div class='col s12'>
					<h5>Student leaders</h5><br>
				</div>
				<?php
				for ($x = 0; $x <= 3; $x++)
				{
					$studentnumber=$x+1;
					if ($studentnumber == 1){
						echo "<div class='row'>";
						echo "<div class='input-field col s6'>";
						echo "<input id='student_name_$x' name='student_name_$x' type='text' placeholder='Required' autocomplete='off' required>";
						echo "<label class='active' for='student_name_$x'>Student $studentnumber Name</label>";
						echo "</div>";
						echo "<div class='input-field col s6'>";
						echo "<input id='student_email_$x' name='student_email_$x' type='email' placeholder='Required' autocomplete='off' required>";
						echo "<label class='active' for='student_email_$x'>Student $studentnumber Email</label>";
						echo "</div>";
						echo "</div>";
					}else{
						echo "<div class='row'>";
						echo "<div class='input-field col s6'>";
						echo "<input id='student_name_$x' name='student_name_$x' type='text' placeholder='Optional' autocomplete='off'>";
						echo "<label class='active' for='student_name_$x'>Student $studentnumber Name</label>";
						echo "</div>";
						echo "<div class='input-field col s6'>";
						echo "<input id='student_email_$x' name='student_email_$x' type='email' placeholder='Optional' autocomplete='off'>";
						echo "<label class='active' for='student_email_$x'>Student $studentnumber Email</label>";
						echo "</div>";
						echo "</div>";
					}
				}
				?>
				<!-- select privacy -->
				<div class= 'row'>
					<div class="input-field col s12 " display="block" >
						<h5>Privacy</h5>
						<div class='row'>
							<select id='selectPrivacy' name='selectPrivacy' style="display: block !important;">
								<option value='' disabled selected>Choose a setting</option>
								<option value='public'>Public</option>
								<option value='private'>Private</option>
							</select>
						</div>
					</div>
				</div>
				<!-- select category -->
				<div class= 'row'>
					<div class="col s12" >
						<h5>Category</h5>
					</div>
					<div class='row'>
						<div class="input-field col s12">
							<select id="selectCategory" name="selectCategory" style="display: block !important;">
								<option value="" disabled selected>Choose a category</option>
								<optgroup label="STEM">
									<option value="science">Science</option>
									<option value="technology">Technology</option>
									<option value="engineering">Engineering</option>
									<option value="math">Math</option>
								</optgroup>
								<optgroup label="Humanities">
									<option value="history">History</option>
									<option value="reading">Reading</option>
									<option value="writing">Writing</option>
									<option value="debate">Debate</option>
								</optgroup>
								<optgroup label="Arts">
									<option value="drama">Drama</option>
									<option value="music">Music</option>
									<option value="visualArts">Visual Arts</option>
								</optgroup>
							</select>
						</div>
					</div>
				</div>


				<div class= 'row'>
					<div class="input-field col s12 " display="block" >
						<h5>Description</h5>
						<div class='row'>
			          <textarea id="textDescription" class="textarea"></textarea>
			        </div>
						</div>
					</div>

			</div>
		</div>

		<div class="modal-footer">
			<button type="submit" class="modal-action waves-effect btn-flat white-text submitbutton" style='margin-left:5px; background-color: <?php echo getSiteColor(); ?>'>Submit Application</button>
			<a class="modal-close waves-effect btn-flat white-text cancelbutton"  style='background-color: <?php echo getSiteColor(); ?>'>Cancel</a>
		</div>

	</form>
</div>
