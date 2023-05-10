    // Define function to toggle the box
    function toggleBox() {
        var down = false;
        var bell = document.getElementById("bell");
        var box = document.getElementById("box");

        bell.addEventListener("click", function (e) {
            e.stopPropagation(); // prevent click event from bubbling up to document object
            // check current state of the box
            if (down) {
                closeBox();
            } else {
                openBox();
            }
        });

        // define function to open the box
        function openBox() {
            box.style.height = "auto";
            box.style.opacity = "1";
            down = true;
            document.addEventListener("click", closeBox);
        }

        // define function to close the box
        function closeBox() {
            box.style.height = "0px";
            box.style.opacity = "0";
            down = false;
            document.removeEventListener("click", closeBox);
        }
    }

    // add event listener to wait for DOM to load before calling toggleBox function
    document.addEventListener("DOMContentLoaded", toggleBox);


    // This function removes the notification dot and submits the hidden form in the index.html.twig
    function removeNotificationDot() {
        const notificationDot = document.getElementById('notification-dot');

        notificationDot.style.display = 'none';
        console.log("Form submitted"); // Add this line
        document.getElementById('remove-notification-form').submit();

    }
