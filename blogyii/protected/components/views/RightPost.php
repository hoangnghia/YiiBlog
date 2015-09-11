<?php
    $baseUrl = Yii::app()->request->baseUrl;
?>
<div class="col-lg-3">
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="<?= $baseUrl;?>/site/search" method="GET">    
                    <div class="input-group">
                            <input type="text" name="key" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        
                    </div>
                    </form>
                    <!-- /input-group -->
                </div>
                <!-- /well -->
                <div class="well">
                    <h4>News blog</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="recent-posts">
                            <?php
                                foreach ($model as $item) {                              
                            ?>
                                <li>                            
                                    <div class="text">
                                        <p><a href="<?= $baseUrl?>/site/viewpost/<?= $item['post_ID']?>" title="<?= $item['post_title']?>"><?= $item['post_title']?></a></p>
                                    </div>
                                </li>  
                                <?php
                                    }
                                ?>                             
                            </ul>
                        </div>
                       
                    </div>
                </div>
                <!-- /well -->
                <div class="well">
                    <h4>Xem nhiều</h4>
                    
                </div>
                <!-- /well -->
            </div>