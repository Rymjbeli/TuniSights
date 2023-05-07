
document.addEventListener("DOMContentLoaded", function() {

    var down = false;
    var bell = document.getElementById("bell");
    var box = document.getElementById("box");

    bell.addEventListener("click", function(e) {
        e.stopPropagation(); // prevent click event from bubbling up to document object
        var color = this.innerHTML;
        if (down) {
            box.style.height = "0px";
            box.style.opacity = "0";
            down = false;
        } else {
            box.style.height = "auto";
            box.style.opacity = "1";
            down = true;

            // add event listener to document object to listen for clicks
            document.addEventListener("click", function(e) {
                if (!box.contains(e.target)) { // check if click event was outside the box
                    box.style.height = "0px";
                    box.style.opacity = "0";
                    down = false;
                    document.removeEventListener("click", arguments.callee); // remove the event listener after closing the box
                    document.getElementById('countNotif').textContent = 0;
                }
            });
        }
    });

});

function removeNotificationDot() {
    const notificationDot = document.getElementById('notification-dot');

    notificationDot.style.display = 'none';
    console.log("Form submitted"); // Add this line
    document.getElementById('remove-notification-form').submit();

}
