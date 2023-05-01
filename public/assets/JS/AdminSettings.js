document.addEventListener("DOMContentLoaded", function (event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            navc = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)


        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener('click', () => {
                // show navbar
                nav.classList.toggle('show')
                // change icon
                toggle.classList.toggle('bx-x')
                // add padding to body
                bodypd.classList.toggle('body-pd')
                // add padding to header
                headerpd.classList.toggle('body-pd')
            })
        }
    }

    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')


    //Link Active
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
        }
    }

    linkColor.forEach(l => l.addEventListener('click', colorLink))

});


// Add click event listeners to the sidebar links: change the content and keep
//the same page
let sidebarLinks = document.querySelectorAll('.nav .nav_link');
sidebarLinks.forEach(function (link) {
    link.addEventListener('click', function (event) {

        let target = document.querySelector(link.getAttribute('href'));
        if (target) {
            // Hide all content sections
            let sections = document.querySelectorAll('.section');
            sections.forEach(function (section) {
                section.style.display = 'none';
            });

            // Show the target content section
            target.style.display = 'block';
        }
    });
});

