
// Définir les données des postes

//postes = import from the database (entity = post)


 const postes = [
    {
        title: 'Cathédrale Saint Vincent de Paul',
        dateTime: "2020-12-12",
        state: 'Tunis',
        category: 'monument',
        place: 'Cathédrale Saint Vincent de Paul',
        location:'53 Rue Mokhtar Attia, Tunis',
        description: 'La cathédrale Saint Vincent de Paul est un joyau architectural au cœur de Tunis. Cette magnifique église de style néo-byzantin est un lieu de culte important pour la communauté catholique de Tunisie et attire de nombreux visiteurs pour sa beauté exceptionnelle. J\'ai eu la chance de la visiter récemment et j\'ai été émerveillée par les magnifiques vitraux, les mosaïques colorées et les fresques impressionnantes. J\'ai également pu en apprendre davantage sur l\'histoire de la cathédrale et de la communauté catholique en Tunisie. Si vous êtes à Tunis, ne manquez pas de visiter cette merveille architecturale et spirituelle. Vous pourrez peut-être assister à une messe ou simplement vous imprégner de la sérénité et de la beauté de ce lieu de culte. À la sortie de la cathédrale, vous pourrez apercevoir des vendeurs ambulants proposant des objets artisanaux et peut-être même un musicien jouant de la flûte. Et si vous avez de la chance, vous pourriez voir un petit groupe de pigeons perchés sur la statue de Saint Vincent de Paul, ou un chat errant dans l\'allée.C\'est un endroit magique qui mérite vraiment une visite !',
        imageLink: "/images/desertTatawin.jpg",
        likesNumber: 10,
    }]
    // {
    //     postId: 2,
    //     profileUserName: "Ines",
    //     profileImage: "../Images/user.png",
    //     date: "2020-5-3",
    //     time: "11:00",
    //     gouvernorat: "Mahdia",
    //     place: "Amphithéâtre de Djem",
    //     title: "Découvrez l'histoire de l'Amphithéâtre de Djem",
    //     description: "L'Amphithéâtre de Djem, également appelé l'Amphithéâtre de Thysdrus, est un site historique majeur en Tunisie. Construit au 3ème siècle après J.-C., cet amphithéâtre était l'un des plus grands de l'Empire romain. Aujourd'hui, il est considéré comme l'un des meilleurs exemples de l'architecture romaine en Afrique du Nord. Lors de ma visite, j'ai été fasciné par la taille et la beauté de cet édifice antique. J'ai également appris beaucoup de choses sur l'histoire de l'amphithéâtre grâce aux guides locaux. Si vous êtes passionné d'histoire et d'architecture, je vous recommande vivement de visiter l'Amphithéâtre de Djem lors de votre prochain voyage en Tunisie !",
    //     imageLink: "../Images/amphiteatreDjem.jpg",
    //     likesNumber: 5,
    // },
    // {
    //     postId: 3,
    //     profileUserName: "Sarra",
    //     profileImage: "../Images/user.png",
    //     date: "2023-04-14",
    //     time: "10:30",
    //     gouvernorat: 'Nabeul',
    //     place: 'Plage de Nabeul',
    //     title: 'Découverte des traditions des pêcheurs de Nabeul',
    //     description: "La plage de Nabeul est l'un des joyaux cachés de la Tunisie. Cette magnifique plage de sable blanc offre une vue imprenable sur les eaux cristallines de la Méditerranée. Lors de mon dernier voyage à Nabeul, j'ai décidé de partir à la découverte des traditions des pêcheurs locaux. J'ai eu la chance de rencontrer un pêcheur qui m'a expliqué les différentes techniques de pêche qu'il utilise pour capturer les poissons de la région. Nous avons discuté de la vie des pêcheurs de Nabeul et de l'importance de la mer pour la communauté locale. À la fin de notre conversation, j'ai pu voir le pêcheur partir dans son petit bateau en direction de la mer, pour une journée de travail.",
    //     imageLink: '../Images/search/plageNabeul.jpg',
    //     likesNumber: 15,
    // },
    // {
    //     postId: 4,
    //     profileUserName: "Rim",
    //     profileImage: "../Images/user.png",
    //     date: "2022-02-15",
    //     time: "16:30",
    //     gouvernorat: 'Tunis',
    //     place: 'Cathédrale Saint Vincent de Paul',
    //     title: 'Une visite inoubliable à la cathédrale de Tunis',
    //     description: "La cathédrale Saint Vincent de Paul est un joyau architectural au cœur de Tunis. Cette magnifique église de style néo-byzantin est un lieu de culte important pour la communauté catholique de Tunisie et attire de nombreux visiteurs pour sa beauté exceptionnelle. J'ai eu la chance de la visiter récemment et j'ai été émerveillée par les magnifiques vitraux, les mosaïques colorées et les fresques impressionnantes. J'ai également pu en apprendre davantage sur l'histoire de la cathédrale et de la communauté catholique en Tunisie. Si vous êtes à Tunis, ne manquez pas de visiter cette merveille architecturale et spirituelle. Vous pourrez peut-être assister à une messe ou simplement vous imprégner de la sérénité et de la beauté de ce lieu de culte. À la sortie de la cathédrale, vous pourrez apercevoir des vendeurs ambulants proposant des objets artisanaux et peut-être même un musicien jouant de la flûte. Et si vous avez de la chance, vous pourriez voir un petit groupe de pigeons perchés sur la statue de Saint Vincent de Paul, ou un chat errant dans l'allée.C'est un endroit magique qui mérite vraiment une visite !",
    //     imageLink: '../Images/search/cathedraleTunis.jpg',
    //     likesNumber: 20,
    // },
    // {
    //     postId: 5,
    //     profileUserName: "Sarra",
    //     profileImage: "../Images/user.png",
    //     date: "2023-04-14",
    //     time: "10:30",
    //     gouvernorat: 'Tozeur',
    //     place: 'Chat Jerid',
    //     title: "À la découverte de Chat Jerid",
    //     description: "Chat Jerid est un lieu fascinant au cœur du désert tunisien. C'est un endroit où vous pouvez vous détendre, vous ressourcer et vous connecter avec la nature. La beauté de Chat Jerid est inégalée, avec ses eaux turquoise entourées de roches dorées. J'ai eu la chance de visiter Chat Jerid et de découvrir sa faune et sa flore incroyables. J'ai vu des flamants roses, des oiseaux exotiques et des plantes uniques que je n'avais jamais vues auparavant. Mais ce qui m'a le plus marqué, c'est la sérénité et la paix qui règnent dans cet endroit magique. Si vous cherchez un lieu de détente et de découverte, ne manquez pas Chat Jerid lors de votre prochain voyage en Tunisie!",
    //     imageLink: '../Images/search/chat-jerid.jpg',
    //     likesNumber: 25,
    // },
    // {
    //     postId: 6,
    //     profileUserName: "Aziz",
    //     profileImage: "../Images/user.png",
    //     date: "2022-08-19",
    //     time: "19:30",
    //     gouvernorat: "Sfax",
    //     place: "la mer de Kerkennah",
    //     title: "Magique coucher de soleil sur la mer de Kerkennah",
    //     description: "J'ai assisté à l'un des plus beaux spectacles naturels de ma vie sur l'île de Kerkennah. Le soleil qui se couche à l'horizon de la mer, peignant le ciel de couleurs chaudes et chatoyantes, est tout simplement magique. Les reflets de la lumière sur l'eau créent un effet miroir hypnotisant qui vous transporte dans un autre monde. C'est comme si le temps s'arrêtait, et que vous ne pouviez rien faire d'autre que contempler cette beauté éphémère. Si vous êtes à la recherche d'un endroit paisible et magnifique pour vous ressourcer, Kerkennah est l'endroit parfait pour vous.",
    //     imageLink: "../Images/search/coucherDeSoleilKerkennah.jpg",
    //     likesNumber: 2500,
    // },
    // {
    //     postId: 7,
    //     profileUserName: "Aymen",
    //     profileImage: "../Images/user.png",
    //     date: "2022-02-14",
    //     time: "17:30",
    //     gouvernorat: 'Nabeul',
    //     place: 'Hawaria',
    //     title: 'Une belle journée à Hawaria',
    //     description: "Aujourd'hui, j'ai décidé de passer ma journée à Hawaria, et je ne regrette pas mon choix ! Cette petite ville côtière est l'endroit idéal pour se détendre et profiter du soleil. J'ai commencé ma journée par une petite balade le long de la plage, où j'ai pu admirer le magnifique paysage et me baigner dans l'eau turquoise. Ensuite, je me suis dirigée vers le marché local pour acheter des fruits frais et des produits artisanaux. J'ai été émerveillée par la gentillesse des habitants et la beauté des objets faits main. Pour finir ma journée en beauté, j'ai assisté à un magnifique coucher de soleil depuis la terrasse de mon hôtel. La vue sur la mer Méditerranée était à couper le souffle ! Si vous cherchez un endroit paisible et authentique en Tunisie, Hawaria est la destination qu'il vous faut.",
    //     imageLink: '../Images/search/hawaria.jpg',
    //     likesNumber: 20,
    // },
    // {
    //     postId: 8,
    //     profileUserName: "Aziz",
    //     profileImage: "../Images/user.png",
    //     date: "2022-05-25",
    //     time: "16:00",
    //     gouvernorat: 'Medenine',
    //     place: 'Île de Ras Rmal',
    //     title: "Une escapade paradisiaque à l'île de Ras Rmal à Djerba",
    //     description: "Je suis récemment allée à l'île de Ras Rmal à Djerba et j'ai été époustouflée par la beauté naturelle de cet endroit. Les eaux cristallines de la mer Méditerranée qui entourent l'île sont d'un bleu étincelant et les plages de sable blanc sont parfaites pour se détendre et profiter du soleil. J'ai adoré explorer les sentiers de randonnée de l'île qui offrent des vues incroyables sur la mer et la végétation luxuriante. Il y a même un petit village de pêcheurs sur l'île où vous pouvez déguster des fruits de mer frais.C'est un endroit idéal pour s'évader de la ville et se reconnecter avec la nature.",
    //     imageLink: '../Images/search/rasRmal.jpg',
    //     likesNumber: 5050,
    // }


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
                        <h6 class="post-username">${ post.ownerUsername }</h6>
                    </div>
                </div>


                <div class="post-description-text">
                    <p class="limited-text">${ post.description }</p>
                        <button class="show-more" onclick="showMore()">more</button>
                </div>
                <div class="post-footer">
                    <div class="like-button">
                        <img src="../public/assets/Images/empty_heart.png" alt="Like icon" >
                        <span style="font-size: 14px">${ post.likesCount}} likes</span>
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




function addLike(Id) {
    // if (likesNumber[Id] === 0) {
    //     likesNumber++;
    //     /*         let old_number = document.getElementById("likesCount").innerHTML;
    //             document.getElementById("likesCount").innerHTML = +old_number + 1; */
    //     postes[Id].likes = postes[Id].likes + 1;
    //
    // } else if (likesNumber[Id] === 1) {
    //     likesNumber--;
    //     let old_number = document.getElementById("likesCount").innerHTML;
    //     document.getElementById("likesCount").innerHTML = +old_number - 1;
    // }
    // var $likeIcon = document.querySelector('.like-button img');
    //
    // // Check the current src attribute value
    // if ($likeIcon.src.endsWith('empty_heart.png')) {
    //     // Update the src attribute to the new heart image
    //     $likeIcon.src = '../Images/heart.png';
    // } else {
    //     // Update the src attribute to the original heart image
    //     $likeIcon.src = '../Images/empty_heart.png';
    // }
}


/* //comment
let CLabel = $("#CommentLabel");
function CommentEvent() {
  let val = CLabel.val();
  if(val === "") {
    alert("Please enter a comment");
    return;
  }
  let i = document.createElement("li");
  i.className = "list-group-item";
  i.textContent = val;
  $("#CommentSection").append(i);
  CLabel.val("");
  //Send comment to relevent API
}
CLabel.on('keydown', function(e) {
  if(e.keyCode === 13) {
    CommentEvent();
  }
});
$(".CSubmit").click(CommentEvent); */

/*
//a function that adds a comment to the page
function addComment() {
    //get the value of the comment input
    const comment = document.getElementById('CommentLabel').value;
    //check if the comment input is empty
    if (comment == "") {
        //if it is, raise a warning
        alert("Please enter a comment");
    }
    else {
        //if it is not, add the comment to the page
        const element = document.getElementById('comment-section');
        element.innerHTML += `<li class="list-group-item">${comment}</li>`;
    }
}
//if the user finishes writing a comment, and hits enter, the comment is added to the page
document.getElementById('CommentLabel').addEventListener('keyup', function (event) {
    if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById('CSubmit').click();}
    });
     */
//
// $("#CommentLabel").on("keydown", function (e) {
//     if (e.keyCode === 13) {
//         alert("Enter key pressed");
//         // Enter key pressed
//         let searchTerm = $(this).val();
//         // Do something with the search term
//         alert("Search term entered: " + searchTerm);
//     }
// });
//

//-------------------------------------------------post description show more

//     function showMore() {
//     var text = document.getElementById("poste-txt");
//     var button = document.getElementById("show-more");
//     if (text.style.maxHeight) {
//     text.style.maxHeight = null;
//     button.innerHTML = "Show less";
// } else {
//     text.style.maxHeight = "20px";
//     button.innerHTML = "Show more";
// }
//     }
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
            comments[i].style.opacity="0";
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
               comments[i].style.opacity="100";
           }

    }
}
//
// $(document).ready(function() {
//     // Show or hide the back-to-top button
//     $(window).scroll(function() {
//         if ($(this).scrollTop() > 10000) {
//             $('.back-to-top').addClass('show');
//         } else {
//             $('.back-to-top').removeClass('show');
//         }
//     });
//
//     // Scroll to top when back-to-top button is clicked
//     $('.back-to-top').click(function(event) {
//         event.preventDefault();
//         $('html, body').animate({scrollTop: 0}, 1000);
//     });
// });

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
