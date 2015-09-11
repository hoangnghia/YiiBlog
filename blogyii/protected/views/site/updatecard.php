<?php
  $baseUrl = Yii::app()->request->baseUrl;
  $idList = "";
  if(isset($_GET['idCard']) && $_GET['idList'])
  {
      $idCart = $_GET['idCard']; 
      $idList = $_GET['idList'];     
  }
?>
<div class="container">
	<div class="row">
    <h2>Update Card ID: <?=$idCart;?></h2>
		<form role="form"  action="<?=$baseUrl?>/site/updatecard" id="contact-form" method="post" class="contact-form">
          <div class="row">
      		<div class="col-md-5">
        		<div class="form-group">
                  <input type="text" class="form-control" name="cardname" autocomplete="off" id="cardname" placeholder="Card name">
                  <input type="hidden" value="<?= $idCart?>" name="idCard">
                    <input type="hidden" value="<?= $idList?>" name="idList">
        		</div>
        	</div>        
        	</div>
           <div class="row">
          <div class="col-md-5">
            <div class="form-group">
                  <input type="datetime-local" class="form-control" name="due" autocomplete="off" id="cardname" placeholder="Deadline">                  
            </div>
          </div>        
          </div>
        	<div class="row">
        		<div class="col-md-11">
        		<div class="form-group">
                  <textarea class="form-control textarea" rows="3" name="description" id="description" placeholder="Description Card"></textarea>
        		</div>
        	</div>
          </div>
          <div class="row">
          <div class="col-md-11">
        <button type="submit" class="btn main-btn pull-right">Update card</button>
        </div>
        </div>
      </form>
	</div>
</div>

<style type="text/css">
  .contact-form{ margin-top:15px;}
  .contact-form .textarea{ min-height:220px; resize:none;}
  .form-control{ box-shadow:none; border-color:#eee; height:49px;}
  .form-control:focus{ box-shadow:none; border-color:#00b09c;}
  .form-control-feedback{ line-height:50px;}
  .main-btn{ background:#00b09c; border-color:#00b09c; color:#fff;}
  .main-btn:hover{ background:#00a491;color:#fff;}
  .form-control-feedback {
  line-height: 50px;
  top: 0px;
  }
</style>
