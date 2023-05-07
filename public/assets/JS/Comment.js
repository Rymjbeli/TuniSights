
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
function Loadcomments(commentsection, index){
    $.ajax({
        url: 'http://127.0.0.1:8000/api/LoadComment',
        type: 'POST',
        data: { Post_id: commentsection.attr('postid'),
            start:index},
        xhrFields: {
            withCredentials: true
        },
        success: function(response) {
            console.log(response)
            for (var i = 0; i < response.length; i++) {
                var comment = response[i];
                var li = document.createElement('li');
                li.setAttribute('class', 'list-group-item');
                var usernameSmall = document.createElement('small');
                usernameSmall.setAttribute('class', 'text-muted font-weight-bold');
                usernameSmall.textContent = comment.username;
                var contentDiv = document.createElement('div');
                contentDiv.setAttribute('class', 'd-flex justify-content-between align-items-center');
                var commentDiv = document.createElement('div');
                var commentP = document.createElement('p');
                commentP.setAttribute('class', 'mb-1');
                commentP.textContent = comment.content;
                commentDiv.appendChild(commentP);
                var dateSmall = document.createElement('small');
                dateSmall.setAttribute('class', 'text-muted');
                dateSmall.textContent = comment.date;
                contentDiv.appendChild(commentDiv);
                contentDiv.appendChild(dateSmall);
                li.appendChild(usernameSmall);
                li.appendChild(contentDiv);
                commentsection.append(li);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error: ", error);
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