
<?php 
		$baseUrl = Yii::app()->request->baseUrl;
		$session = Yii::app()->session;
	    $session->open();
	    $thongbao = "";

	 ?>
<div class="col-xs-12">        
    <div class="carousel slide" id="myCarousel">
        <div class="carousel-inner">
            <div class="item active">
                    <ul class="thumbnails">
                    <?php
                    	if(isset($session['token']))
					    	{
					    		echo "<div class=col-xs-11' style='margin-bottom: 10px;'>List: <a href='". $baseUrl ."/site/logouttrello' style='border: 1px solid #999; display: inline-block; padding: 9px 10px; text-decoration: none; background-color: #539DC7; color: #FFF;' >Logout Trello</a></div>";
					    		if($lists != null)
						    		{
						    			// echo "<a href='". $baseUrl ."/site/logouttrello' style='border: 1px solid #999; display: inline-block; padding: 9px 10px; text-decoration: none; background-color: #539DC7; color: #FFF;' >Logout Trello</a>";
						    			
						    			 foreach ($lists as $list) {
													$listID = $list['id'];
					   		 ?>	                   
	                        <li class="col-sm-3 abc" style="width: 32%; margin-left: 12px; margin-bottom: 30px;">
	    						<div class="fff">								
									<div class="caption">									
										<a class="btn btn-mini" style="font-size:15px;color:#FFF;" href="<?=$baseUrl?>/site/getcardlist?listID=<?=$listID?>"> » <?=$list['name'];?></a>
									</div>
	                            </div>
	                        </li>

                        <?php
                        	}
                        }
                    }
                    	else
                    	{
                    		echo "Không có data";
                    	}
                        ?>


                    </ul>
              </div><!-- /Slide1 -->            
        </div> 
                              
    </div><!-- /#myCarousel -->
        
</div><!-- /.col-xs-12 -->    

<style type="text/css">
	.abc
	{
		background-color: #69A8CD;
    display: block;
    padding: 20px 50pt;
    position: relative;
    text-decoration: none;
	}
</style>      

