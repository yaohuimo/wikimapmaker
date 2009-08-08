<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en' dir='ltr'>
<head>
	<title>MapMaker</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel='stylesheet' href='/resources/styles/main.css' type='text/css' media='screen' />

	<?php

	echo "<script type='text/javascript' src='/resources/js/jquery-1.3.2.js'></script>";
	
        if ( $isMap ) {
                echo "<script type='text/javascript' src='/resources/js/proj4js/lib/proj4js.js'></script>";
                echo "<script type='text/javascript' src='/resources/js/proj4js/lib/projCode/merc.js'></script>";
                echo "<script type='text/javascript' src='/resources/js/openlayers/lib/OpenLayers.js'></script>";

                if ( isset( $scriptName ) ) {
                        if ( is_array( $scriptName ) ) {
                                foreach ( $scriptName as $script ) {
                                        echo "<script type='text/javascript' src='/resources/js/";
                                        echo $script;
                                        echo ".js'></script>";
                                }
                        } else {
                                echo "<script type='text/javascript' src='/resources/js/";
                                echo $scriptName;
                                echo ".js'></script>";
                        }
                }

	       echo "<script type='text/javascript'>
		$(document).ready( function() {
			$('#Boundaries').bind('click', function() {
                                $('#ajaxmsg').load( '/make/setbaselayer/boundaries' );
                                map.setBaseLayer( boundaries );
                        });
	                $('#OpenStreetMap').bind('click', function() {
				$('#ajaxmsg').load( '/make/setbaselayer/osm' );
				map.setBaseLayer( boundaries );
			});
			$('#BlueMarble').bind('click', function() {
				$('#ajaxmsg').load( '/make/setbaselayer/bluemarble' );
				map.setBaseLayer( bluemarble );
				bluemarble.setVisibility( true );
			});
			$('#map').bind('mouseenter', function() {
				map.addControl( new OpenLayers.Control.MousePosition( { 'id': 'mpControl' } ) );
			});
			$('#map').bind('mouseleave', function() {			
				map.removeControl( map.getControl( 'mpControl' ) );
			});
                });

                </script>";

        }
        ?>

        <?php
                if ( $isMap ) {
                        echo '<link rel="stylesheet" href="/resources/styles/map.css" type="text/css" media="screen" />';
                }
        ?>
</head>
<body <?php if ( $isMap ) { echo 'onload="init()"'; } ?>>

<div id='page'>
	<div id='header'>
		<h1><a href="/">Wiki MapMaker</a></h1>
	</div>

        <div id='menu'>
                <ul id='menulist'>
                        <li class='menuitem' id='finddata'><a href='http://maps.dcmapguide.com/find'>Find&nbsp;data</a></li>
                        <li class='menuitem' id='makemap'><a href='http://maps.dcmapguide.com/make'>Make&nbsp;a&nbsp;map</a></li>
                </ul>
        </div>

	<div id='ajaxmsg'></div>

	<div id='content'>


