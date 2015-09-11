<?php 
	$session = Yii::app()->session;
    $session->open();
    if(isset($session['token']))
    {
    	echo "OK";
    }
 ?>