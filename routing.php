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

  if($_SESSION['usertype'] == "staff")
  {
		echo "
		    'clubs': function(name) {
			    $( '#navigation_top' ).hide();
			    $( '#content_holder' ).hide();
			    $( '#loader' ).show();
			    $( '#titletext' ).text('Clubs');
			    document.title = 'Clubs';
					$( '#content_holder' ).load( 'modules/".basename(__DIR__)."/clubs.php', function() { init_page(); });
					$( '#modal_holder' ).load( 'modules/".basename(__DIR__)."/modals.php' );
					ga('set', 'page', '/#clubs/');
					ga('send', 'pageview');";

					if(CONSTANT('SITE_MODE') != "DEMO"){
						echo "$( '#navigation_top' ).show();
						$( '#navigation_top' ).load( 'modules/".basename(__DIR__)."/menu.php', function() {
							$( '#navigation_top' ).show();
							$('.tab_1').addClass('tabmenuover');
						});";
					}
		    echo "},
		    'clubs/directory': function(name) {
			    $( '#navigation_top' ).hide();
			    $( '#content_holder' ).hide();
			    $( '#loader' ).show();
			    $( '#titletext' ).text('Clubs');
			    document.title = 'Clubs';
					$( '#content_holder' ).load( 'modules/".basename(__DIR__)."/clubs_directory.php', function() { init_page(); });
					$( '#modal_holder' ).load( 'modules/".basename(__DIR__)."/modals.php' );
					ga('set', 'page', '/#clubs/directory/');
					ga('send', 'pageview');

					$( '#navigation_top' ).show();
					$( '#navigation_top' ).load( 'modules/".basename(__DIR__)."/menu.php', function() {
						$( '#navigation_top' ).show();
						$('.tab_2').addClass('tabmenuover');
					});
		    },
		    'clubs/?:clubid': function(clubid, name) {
			    $( '#navigation_top' ).hide();
			    $( '#content_holder' ).hide();
			    $( '#loader' ).show();
			    $( '#titletext' ).text('Club Information');
			    document.title = 'Club Information';
					$( '#content_holder' ).load( 'modules/".basename(__DIR__)."/club_info.php?clubid='+clubid, function() {
						init_page();
						back_button('#clubs');
					});

					ga('set', 'page', '/#clubs/course/');
					ga('send', 'pageview');

					$( '#modal_holder' ).load( 'modules/".basename(__DIR__)."/modals.php' );
		    },";
	}

?>
