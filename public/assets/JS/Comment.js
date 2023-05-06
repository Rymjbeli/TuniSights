
$(document).ready(function(){
    LoadCommentSection();
});

function CommentEvent(commentarea){
    let val = commentarea.val();
    if(val===""){
        return;
    }
    commentarea.val("");
    $.ajax({
        url: 'http://127.0.0.1:8000/api/AddComment',
        type: 'POST',
        data: { Post_id: commentarea.attr('postid'), Content: val},
        xhrFields: {
            withCredentials: true
        },
        success: function(response) {
            let i = document.createElement("li");
            i.className = "list-group-item";
            i.textContent = val;
            $('.CommentSection[postid="'+ commentarea.attr('postid') +'"]').append(i);
            console.log("yala comment added: " +commentarea.attr('postid'));
        },
        error: function(xhr, status, error) {
            console.error("Error: ", error);
            let i = document.createElement("li");
            i.className = "list-group-item";
            i.textContent = "connection error";
            i.style.color = "red";
            $('.CommentSection[postid="'+ commentarea.attr('postid') +'"]').append(i);
        }
    });

}

function LoadCommentSection(){
    $(".CommentArea").each(function (){
        let commentarea = $(this);
        $(this).on('keydown',function (e){
            if (e.keyCode === 13)
            {
                CommentEvent($(this));
            }
        });
        $('.Commentbtn[postid="'+$(this).attr('postid')+'"]').click(function (){
            CommentEvent(commentarea);
        });
    });
}