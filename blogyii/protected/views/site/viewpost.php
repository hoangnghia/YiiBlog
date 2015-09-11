<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Chi tiết tin tức';
$this->breadcrumbs=array(
	'Chi tiết tin tức',
);
?>

<div class="container">
        <div class="row">
        <?php
        	if(isset($model))
        	{       		
        	
        ?>
            <div class="col-lg-8">

                <!-- the actual blog post: title/author/date/content -->
                <h1><?= $model['post_title'];?></h1>
                <p class="lead">by <a href="#">Admin</a>
                </p>
                <hr>
                <p>
                    <span class="glyphicon glyphicon-time"></span> Posted on <?=$model['date'];?></p>
                <hr>               
                
                <p><?= $model['post_content']?></p>                
                              
					 <hr>
                <!-- the comment box -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form">
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>



                <!-- the comments -->
                <h3>Start Bootstrap
                    <small>9:41 PM on August 24, 2013</small>
                </h3>
                <p>This has to be the worst blog post I have ever read. It simply makes no sense. You start off by talking about space or something, then you randomly start babbling about cupcakes, and you end off with random fish names.</p>

                <h3>Start Bootstrap
                    <small>9:47 PM on August 24, 2013</small>
                </h3>
                <p>Don't listen to this guy, any blog with the categories 'dinosaurs, spaceships, fried foods, wild animals, alien abductions, business casual, robots, and fireworks' has true potential.</p>

            </div>
            <?php
        }
            ?>

            <?php $this->widget('application.components.RightPost', array(
			 			
			)); ?>
        </div>

        <hr>

        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © Company 2013</p>
                </div>
            </div>
        </footer>

    </div>
