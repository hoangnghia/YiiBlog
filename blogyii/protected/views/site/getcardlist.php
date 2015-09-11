<?php 
		$baseUrl = Yii::app()->request->baseUrl;
		$session = Yii::app()->session;
	    $session->open();
	    $thongbao = "";
	    

	 ?>

<div class="container">
    <div class="row">
        <div class="col-md-11">
           
                <div class="row">                    
                <?php
                	if(isset($session['token']))
					    	{	
					    		$idList = $cards[0]['idList'];					    		
					    		echo "<div class=col-xs-11' style='margin-bottom: 10px;'>List cards: <a href='". $baseUrl ."/site/logouttrello' style='border: 1px solid #999; display: inline-block; padding: 9px 10px; text-decoration: none; background-color: #539DC7; color: #FFF;' >Logout Trello</a>	";
					    		echo " <a href='". $baseUrl ."/site/createCard?idList=".$idList."' style='border: 1px solid #999; display: inline-block; padding: 9px 10px; text-decoration: none; background-color: #539DC7; color: #FFF;' >Create new card</a></div>";
					    		if($cards != null)
						    		{						    			
						    			// echo "<a href='". $baseUrl ."/site/logouttrello' style='border: 1px solid #999; display: inline-block; padding: 9px 10px; text-decoration: none; background-color: #539DC7; color: #FFF;' >Logout Trello</a>";
						    			
						    			 foreach ($cards as $card) {						    			 			
													$cardID = $card['id'];

					   		
                ?>
                    <div class="col-xs-11 col-md-11 section-box">
                        <h2>
                          <?= $card['name']?>
                            
                        </h2>
                        <p>
                            <?= $card['desc']?><br/>
                        </p>

                     </div>
                     <div class="row rating-desc">
                            <div class="col-md-11" style="    color: red;">
								<span class="glyphicon glyphicon-comment" > Deadline: </span> <?= $card['due']?></p>
                            </div>
                        </div>
                       
                            <div class="form-group">                               
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="addComment<?=$cardID;?>" rows="5"></textarea>
                                </div>
                            </div>   
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-5" style="margin-left: 1.666667%;margin-bottom: 10px;">
                                    <button class="btn btn-success btn-circle text-uppercase" style="margin-top:10px;"  onclick="addComment('<?=$cardID;?>'); return true;" id="submitComment"><span class="glyphicon glyphicon-send"></span>Comment</button>
                                </div>
                                <div class="col-sm-offset-2 col-sm-5" style="margin-left: 1.666667%;margin-bottom: 10px;">
                                    <a  href="<?=$baseUrl?>/site/updatecard?idCard=<?=$cardID;?>&idList=<?=$idList?>" class="btn btn-success btn-circle text-uppercase" style="margin-top:10px;float: right;" ><span class="glyphicon glyphicon-send"></span>Update card</a>
                                </div>
                                
                            </div>

                      
                        <hr />
                        
                    
                    <?php
                }

            }
        }
                    	else
                    	{
                    		echo "ko co data";
                    	}
                    ?>
                </div>
            </div>
        </div>      
    </div>
</div>

<script type="text/javascript">
    function addComment(idCard)
    {
         var baseUrl = '<?= Yii::app()->request->baseUrl ?>';
        var comment = $('#addComment'+ idCard).val();  
        if($('#addComment'+ idCard).val() == "")      
        {
            alert("Please add comment");
            return false;
        }
         $.ajax({
            url: baseUrl + "/site/addcomment",
            type: 'get',
            // dataType: 'html',
            data: {idCard: idCard,comment:comment},
            success: function(result) {
                $('#addComment'+ idCard).val("");
                alert(result);
            },
            error: function(result) {
                alert(result);
            }
        })
    }
</script>
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>