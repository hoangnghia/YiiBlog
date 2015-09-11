<?php 
	use Trello\Client;
	$client = new Client();
	$client->authenticate('658f0e49767a334eb04b65d1c43167b4', '77e308573b49ba9e498e4371df88402fc8e33a08ded0eaed9b9e41b893155a1e', Client::AUTH_URL_CLIENT_ID);

	$boards = $client->api('member')->boards()->all();

	print_r($boards);
 ?>
