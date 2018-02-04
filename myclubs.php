<?php

/*
* Copyright (C) 2016-2017 Abre.io LLC
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the Affero General Public License version 3
* as published by the Free Software Foundation.
*Empire Strikes Back!kjbjkjbjkjkb
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU Affero General Public License for more details.
*all hail the hypnotoad!
* this is a testing comment
* You should have received a copy of the Affero General Public License
* version 3 along with this program.  If not, see https://www.gnu.org/licenses/agpl-3.0.en.html.
*/

//Required configuration files
require_once(dirname(__FILE__) . '/../../core/abre_verification.php');
require(dirname(__FILE__) . '/../../core/abre_dbconnect.php');
require_once(dirname(__FILE__) . '/../../core/abre_functions.php');

?>

<div class='page_container mdl-shadow--4dp'>
	<div class='page'>
		<div class='row'>
			<h3>Your Clubs</h3>
			<!--temp club 1-->
			<div class='mdl-card mdl-shadow--2dp card_stream hoverable' style='float:left;'>
				<h4 class='center-align'>Coding Club</h4>
				<h6 class='left-align' style='padding-left: 56px'>One code, two codes!</h6>
				<div class="mdl-card__media mdl-color--grey-100 mdl-card--expand valign-wrapper cardclick pointer" style="height:200px; background-image: url(/core/images/abre_pattern.png); background-color: <?php echo getSiteColor() ?> !important; overflow:hidden;"></div>
				<div class='mdl-card__actions'>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>View</a>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>Options</a>
				</div>
			</div>
			<!--temp club 2-->
			<div class='mdl-card mdl-shadow--2dp card_stream hoverable' style='float:left;'>
				<h4 class='center-align'>Club Name</h4>
				<h6 class='left-align' style='padding-left: 56px'>Club description text</h6>
				<div class="mdl-card__media mdl-color--grey-100 mdl-card--expand valign-wrapper cardclick pointer" style="height:200px; background-image: url(/core/images/abre_pattern.png); background-color: <?php echo getSiteColor() ?> !important; overflow:hidden;"></div>
				<div class='mdl-card__actions'>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>View</a>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>Options</a>
				</div>
			</div>
			<!--temp club 3-->
			<div class='mdl-card mdl-shadow--2dp card_stream hoverable' style='float:left;'>
				<h4 class='center-align'>Club Name</h4>
				<h6 class='left-align' style='padding-left: 56px'>Club description text</h6>
				<div class="mdl-card__media mdl-color--grey-100 mdl-card--expand valign-wrapper cardclick pointer" style="height:200px; background-image: url(/core/images/abre_pattern.png); background-color: <?php echo getSiteColor() ?> !important; overflow:hidden;"></div>
				<div class='mdl-card__actions'>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>View</a>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>Options</a>
				</div>
			</div>
			<!--temp club 4-->
			<div class='mdl-card mdl-shadow--2dp card_stream hoverable' style='float:left;'>
				<h4 class='center-align'>Club Name</h4>
				<h6 class='left-align' style='padding-left: 56px'>Club description text</h6>
				<div class="mdl-card__media mdl-color--grey-100 mdl-card--expand valign-wrapper cardclick pointer" style="height:200px; background-image: url(/core/images/abre_pattern.png); background-color: <?php echo getSiteColor() ?> !important; overflow:hidden;"></div>
				<div class='mdl-card__actions'>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>View</a>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>Options</a>
				</div>
			</div>
		</div>
		<div class='row'>
			<h3>Invited Clubs</h3>
			<!--temp club 2_1-->
			<div class='mdl-card mdl-shadow--2dp card_stream hoverable' style='float:left;'>
				<h4 class='center-align'>Club Name</h4>
				<h6 class='left-align' style='padding-left: 56px'>Club description text</h6>
				<div class="mdl-card__media mdl-color--grey-100 mdl-card--expand valign-wrapper cardclick pointer" style="height:200px; background-image: url(/core/images/abre_pattern.png); background-color: <?php echo getSiteColor() ?> !important; overflow:hidden;"></div>
				<div class='mdl-card__actions'>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>View</a>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>Options</a>
					<h6 class='right-align' style='padding-right: 56px'>Invited by Username</h6>
				</div>
			</div>
		</div>
		<div class='row'>
			<h3>Recommended Clubs</h3>
			<div class='mdl-card mdl-shadow--2dp card_stream hoverable' style='float:left;'>
				<h4 class='center-align'>Club Name</h4>
				<h6 class='left-align' style='padding-left: 56px'>Club description text</h6>
				<div class="mdl-card__media mdl-color--grey-100 mdl-card--expand valign-wrapper cardclick pointer" style="height:200px; background-image: url(/core/images/abre_pattern.png); background-color: <?php echo getSiteColor() ?> !important; overflow:hidden;"></div>
				<div class='mdl-card__actions'>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>View</a>
					<a class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' href='#' style='color:<?php echo getSiteColor() ?>;'>Options</a>
					<h6 class='right-align' style='padding-right: 56px'></h6>
				</div>
			</div>
		</div>
	</div>
</div>


<div class='fixed-action-btn buttonpin'>
	<a class='modal-newclub btn-floating btn-large waves-effect waves-light' style='background-color: <?php echo getSiteColor(); ?>' href='#clubmodal'><i class='large material-icons'>add</i></a>
	<div class="mdl-tooltip mdl-tooltip--left" for="createcourse">New Club</div>
</div>

<script src="/modules/Abre-Clubs/button_club.js"></script>
