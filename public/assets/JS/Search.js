// Définir les données des postes

//postes = import from the database (entity = post)


const postes = [
    {
        title: 'Cathédrale Saint Vincent de Paul',
        dateTime: "2020-12-12",
        state: 'Tunis',
        category: 'monument',
        place: 'Cathédrale Saint Vincent de Paul',
        location: '53 Rue Mokhtar Attia, Tunis',
        description: 'La cathédrale Saint Vincent de Paul est un joyau architectural au cœur de Tunis. Cette magnifique église de style néo-byzantin est un lieu de culte important pour la communauté catholique de Tunisie et attire de nombreux visiteurs pour sa beauté exceptionnelle. J\'ai eu la chance de la visiter récemment et j\'ai été émerveillée par les magnifiques vitraux, les mosaïques colorées et les fresques impressionnantes. J\'ai également pu en apprendre davantage sur l\'histoire de la cathédrale et de la communauté catholique en Tunisie. Si vous êtes à Tunis, ne manquez pas de visiter cette merveille architecturale et spirituelle. Vous pourrez peut-être assister à une messe ou simplement vous imprégner de la sérénité et de la beauté de ce lieu de culte. À la sortie de la cathédrale, vous pourrez apercevoir des vendeurs ambulants proposant des objets artisanaux et peut-être même un musicien jouant de la flûte. Et si vous avez de la chance, vous pourriez voir un petit groupe de pigeons perchés sur la statue de Saint Vincent de Paul, ou un chat errant dans l\'allée.C\'est un endroit magique qui mérite vraiment une visite !',
        imageLink: "/images/desertTatawin.jpg",
        likesNumber: 10,
    }]


//-------------------------------------------FILTER AND ADD POSTES FROM SELECT-------------------------------------------

//a function that adds a post from postes array to the page
function addPost(post) {

    //create a div element
    const div = document.createElement('div');
    //add a class to the div element
    div.classList.add('poste');
    //create a template for the div element
    //<div class="poste">

    div.innerHTML = `
         <h3 class="post-title">${post.title}</h3>
         <div class="post-content">
            <img src="{{ asset('assets/Images/douz.jpg') }}" alt="Post image" class="post-image">
            <div class="post-description">
                <div class="Profile">
                    <img src="{{ asset('assets/Images/heart.png')  }}"  alt="profile-image" class="profile-image" style="margin-bottom: -20px">
                    <div>
                        <h6 class="post-username">${post.ownerUsername}</h6>
                    </div>
                </div>


                <div class="post-description-text">
                    <p class="limited-text">${post.description}</p>
                        <button class="show-more" onclick="showMore()">more</button>
                </div>
                <div class="post-footer">
                    <div class="like-button">
                        <img src="../public/assets/Images/empty_heart.png" alt="Like icon" >
                        <span style="font-size: 14px">${post.likesCount}} likes</span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="input-group mt-auto">
                            <input type="text" class="form-control" placeholder="Add a comment..." id="CommentLabel">
                        </div>
                    <div class="comments mb-4" style="max-height: 400px; overflow-y: auto;">
                         <ul class="list-group list-group-flush" id="CommentSection">
                            <li class="list-group-item"> j'adore</li>
                            <li class="list-group-item"> C'est magnifique! J'aime trop</li>
                            <li class="list-group-item"> AMAZING !!</li>
                         </ul>
                    </div>
                </div>
            </div> 
         </div>     
                   
  `;

    //add the div element to the page
    document.querySelector('.postes').appendChild(div);

}


//a function that clears the postes from the page
function clearPostes() {
    //select all the postes on the page
    const postes = document.querySelectorAll('.poste');
    //loop through the postes array
    for (const element of postes) {
        //remove each poste from the page
        element.remove();
    }
}


//------------------------------------------------------------------------------------------------------------------------


//-------------------------------------------FILTER AND ADD POSTES FROM SEARCH-------------------------------------------

//a function that extracts the text from the search input
function getSearchText() {

    //get the value of the search input
    const searchText = document.getElementById('search-input').value;

    //return the value of the search input
    return searchText;
}

//enter key event listener
document.getElementById('search-input').addEventListener('keyup', function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById('search-button').click();
    }
});

//-------------------------------------------------post description show more------------------------------------------

function showMore() {
    var text = document.querySelectorAll(".limited-text");
    var button = document.querySelectorAll(".show-more");
    var description = document.querySelectorAll(".post-description-text");
    var comments = document.querySelectorAll(" .post-footer");

    if (text[0].style.height) {
        for (let i = 0; i < text.length; i++) {
            text[i].style.height = null;
            text[i].style.overflow = "visible";
        }
        for (let i = 0; i < button.length; i++) {
            button[i].innerHTML = "less";
        }
        for (let i = 0; i < comments.length; i++) {
            // comments[i].style.display="none";
            comments[i].style.opacity = "0";
        }
    } else {
        for (let i = 0; i < text.length; i++) {
            text[i].style.height = "150px";
            text[i].style.overflow = "hidden";
        }
        for (let i = 0; i < button.length; i++) {
            button[i].innerHTML = "more";
        }

        for (let i = 0; i < comments.length; i++) {
            comments[i].style.opacity = "100";
        }

    }
}


function hideMoreButton() {
    var text = document.querySelectorAll(".limited-text");
    var button = document.querySelectorAll(".show-more");
    var maxHeight = 150; // maximum height for post description


    for (let i = 0; i < text.length; i++) {
        if (text[i].scrollHeight > maxHeight) {
            // show "more" button if description height exceeds maxHeight
            button[i].style.display = "block";
        } else {
            // hide "more" button if description height is less than or equal to maxHeight
            button[i].style.display = "none";
        }
    }
}

hideMoreButton();


$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() == 5000) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });

    $('#back-to-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
});
