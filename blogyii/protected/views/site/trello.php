<!-- The client library requires jQuery  -->
  <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
  <script src="https://api.trello.com/1/client.js?key=658f0e49767a334eb04b65d1c43167b4"></script>
	<?php 
		$baseUrl = Yii::app()->request->baseUrl;
		$session = Yii::app()->session;
	    $session->open();
	    $thongbao = "";

	 ?>
<div class="tree" style="text-align: center; font-size: 30px;">
    <a id='token-request' href='#'> Connect Trello</a>
</div>




<style type="text/css">
	#loggedout {
    text-align: center;
    font-size: 20px;
    padding-top: 30px;
}
	#loggedin { 
	    display: none; 
	}


	#output {
	    padding: 4px;
	}

	.card { 
	    display: block; 
	    padding: 2px;
	}

</style>
 <script>
   var baseUrl = '<?= Yii::app()->request->baseUrl ?>';
      var requestToken = function(){
        Trello.authorize({
          type: "popup",
          scope: { read: true, write: true,account:true},          
          persist: false,
          expiration: "never",
          name: "Tagrem Corp VN",
          success: function(){
            $("#token-request-wrapper").fadeOut();
            var token = Trello.token();
            var memberBoardsUrl = "https://api.trello.com/1/members/me/boards?key=658f0e49767a334eb04b65d1c43167b4&token=" + token;
            sendToken(token);     
          }
        })
      };
      function sendToken(token)
    {

        $.ajax({
            url: baseUrl + "/site/token",
            type: 'get',
            dataType: 'json',
            data: {token: token},
            success: function(result) {
               //location.reload();
               window.location.assign(baseUrl + "/site/getboard");
            },
            error: function(result) {
                alert("Error");
            }
        })
    }


      $("#token-request").click(requestToken);

      $("#member-boards").click(function(e){
        if(!Trello.authorized()){
          e.preventDefault();
          requestToken();
        }
      });

   
     // $memberBoards = $("#member-boards");
            // $memberBoards.attr("href", memberBoardsUrl).text(memberBoardsUrl);
            //alert(memberBoardsUrl);
    </script> 




<script type="text/javascript">
	$(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
});
</script>
<style type="text/css">
	.tree {
    min-height:20px;
    padding:19px;
    margin-bottom:20px;
    background-color:#fbfbfb;
    border:1px solid #999;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
}
.tree li {
    list-style-type:none;
    margin:0;
    padding:10px 5px 0 5px;
    position:relative
}
.tree li::before, .tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:1px solid #999;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:1px solid #999;
    height:20px;
    top:25px;
    width:25px
}
.tree li span {
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border:1px solid #999;
    border-radius:5px;
    display:inline-block;
    padding:3px 8px;
    text-decoration:none
}
.tree li.parent_li>span {
    cursor:pointer
}
.tree>ul>li::before, .tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:30px
}
.tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
    background:#eee;
    border:1px solid #94a0b4;
    color:#000
}
</style>
