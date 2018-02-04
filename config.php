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

	//Check for installation
	if(superadmin()){ require('installer.php'); }

	$pageview=1;
	$drawerhidden=1;
	$pageorder=10;
	$pagetitle="Clubs";
	$description="Organize various groups and clubs.";
	$version="0.1.0";
	$repo="cravend/Abre-Clubs";
	$pageicon="basketball";
	$pagepath="clubs";
	require_once('permissions.php');
?>
