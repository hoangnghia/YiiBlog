<?php
class RightPost extends CWidget {
 
    public $crumbs = array();
    public $delimiter = ' / ';
 
    public function run() {
    	$model = Post::Get_New_Post();	
        $this->render('RightPost', array('model'=>$model));
    }
 
}
?>