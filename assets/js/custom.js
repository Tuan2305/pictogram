// for priview the post image
var input = document.querySelector("#select_post_img");

input.addEventListener("change",preview);

function preview(){
    var fileobject = this.files[0];
    var filereader = new FileReader();

    filereader.readAsDataURL(fileobject);

    filereader.onload = function(){
        var image_src = filereader.result;
        var image = document.querySelector("#post_img");
        image.setAttribute('src', image_src);
        image.setAttribute('style', 'display:');
    }

}

// for follow the user
$(".followbtn").click(function(){
    var user_id_v =$(this).data('userId');
    var button =this;
    $(button).attr('disabled', true);

    $.ajax({
        url: 'assets/php/ajax.php?follow',
        method: 'post',
        dataType:'json',
        data: {user_id: user_id_v},
        success: function(response){
            console.log(response);
            if(response.status){
            
                $(button).data('userId',0);
                $(button).html('<i class="bi bi-check-circle-fill"></i> Followed');
            }
            else{
                $(button).attr('disabled', false);
                alert('something is wrong, try again after sometime');
            }
        }
    }); 
  
});


// for unfollow the user
$(".unfollowbtn").click(function(){
    var user_id_v =$(this).data('userId');
    var button =this;
    $(button).attr('disabled', true);

    $.ajax({ 
        url: 'assets/php/ajax.php?unfollow',
        method: 'post',
        dataType:'json',
        data: {user_id: user_id_v},
        success: function(response){
            console.log(response);
            if(response.status){
            
                $(button).data('userId',0);
                $(button).html('<i class="bi bi-check-circle-fill"></i> Unfollowed');
            }
            else{
                $(button).attr('disabled', false);
                alert('something is wrong, try again after sometime');
            }
        }
    }); 
  
});

// for like the post

$(".like_btn").click(function(){                
    var post_id_v =$(this).data('postId');
    var button =this;
    $(button).attr('disabled', true);

    $.ajax({ 
        url: 'assets/php/ajax.php?like',
        method: 'post',
        dataType:'json',
        data: {post_id: post_id_v},
        success: function(response){
            console.log(response);
            if(response.status){
                $(button).attr('disabled', false);
                $(button).attr('class', 'bi bi-heart-fill unlike_btn');
            }
            else{
                $(button).attr('disabled', false);
                alert('something is wrong, try again after sometime');
            }
        }
    }); 
  
});


$(".unlike_btn").click(function(){
    var post_id_v =$(this).data('postId');
    var button =this;
    $(button).attr('disabled', true);

    $.ajax({ 
        url: 'assets/php/ajax.php?unlike',
        method: 'post',
        dataType:'json',
        data: {post_id: post_id_v},
        success: function(response){
            console.log(response);
            if(response.status){
                $(button).attr('disabled', false);
                $(button).attr('class', 'bi bi-heart like_btn');

            }
            else{
                $(button).attr('disabled', false);
                alert('something is wrong, try again after sometime');
            }
        }
    }); 
  
});






