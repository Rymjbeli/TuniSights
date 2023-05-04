$(document).ready(function(){
    $('img.Post').on('click', function() {
        const loader = $('.CardLoader:first');
        loader.hide();
        if(loader.attr('id') === 'enabled'){
            $.ajax({
                url: 'http://127.0.0.1:8000/api/FetchPost',
                type: 'POST',
                data: { Post_id: $(this).attr('postid') },
                xhrFields: {
                    withCredentials: true
                },
                success: function(response) {
                    LoadPost(loader, response.toString());
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
            $("#CommentLabel").on('keydown',function (e){
                if (e.keyCode === 13)
                {CommentEvent();
                }
            });
            $(".CSubmit").click(CommentEvent);
            Loadbtn($("#LikeBtn"));}, 150);
}
function CommentEvent(){
    let CLabel = $("#CommentLabel");
    let val = CLabel.val();
    if(val===""){
        return;
    }
    let i = document.createElement("li");
    i.className = "list-group-item";
    i.textContent = val;
    $("#CommentSection").append(i);
    CLabel.val("");
    //Send comment to relevent API
}