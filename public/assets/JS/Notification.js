
$(document).ready(function() {
    $('.notifications-item').each(function (){
        $(this).click(function (){
            let postid = $(this).attr('postid');
            $.ajax({
                url:'/notification?post='+$(this).attr('notificationId'),
                type: 'GET',
                xhrFields: {
                    withCredentials: true
                },
                success: function(response) {
                    console.log(response);
                },
            });
            const loader = $('.CardLoader:first');
            loader.hide();
            if(loader.attr('id') === 'enabled'){
                $.ajax({
                    url: '/api/FetchPost',
                    type: 'POST',
                    data: { Post_id: postid },
                    xhrFields: {
                        withCredentials: true
                    },
                    success: function(response) {
                        LoadPost(loader, response.toString());
                        //Loadcomments($('.CommentSection[postid="'+ postid  +'"]'),0);
                        console.log('.CommentSection[postid="'+ postid  +'"]')
                    },
                    error: function(xhr, status, error) {
                        console.error("Error: ", error.toString());
                    }
                });
            }
        });
    });
});