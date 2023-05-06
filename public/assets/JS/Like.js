
$(document).ready(function(){
    $(".LikeBtn").each(function (){
        Loadbtn($(this));
});
});
function Loadbtn(btn){
    $.ajax({
        url: "/api/CheckLike?PostId="+btn.attr("postid"),
        type: "GET",
        dataType: "json",
        xhrFields: {
            withCredentials: true
        },
        success: function(response) {
            console.log(response);
            if(response.error !== undefined){console.error(response.error);return;}
            if(response.Liked){
                btn.css("background-image","url('/assets/Images/heartF.png')");
            }else{
                btn.css("background-image","url('/assets/Images/heartI.png')");
            }
            btn.attr("Liked",response.Liked);
            btn.click(function() {
                LikePost(btn);
            });
        },
        error: function(xhr, status, error) {
            console.error("Error: ", error);
        }
    });
}
function LikePost(btn){
    $.ajax({
        url: "/api/Like",
        type: "POST",
        dataType: "json",
        data: { PostId: btn.attr("PostID")},
        xhrFields: {
            withCredentials: true
        },
        success: function(response) {
            if(response.error !== undefined){console.error(response.error);return false;}
            let likeCounter= $('.LikeCounter[Postid="'+btn.attr("postid")+'"]');
            if(btn.attr("Liked")==="True"){
                btn.css("background-image","url('/assets/Images/heartF.png')");
                btn.attr("Liked","False");
            }else{
                btn.css("background-image","url('/assets/Images/heartI.png')");
                btn.attr("Liked","True")
            }
            likeCounter.text(response.LikeCount + " Likes");
            console.log(response);
            return true;
        },
        error: function(xhr, status, error) {
            console.error("Error: ", error);
            return false;
        }
    });
}