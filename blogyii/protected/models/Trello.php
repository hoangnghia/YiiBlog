<?php 
	namespace app\models;

	use Yii;

	require_once('/../vendors/APITrello/vendor/autoload.php');
	use Trello\Client;



	class Trello 
	{
		 public static function TrelloAPI($token)
		 {
 			
				$client = new Trello\Client();
				$client->authenticate('658f0e49767a334eb04b65d1c43167b4', $token, Client::AUTH_URL_CLIENT_ID);

				// Get list boards
				$boards = $client->api('member')->boards()->all("me", array());
			
			
			$boardNUM = 0;
			$boardID = "";
			$listID = "";		
			foreach ($boards as $board) {
				$boardID = $board['id'];
				echo $boardNUM++ . "/ " ."<a style='background-color: red;'>--------Board name</a>: " .$board['name'] ."<br/>" ."  - Board ID: ". $boardID;
				echo "<br/>";
				echo "------------------------";
				echo "<br/>";
				// Get list of boards
				echo "List of boards";
				echo "<br/>";
				$lists = $client->api('boards')->lists()->all("$boardID", array());
				foreach ($lists as  $list) {
					$listID = $list['id'];

					echo "+" . "<a style='background-color: green;'> List name: </a>".  $list['name'] . "<br/>". "List ID: ".$list['id'] ;				
					echo "<br/>";
					$cards = $client->api('lists')->cards()->all("$listID", array());
					foreach ($cards as $card) {
						echo "+" . "<a style='background-color: blue;'> Card name: </a>".  $card['name'] . "<br/>";
						echo "Deadline: ".$card['due'] . "<br/>";				
						echo "Description: ".$card['desc'] . "<br/>";				
					}
					
				}

			}
		 }
	}
 ?>