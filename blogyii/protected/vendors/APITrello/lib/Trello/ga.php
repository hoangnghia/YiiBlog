<?php 
	//namespace Trello;
	
	
	
	// require "HttpClient/HttpClientInterface.php";
	// require "HttpClient/HttpClient.php";
	// require "Client.php";

// 	
	require '../../vendor/autoload.php';
	
	// use \Trello\HttpClient\HttpClientInterface;
	// use \Trello\HttpClient\HttpClient;
	use Trello\Client;
	
	
	$client = new Client();
	//$client->authenticate('658f0e49767a334eb04b65d1c43167b4', '77e308573b49ba9e498e4371df88402fc8e33a08ded0eaed9b9e41b893155a1e', Client::AUTH_URL_CLIENT_ID);
	$client->authenticate('658f0e49767a334eb04b65d1c43167b4', 'da5d95a64591f6e44948221dce3c611e1fd993ea4902f3ef997f6a6e8ddcd762', Client::AUTH_URL_CLIENT_ID);
// 
	$boards = $client->api('member')->boards()->all("me", array());
// 
	//print_r($boards);
	$board_id = "";
	foreach ($boards as $board) {
		//print_r($board);
		//Voi moi board:
		$board_id = $board["id"];
		echo "name->". $board["name"] .", id->$board_id";
		echo "<br/ >";
		
	}
	
	
	
	$board_id = "55dac641076bcf0fc17be2f9";
	
	//list card cua cua board:
	echo "<br /> lists board $board_id la: <br />";
	$lists = $client->api('board')->lists()->all($board_id, array());
	//print_r($lists);
	
	foreach ($lists as $list) {
		//print_r($list);
		//Voi moi $list:
		$list_id = $list["id"];
		echo "name->". $list["name"] .", id->$list_id";
		echo "<br/ >";
		
	}
	
	
	//Card cua 1 list:
	$list_id = "55dac7af9b72089bfafd1a1b";
	
	//list card cua cua board:
	echo "<br /> lists card cua list $list_id la: <br />";
	$cards = $client->api('list')->cards()->all($list_id, array());
	// print_r($cards);
	// exit;
		foreach ($cards as $card) {
		//print_r($card);
		//Voi moi $card:
		$card_id = $card["id"];
		echo "name->". $card["name"] .", id->$card_id";
		echo "<br/ >";
		echo "dudata->". $card["due"] .", id->$card_id";
		echo "<br/ >";
		
		// $idmembers = $card["idMembers"];
		// foreach ($idmembers as $idmember) {
			// echo "id member->". $idmember["idMembers"] .", id->$card_id";
		    // echo "<br/ >";
		// }
		// echo "idmember->". $card["idMembers"] .", id->$card_id";
		// echo "<br/ >";
	}
	
 ?>