<?php
	
	//include DB conn.
	include_once './conn.php';

	//Get players from the xml file and put in variable 
	$doc = new DOMDocument();
    $doc->load( 'deathmatch.xml' );
    $items = $doc->getElementsByTagName( "player" );

	//Display the data from the array we made before

	//Set Counters players and counter
	$counter = 0;
	$player_counter = 1;
	$db_counter = 1;
	$db_timer = 6;
	
	//make sure these arrays are emty and set
	$users=array();
	$players=array();
	$db_users=array();
	$db_players=array();

	
	//SQL
	
		
	//Get players from db and put in array
	$result = mysqli_query($con,"SELECT * FROM players");

	while($row = mysqli_fetch_array($result)) {
		array_push($db_users, $row['name'], $row['score'], $row['ping'], $row['counter'], $row['timer']);
		$db_players = (array_chunk($db_users, 5,0));
		
	}
	//inset player in database
	 
	
	
	//Do a foreach item we found in the xml file
		foreach( $items as $item )
    {
		$names = $item->getElementsByTagName( "name" );
        $name = $names->item(0)->nodeValue;
		

        $scores = $item->getElementsByTagName( "score" );
        $score = $scores->item(0)->nodeValue;

		$pings = $item->getElementsByTagName( "ping" );
        $ping = $pings->item(0)->nodeValue;
		$count++;

		//push name and score to array and chunk it to new array players 0 = name, 1 = Score, 2 = Ping, 3 = counter, 4 = timer in seconds.
		array_push($users, $name, $score, $ping);
		$players = (array_chunk($users, 3,0));
		
		//Here code that will add player info to the database
		
		$p_name = mysql_real_escape_string($players[($counter)][0]);
		$p_score = mysql_real_escape_string($players[($counter)][1]);
		$p_ping = ($players[($counter)][2]);
		
		
		if (in_array(stripslashes($p_name), $db_users))
		  {
		echo "Player is found in the DB and server. lets UPDATE<br>";
		echo 'NAME : ' . $p_name .'<br>';
		echo 'SCORE : ' . $p_score .'<br>';
		echo 'PING : ' . $p_ping .'<br>';
			//SQL Update players
			$sql_update="UPDATE players SET score=score + $p_score, ping='$p_ping' , counter=counter + $db_counter, timer=timer + $db_timer
			WHERE name='$p_name'";
			if (!mysqli_query($con,$sql_update))
			  {
			die('Error: ' . mysqli_error($con));
			  }
		  }
		else
		  {
		echo "Player" . $p_name . " was NOT found in DB . We add it !<br>";
			//SQL insert into players
			$sql_insert="INSERT INTO players (name, score, ping)
			VALUES ('$p_name', '$p_score', '$p_ping')";
			if (!mysqli_query($con,$sql_insert))
			  {
			die('Error: ' . mysqli_error($con));
			  }
		  }
		echo '<br>';
		echo '------------------------------------------------------------------<br>';
		echo '<br>';
		
		//add 1 to each counter.
		$counter++;
		$player_counter++;
    }

	
	
	//clean way to print arrays to check them out.
	print "<pre>";
	print_r($db_players);
	print "</pre>";
	echo '<br>';


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

