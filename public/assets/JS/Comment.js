
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
            li.show();
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
function CreateCommentElement(comment) {
    const li = document.createElement('li');
    li.setAttribute('class', 'list-group-item');

    const usernameSmall = createUsernameSmall(comment.username);
    li.appendChild(usernameSmall);

    const contentDiv = createContentDiv(comment.content, comment.date);
    li.appendChild(contentDiv);

    if (comment.owned) {
        const deleteBtn = createDeleteButton(comment.id);
        li.appendChild(deleteBtn);
    }

    return li;
}

function createUsernameSmall(username) {
    const usernameSmall = document.createElement('small');
    usernameSmall.setAttribute('class', 'text-muted font-weight-bold');
    usernameSmall.textContent = username;
    return usernameSmall;
}

function createContentDiv(content, date) {
    const contentDiv = document.createElement('div');
    contentDiv.setAttribute('class', 'd-flex justify-content-between align-items-center comment-item');

    const commentDiv = document.createElement('div');
    const commentP = document.createElement('p');
    commentP.setAttribute('class', 'mb-1');
    commentP.textContent = content;
    commentDiv.appendChild(commentP);
    contentDiv.appendChild(commentDiv);

    const dateSmall = document.createElement('small');
    dateSmall.setAttribute('class', 'text-muted');
    dateSmall.textContent = date;
    contentDiv.appendChild(dateSmall);

    return contentDiv;
}

function createDeleteButton(commentId) {
    const deleteBtn = document.createElement('button');
    deleteBtn.setAttribute('class', 'btn btn-danger btn-sm');
    deleteBtn.style.border = 'none';
    deleteBtn.style.marginLeft = '90%';
    deleteBtn.style.marginTop = '5px';
    deleteBtn.style.opacity = '0.8';
    deleteBtn.style.color = 'rgb(0, 97, 149)';
    deleteBtn.style.backgroundColor = 'transparent';

    const deleteicon = document.createElement('i');
    deleteicon.setAttribute('class', 'fas fa-trash');
    deleteBtn.appendChild(deleteicon);

    deleteBtn.addEventListener('click', function () {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/DeleteComment',
            type: 'POST',
            data: { Comment_id: commentId },
            xhrFields: {
                withCredentials: true
            },
            success: function (response) {
                console.log(response);
                deleteBtn.parentElement.remove();
            },
            error: function (xhr, status, error) {
                console.error("Error: ", error);
            }
        });
    });

    return deleteBtn;
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
                commentsection.find('.LoadMarker').hide();
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
        Loadcomments(commentsection);
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