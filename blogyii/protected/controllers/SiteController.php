<?php
// Yii::import('application.vendors.*');
//Yii::setPathOfAlias('Predis', '/vendors/trelloAPI/lib/Trello/Client.php');
// var_dump(file_exists("protected/controllers/PostController.php"));
// var_dump(file_exists("../vendors/trelloAPI/lib/Trello/Client.php"));
// var_dump(dirname(__FIlE__));
// exit();
// require_once('trelloAPI/lib/Trello/Client.php');
require_once('/../vendors/APITrello/vendor/autoload.php');
use Trello\Client;
use Trello\Manager;


class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$model = Post::Get_All_Post();		
		$this->render('index', array('model'=>$model));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionViewpost()
	{
		$post = new Post();
		if(isset($_GET['id']))
		{
			$post_ID = $_GET['id'];
			$post = Post::Get_Detail_Post($post_ID);			
		}
		 $this->render('viewpost', array('model'=> $post));
	}
	public function actionSearch()
	{
		$model = new Post();
		if(isset($_GET['key']))
		{
			$key= $_GET['key'];
			$model = Post::Search_Blogs($key);
		}
		return  $this->render('search', array('model'=> $model));
	}
	public function actionTrello()
	{
		$session = Yii::app()->session;
		$boards = array();
		if(isset($session['token']))
		{		

			 $this->redirect('getboard');				
		}
		
		
		// $boardNUM = 0;
		// $boardID = "";
		// $listID = "";		
		// foreach ($boards as $board) {
		// 	$boardID = $board['id'];
		// 	echo $boardNUM++ . "/ " ."<a style='background-color: red;'>--------Board name</a>: " .$board['name'] ."<br/>" ."  - Board ID: ". $boardID;
		// 	echo "<br/>";
		// 	echo "------------------------";
		// 	echo "<br/>";
		// 	// Get list of boards
		// 	echo "List of boards";
		// 	echo "<br/>";
		// 	$lists = $client->api('boards')->lists()->all("$boardID", array());
		// 	foreach ($lists as  $list) {
		// 		$listID = $list['id'];

		// 		echo "+" . "<a style='background-color: green;'> List name: </a>".  $list['name'] . "<br/>". "List ID: ".$list['id'] ;				
		// 		echo "<br/>";
		// 		$cards = $client->api('lists')->cards()->all("$listID", array());
		// 		foreach ($cards as $card) {
		// 			echo "+" . "<a style='background-color: blue;'> Card name: </a>".  $card['name'] . "<br/>";
		// 			echo "Deadline: ".$card['due'] . "<br/>";				
		// 			echo "Description: ".$card['desc'] . "<br/>";				
		// 		}
				
		// 	}

		// }

		return $this->render('trello');		
	}
	public function actionToken($token)
	{		
		Yii::app()->session['token'] = $token;

		// $client = new Trello\Client();
		// $client->authenticate('658f0e49767a334eb04b65d1c43167b4', $token , Client::AUTH_URL_CLIENT_ID);

		// // Get list boards
		// $boards = $client->api('member')->boards()->all("me", array());
		$arr = array();
		$arr = ["name"=> "abc"];
		return json_encode($arr);

	}
	protected function renderJSON($data) {
        header('Content-type: application/json');
        echo json_encode($data);
        Yii::app()->end();
    }
    public function actionBoards()
    {
    	return $this->render('boards');
    }
    public function actionLogouttrello()
    {
    	unset(Yii::app()->session['token']);
    	return $this->render('trello');
    }
    public function actionGetboard()
    {
    	$session = Yii::app()->session;
		$boards = array();
		if(isset($session['token']))
		{

			$token = $session['token'];
			$client = new Trello\Client();
			$client->authenticate('658f0e49767a334eb04b65d1c43167b4', $token, Client::AUTH_URL_CLIENT_ID);							
			$boardID = "";
			$listID = "";	
			$boards = $client->api('member')->boards()->all("me", array());	
			foreach ($boards as $board)
			{

				// Insert board to DB
				$boardID = $board['id'];			
				$board_name = $board['name'];
				$user_id = "658f0e49767a334eb04b65d1c43167b4";
				
				
				Boards::insertBoard($boardID, $board_name, $user_id);


				$lists = $client->api('boards')->lists()->all("$boardID", array());
				foreach ($lists as  $list) 
				{
					// Insert list to DB
					$listID = $list['id'];
					$name = $list['name'];
					Lists::insertList($listID, $name, $boardID);

					$cards = $client->api('lists')->cards()->all("$listID", array());
					foreach ($cards as $card) 
					{
						// Insert card to DB	
						$card_id = $card['id'];
						$card_name = $card['name'];
						$card_des = $card['desc'];
						$card_due = $card['due'];
						Cards::insertCard($card_id, $card_name, $card_des, $card_due, $listID)	;
					}
				}
				
			}


			// // Get list boards
			// $boards = $client->api('member')->boards()->all("me", array());		
		}

    	return $this->render("getboard", array('boards'=>$boards));

    }
      public function actionGetlistboard()
    {
    	$session = Yii::app()->session;
		$lists = array();
		if(isset($_GET['boardID']))
		{
			$boardID = $_GET['boardID'];
			if(isset($session['token']))
			{
				$token = $session['token'];
				$client = new Trello\Client();
				$client->authenticate('658f0e49767a334eb04b65d1c43167b4', $token, Client::AUTH_URL_CLIENT_ID);

				// Get list boards
				$lists = $client->api('boards')->lists()->all("$boardID", array());	

			}
		}
		
		
    	return $this->render("getlistboard", array('lists'=>$lists));

    }
        public function actionGetcardlist()
    {
    	$session = Yii::app()->session;
		$cards = array();
		if(isset($_GET['listID']))
		{
			$listID = $_GET['listID'];
			if(isset($session['token']))
			{
				$token = $session['token'];
				$client = new Trello\Client();
				$client->authenticate('658f0e49767a334eb04b65d1c43167b4', $token, Client::AUTH_URL_CLIENT_ID);

				// Get list boards
				$cards = $client->api('lists')->cards()->all("$listID", array());
				
			}
		}
		
		
    	return $this->render("getcardlist", array('cards'=>$cards));

    }
    public function actionCreatecard()
    {
    	
		$session = Yii::app()->session;
		if(isset($_POST['cardname']) && $_POST['description']  && $_POST['idList'] && $_POST['due'])
		{
			$card_name =  $_POST['cardname'];
			$des = $_POST['description'];
			$due = $_POST['due'];
			$idList = $_POST['idList'];

			$arr = array("desc"=>$des, "due"=> $due);

			if(isset($session['token']))
			{

				$token = $session['token'];
				$client = new Trello\Client();
				$client->authenticate('658f0e49767a334eb04b65d1c43167b4', $token, Client::AUTH_URL_CLIENT_ID);

				// Create Card
				$cards = $client->api('lists')->cards()->create($idList, $card_name, $arr);

				return $this->redirect('getcardlist?listID='.$idList);
				
			}
			else
			{
				echo "ko tim thay token";
				exit();
			}
			
		}
    	return $this->render('createcard');
    }
    public function actionAddcomment($idCard, $comment)
    {
    	$session = Yii::app()->session;
    	if(isset($session['token']))
			{

				$token = $session['token'];
				$client = new Trello\Client();
				$client->authenticate('658f0e49767a334eb04b65d1c43167b4', $token, Client::AUTH_URL_CLIENT_ID);

				// add Comment
				
				if($client->api('cards')->actions()->addComment($idCard, $comment))
				{
					echo "Comment success";
				}
				else{
					echo "Comment error";
				}

				
			}
			else
			{
				echo "Có lỗi xảy ra";
				exit();
			}
    }
    public function actionUpdatecard()
    {
    	$session = Yii::app()->session;
    	
		if(isset($_POST['cardname']) && $_POST['description']  && $_POST['idCard'] && $_POST['due'] && $_POST['idList'])
		{
			$card_name =  $_POST['cardname'];
			$des = $_POST['description'];
			$due = $_POST['due'];
			$idList = $_POST['idList'];
			$idCard = $_POST['idCard'];

			$arr = array("name"=>$card_name,"desc"=>$des, "due"=> $due);

			if(isset($session['token']))
			{

				$token = $session['token'];
				$client = new Trello\Client();
				$client->authenticate('658f0e49767a334eb04b65d1c43167b4', $token, Client::AUTH_URL_CLIENT_ID);

				$cards = $client->api('cards')->update($idCard,$arr);				
				return $this->redirect('getcardlist?listID='.$idList);
				
			}
			else
			{
				echo "ko tim thay token";
				exit();
			}
		}

    	return $this->render('updatecard');
    }
    

}