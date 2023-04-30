$(document).ready(function(){
    let liked = false;
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
    $('img.Post').on('click', function() {
        const loader = $('.CardLoader:first');
        loader.hide();
        if(loader.attr('id') === 'enabled'){
            loader.load('@App/templates/PostCard.html.twig');
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
            $("#LikeBtn").click(function() {
                //Implement like event
                if(liked){
                    $(this).css("background-image","url('../Images/HeartI.png')");
                }else{
                    $(this).css("background-image","url('../Images/HeartF.png')");
                }
                liked = !liked;
            });}, 150);
            }
        });
});

/*
Testing ajax callbacks
    $.ajax({
        url: '../API/Like.php',
        type: 'POST',
        data: { Post_id: '1', },
        xhrFields: {
            withCredentials: true
        },
        success: function(response) {
            alert(response);
        }
    });*/