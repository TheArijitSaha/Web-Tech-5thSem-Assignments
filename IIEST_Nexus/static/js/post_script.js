//Helper Functions:

// To create an alert div with message provided
function create_alert_string(message, alertClass, id){
    f='<div class="alert alert-'+ alertClass + ' alert-dismissible fade show" role="alert" id="' + id + '">' +
        message +
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '<span aria-hidden="true">&times;</span>' +
        '</button>' +
    '</div>';
    return f;
}

function construct_post_string(post){
    f='<div class="card">' +
        '<div class="card-body">' +
            '<div class="row">' +
                '<div class="col-sm-9">' +
                    '<h5 class="card-title">' +
                        '<a href=\"profile.php?userid=' + post.userid + '\">' +
                            post.username +
                        '</a>' +
                    '</h5>' +
                '</div>' +
                '<div class="col-sm-3">' +
                    '<span style="float:right;">' +
                        post.posted_at +
                    '</span>' +
                '</div>' +
            '</div>' +

            '<div class="card-text">' +
                post.body +
            '</div>' +
        '</div>' +
    '</div>';
    return f;
}


$(document).ready(function()
{

    //for loading posts
    function showMyPosts(post_list_json){
        $('.postBox').empty();
        post_list=JSON.parse(post_list_json);
        // let f='<ul class="skillList">';
        if(post_list.data.length)
        {
            // If there are no posts
        }

        for(x in post_list.data){
            post_node=$(construct_post_string(post_list.data[x]));
            $('.postBox').append(post_node);
        }
    }
    $.post("async/post_async.php",{showAllPost:true}).done(showMyPosts);




    //for creating a post
    $('#postCreateBtn').on("click", function()
    {
        var this_button=this;
        var postContent = $('#postContent').val();
        if (postContent.length<1)
        {
            this_alert=$(create_alert_string('No content in Post!','primary','search-alert'));
            this_alert.insertBefore($(this).parent());
            this_alert.css("margin","10px 0px");
            this_alert.fadeTo(2000, 0).slideUp(500,function(){
                $(this).remove();
            });
            return;
        }

        $.post("async/post_async.php", {createpost: true , postbody: postContent}).done(function(result_json)
        {
            result=JSON.parse(result_json);
            if(result.executed===false)
            {
                this_alert=$(create_alert_string('Unable to post!','danger',''));
                this_alert.insertBefore($(this_button).parent());
                this_alert.css("margin","10px 0px");
                this_alert.fadeTo(2000, 0).slideUp(500,function(){
                    $(this).remove();
                });
            }
            else {
                console.log('ho rah ahi');
                $.post("async/post_async.php",{showAllPost:true}).done(showMyPosts);
            }
        });
    });



});
