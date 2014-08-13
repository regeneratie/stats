<?php

	//Get players from the xml file and put in variable 
	$doc = new DOMDocument();
    $doc->load( 'deathmatch.xml' );
    $items = $doc->getElementsByTagName( "player" );


	$count = 0;

	foreach( $items as $item )
    {
        $names = $item->getElementsByTagName( "name" );
        $name = $names->item(0)->nodeValue;

        $scores = $item->getElementsByTagName( "score" );
        $score = $scores->item(0)->nodeValue;

		$pings = $item->getElementsByTagName( "ping" );
        $ping = $pings->item(0)->nodeValue;
	$count++;
	//new code
	$player = $name;

		echo 'ID_NAME ' . $player . '<br>';
		echo 'Name : ' . $name . '<br>Score : ' . $score . '<br>Pings : ' . $ping .  "<br><br>";
    }




	echo $count . '<br><br>';




	//Get hostname, ip, and map from xml file
	$items = $doc->getElementsByTagName( "server" );

	    foreach( $items as $item )
    {

		$hostnames = $item->getElementsByTagName( "hostname" );
        $hostname = $hostnames->item(0)->nodeValue;

		$names = $item->getElementsByTagName( "name" );
        $name = $names->item(0)->nodeValue;

		$maps = $item->getElementsByTagName( "map" );
        $map = $maps->item(0)->nodeValue;
		echo 'Name : ' . $name . '<br>IP : ' . $hostname . '<br>Map : ' . $map . '' ;
    }


?>

