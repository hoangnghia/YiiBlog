<?php
  $baseUrl = Yii::app()->request->baseUrl;
  $idList = "";
  if(isset($_GET['idList']))
  {
      $idList = $_GET['idList'];      
  }
?>
<div class="container">
	<div class="row">
		<form role="form"  action="<?=$baseUrl?>/site/createcard" id="contact-form" method="post" class="contact-form">
          <div class="row">
      		<div class="col-md-5">
        		<div class="form-group">
                  <input type="text" class="form-control" name="cardname" autocomplete="off" id="cardname" placeholder="Card name">
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
            <!--  <div class="col-md-5">
            <div class="form-group">
              <p>Labes</p>
                    <div class="btn-group" data-toggle="buttons">
      
                        <label class="btn btn-success active" style="background-color:#519839">
                          <input type="checkbox" name="labelgreen" value="green" autocomplete="off" checked>
                          <span class="glyphicon glyphicon-ok"></span>
                        </label>

                        <label class="btn btn-primary" style="background-color: #f2d600;">
                          <input type="checkbox" name="labelyellow" value="yellow" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span>
                        </label>      
                      
                        <label class="btn btn-info" style="background-color: #ffab4a;">
                          <input type="checkbox" name="labelorange" value="orange" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span>
                        </label>      
                      
                        <label class="btn btn-default" style="background-color: #EB5A46;">
                          <input type="checkbox" name="labelred" value="red" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span>
                        </label>      

                        <label class="btn btn-warning" style="    background-color: #C377E0;">
                          <input type="checkbox" name="labelpurple" value="purple" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span>
                        </label>      
                      
                        <label class="btn btn-danger" style="background-color: #0079BF;">
                          <input type="checkbox" name="labelblue" value="blue" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span>
                        </label>      
                    
                    </div>
            </div>
          </div>  -->    
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
        <button type="submit" class="btn main-btn pull-right">Create card</button>
        </div>
        </div>
      </form>
	</div>
</div>

<style type="text/css">
  .btn span.glyphicon {         
  opacity: 0;       
  }
  .btn.active span.glyphicon {        
    opacity: 1;       
  }

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
 <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

