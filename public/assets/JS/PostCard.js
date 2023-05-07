$(document).ready(function(){
    $('img.Post').on('click', function() {
        const loader = $('.CardLoader:first');
        loader.hide();
        let postid = $(this).attr('postid');
        if(loader.attr('id') === 'enabled'){
            $.ajax({
                url: 'http://127.0.0.1:8000/api/FetchPost',
                type: 'POST',
                data: { Post_id: postid },
                xhrFields: {
                    withCredentials: true
                },
                success: function(response) {
                    LoadPost(loader, response.toString());
                    Loadcomments($('.CommentSection[postid="'+ postid  +'"]'),0);
                    console.log('.CommentSection[postid="'+ postid  +'"]')
                },
                error: function(xhr, status, error) {
                    console.error("Error: ", error.toString());
                }
            });
        }
    });
});

function LoadPost(loader, content){
        loader.html(content);
        loader.fadeIn(350);
        loader.attr('id','Disabled');
        $(document).mouseup(function(e){
            let container = $("#PopupCard");
            if(!container.is(e.target) && container.has(e.target).length === 0){
                loader.fadeOut(350);
                window.setTimeout(function(){
                    container.remove();
                    loader.attr('id','enabled');
                }, 350);
                $(document).unbind('mouseup');
            }
        });
        window.setTimeout(function(){
            LoadCommentSection();
            Loadbtn($("#LikeBtn"));}, 150);
}
