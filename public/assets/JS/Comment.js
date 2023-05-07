
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
            let commentsection = $('.CommentSection[postid="'+ commentarea.attr('postid') +'"]');
            let li = CreateCommentElement(response);
            commentsection.find('.LoadMarker').before(li);
            console.log(response);
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
function CreateCommentElement(comment){
    let li = document.createElement('li');
    li.setAttribute('class', 'list-group-item');
    let usernameSmall = document.createElement('small');
    usernameSmall.setAttribute('class', 'text-muted font-weight-bold');
    usernameSmall.textContent = comment.username;
    let contentDiv = document.createElement('div');
    contentDiv.setAttribute('class', 'd-flex justify-content-between align-items-center');
    let commentDiv = document.createElement('div');
    let commentP = document.createElement('p');
    commentP.setAttribute('class', 'mb-1');
    commentP.textContent = comment.content;
    commentDiv.appendChild(commentP);
    let dateSmall = document.createElement('small');
    dateSmall.setAttribute('class', 'text-muted');
    dateSmall.textContent = comment.date;
    contentDiv.appendChild(commentDiv);
    contentDiv.appendChild(dateSmall);
    li.appendChild(usernameSmall);
    li.appendChild(contentDiv);
    return li;
}
function Loadcomments(commentsection){
    $.ajax({
        url: 'http://127.0.0.1:8000/api/LoadComment',
        type: 'POST',
        data: { Post_id: commentsection.attr('postid'),
            start:commentsection.attr('index'),},
        xhrFields: {
            withCredentials: true
        },
        success: function(rawresponse) {
            let response = Object.values(rawresponse)
            console.log(response);
            let i = 0;
            console.log(response.length);
            for (i; i < response.length; i++) {
                let comment = response[i];
                let li = CreateCommentElement(comment);
                commentsection.find('.LoadMarker').before(li);
            }
            if(response.length<10){
                commentsection.find('.LoadMarker').remove();
            }else{
                commentsection.find('.LoadMarker').show();

            }
            commentsection.attr('index',parseInt(commentsection.attr('index'))+1);
        },
        error: function(xhr, status, error) {
            console.error("Error: ", error);
        }
    });
}
function LoadCommentSection(){
    $(".CommentArea").each(function (){
        let commentarea = $(this);
        let commentsection = $('.CommentSection[postid="'+$(this).attr('postid')+'"]');
        commentsection.find('.LoadMarker').click(function (){
            Loadcomments(commentsection);
            $(this).hide();
        });
        $(this).on('keydown',function (e){
            if (e.keyCode === 13)
            {
                CommentEvent($(this));
            }
        });
        $('.Commentbtn[postid="'+$(this).attr('postid')+'"]').click(function (){
            CommentEvent(commentarea);
        });
        $(this).find('.LoadMarker').click(function (){

        });
    });
}