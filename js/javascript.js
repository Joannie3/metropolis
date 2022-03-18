let img__slider = document.getElementsByClassName('img__slider'); // getElementsByClassName permet de recuperer la liste des images qui a cette class en particulier

let etape = 0; // permet de savoir quelle image il faudra afficher
let nbr__img = img__slider.length; //permet de savoir combien il y aura d"image a traiter dans notre "tableau"

let description = document.getElementsByClassName("img__description");
let nbr__description = description.length; //permet de savoir combien il y aura d"image a traiter dans notre "tableau"

let precedent = document.querySelector('.precedent'); // ici on recupere la class .precedent
let suivant = document.querySelector('.suivant'); // ici on recupere la class .suivant

console.log("nbr__img");
console.log(nbr__img);

// il faut une fonction pour supprimer le style active sur toutes les images 
function enleverActiveImages()
{
    // on fait une boucle pour traiter toutes les images une a une
    for(let i = 0 ; i < nbr__img ; i++)
    {
        img__slider[i].classList.remove('active'); // pour image courante, image inspecter par la boucle et on enleve la class active sur toutes les images
    }
    for(let i = 0 ; i < nbr__description ; i++)
    {
        description[i].classList.remove('active'); // pour image courante, image inspecter par la boucle et on enleve la class active sur toutes les images
    }
}


suivant.addEventListener('click', function() {
    etape++;
    if (etape >= nbr__img) { etape = 0; }
    enleverActiveImages(); // ici on supprime la propriete active sur toutes les images
    img__slider2[etape].classList.add('active');
    description2[etape].classList.add('active');
})

precedent.addEventListener('click', function() {
    etape--;
    if (etape < 0 ){ etape = nbr__img -1; }
    enleverActiveImages(); // ici on supprime la propriete active sur toutes les images
    img__slider[etape].classList.add('active');
    description[etape].classList.add('active');
})

setInterval(function ()
{
    etape++;
    if (etape >= nbr__img) { etape = 0; }
    enleverActiveImages(); // ici on supprime la propriete active sur toutes les images
    img__slider[etape].classList.add('active');
    description[etape].classList.add('active');
}, 3000)


// Ici on commence le carrousel

function setupCarrousel(carrousel){

var suivant2 = carrousel.getElementsByClassName("suivant2")[0];
var precedent2 = carrousel.getElementsByClassName("precedent2")[0];

var conteneurcarrousel = carrousel.getElementsByClassName("conteneurcarrousel")[0]; // ici on change juste conteneurcarrousel en conteneurcarrousel2 conteneurcarrousel3 etc

var img__carrousel = conteneurcarrousel.getElementsByClassName("img__carrousel");
var nb_imagec = img__carrousel.length;

console.log(img__carrousel);

var desc_film_c = carrousel.getElementsByClassName('desc_film_c');

var nombredefilm = desc_film_c.length; //permet de savoir combien il y aura d"image a traiter dans notre "tableau"
// console.log(a);
//     console.log(getComputedStyle(desc_film_c[a]).display);


var desc_film_c = document.getElementsByClassName('desc_film_c');
var nombredefilm = desc_film_c.length; //permet de savoir combien il y aura d"image a traiter dans notre "tableau"
// console.log(a);
//     console.log(getComputedStyle(desc_film_c[a]).display);



// quand je clique sur la fleche droite alors je déduis (suivant)
suivant2.addEventListener("click", () => {


    ////////////////////////////////////////////////////////////////////////////////////////
    ////  PERMET DE FERMER UNE FENETRE DE DESCRIPTION QUAND ON CLIQUE SUR LA FLECHE   //////
    ////////////////////////////////////////////////////////////////////////////////////////
    for (var i=0 ; i < nombredefilm ; i++)
{
    console.log("i");  console.log(i);
desc_film_c[i].style.display = 'none';  
}

    ////////////////////////////////////////////////////////////////////////////////////////////
    //// FIN PERMET DE FERMER UNE FENETRE DE DESCRIPTION QUAND ON CLIQUE SUR LA FLECHE   //////
    ///////////////////////////////////////////////////////////////////////////////////////////

     // ici on fait le nombre d'image * largeur (getComputedStyle(img__carrousel[0]).width) + 15 de marge soit 30
     var largeurImage = parseInt(getComputedStyle(img__carrousel[0]).width); // permet de recuperer la largeur d'une image automatiquement

     // parseFloat permet de recuperer les chiffres uniquement
     var largeurMarge = parseInt(getComputedStyle(img__carrousel[0]).margin); // permet de recuperer la largeur d'une marge automatiquement

     console.log(getComputedStyle(conteneurcarrousel).transform);

    // le moins ? = il cherche p-e le moins mais pas forcement
    // \d = [0-9] moyen plus rapide
    // + = un chiffre (0 est un chiffre pas null !)
    var maValeurTranslate =  
    Number(getComputedStyle(conteneurcarrousel).transform.match(/matrix\(1,\s0,\s0,\s1,\s(\-?\d+),\s0\)/)[1]) - (largeurImage + ( 2 * largeurMarge)+20) ;

  
       // permet de trouver la largeur de mon image.
    // console.log(getComputedStyle(img__carrousel[0]).width);


    var totalLargeurPhoto = (nb_imagec * largeurImage) + ((nb_imagec-1) * (largeurMarge * 2));
 
    var largeurContainerCarrousel = parseInt(getComputedStyle(conteneurcarrousel).width); 

// console.log("totallargeurphoto");
// console.log(totalLargeurPhoto);

// console.log("largeurContainerCarrousel");
// console.log(largeurContainerCarrousel);


// console.log( totalLargeurPhoto- largeurContainerCarrousel);
// console.log(  Math.abs(maValeurTranslate)- largeurImage);

// console.log("maValeurTranslate");
// console.log(Math.abs(maValeurTranslate));

// console.log("largeurImage");
// console.log(largeurImage);

        if (totalLargeurPhoto - largeurContainerCarrousel < Math.abs(maValeurTranslate)- largeurImage) { 

            conteneurcarrousel.style.transform = "translateX(" + maValeurTranslate + "px)";

        }
})

// quand je clique sur la fleche gauche alors j'ajoute (precedent)
precedent2.addEventListener("click", () => {


    
    ////////////////////////////////////////////////////////////////////////////////////////
    ////  PERMET DE FERMER UNE FENETRE DE DESCRIPTION QUAND ON CLIQUE SUR LA FLECHE   //////
    ////////////////////////////////////////////////////////////////////////////////////////
    for (var i=0 ; i < nombredefilm ; i++)
{
    console.log("i2");  console.log(i);
desc_film_c[i].style.display = 'none';  
}

    ////////////////////////////////////////////////////////////////////////////////////////////
    //// FIN PERMET DE FERMER UNE FENETRE DE DESCRIPTION QUAND ON CLIQUE SUR LA FLECHE   //////
    ///////////////////////////////////////////////////////////////////////////////////////////

     // ici on fait le nombre d'image * largeur (getComputedStyle(img__carrousel[0]).width) + 15 de marge soit 30
     var largeurImage = parseInt(getComputedStyle(img__carrousel[0]).width); // permet de recuperer la largeur d'une image automatiquement

     // parseFloat permet de recuperer les chiffres uniquement
     var largeurMarge = parseInt(getComputedStyle(img__carrousel[0]).margin); // permet de recuperer la largeur d'une marge automatiquement

     console.log(getComputedStyle(conteneurcarrousel).transform);

    // le moins ? = il cherche p-e le moins mais pas forcement
    // \d = [0-9] moyen plus rapide
    // + = un chiffre (0 est un chiffre pas null !)
    var maValeurTranslate =  
    Number(getComputedStyle(conteneurcarrousel).transform.match(/matrix\(1,\s0,\s0,\s1,\s(\-?\d+),\s0\)/)[1]) + (largeurImage + ( 2 * largeurMarge)+20) ;
    // c'est pour recuperer ma valeur translateX

       // permet de trouver la largeur de mon image.
    // console.log(getComputedStyle(img__carrousel[0]).width);

    // var totalLargeurPhoto = (nb_imagec * largeurImage) + ((nb_imagec-1) * (largeurMarge * 2)); // toutes mes photos 

    // var largeurContainerCarrousel = parseInt(getComputedStyle(conteneurcarrousel).width);  // largeur de mon container carrousel

        if ( maValeurTranslate <= 45 ) { 

            conteneurcarrousel.style.transform = "translateX(" + maValeurTranslate + "px)";
        }

        console.log(maValeurTranslate);
        console.log("45");
   

   

})

}

for (const carrousel of document.getElementsByClassName('carrousel')) {

    setupCarrousel(carrousel);

 }



//  slider responsive 

let img__slider2 = document.getElementsByClassName('img__slider2'); // getElementsByClassName permet de recuperer la liste des images qui a cette class en particulier

let etape2 = 0; // permet de savoir quelle image il faudra afficher
let nbr__img2 = img__slider2.length; //permet de savoir combien il y aura d"image a traiter dans notre "tableau"

let description2 = document.getElementsByClassName("img__description2");
let nbr__description2 = description2.length; //permet de savoir combien il y aura d"image a traiter dans notre "tableau"

let precedent3 = document.querySelector('.precedent3'); // ici on recupere la class .precedent
let suivant3 = document.querySelector('.suivant3'); // ici on recupere la class .suivant


// il faut une fonction pour supprimer le style active sur toutes les images 
function enleverActiveImages2()
{
    // on fait une boucle pour traiter toutes les images une a une
    for(let i = 0 ; i < nbr__img2 ; i++)
    {
        img__slider2[i].classList.remove('active'); // pour image courante, image inspecter par la boucle et on enleve la class active sur toutes les images
    }
    for(let i = 0 ; i < nbr__description2 ; i++)
    {
        description2[i].classList.remove('active'); // pour image courante, image inspecter par la boucle et on enleve la class active sur toutes les images
    }
}


suivant3.addEventListener('click', function() {
    etape2++;
    if (etape2 >= nbr__img2) { etape2 = 0; }
    enleverActiveImages2(); // ici on supprime la propriete active sur toutes les images
    img__slider2[etape2].classList.add('active');
    description2[etape2].classList.add('active');
})

precedent3.addEventListener('click', function() {
    etape2--;
    if (etape2 < 0 ){ etape2 = nbr__img2 -1; }
    enleverActiveImages2(); // ici on supprime la propriete active sur toutes les images
    img__slider2[etape2].classList.add('active');
    description2[etape2].classList.add('active');

})

setInterval(function ()
{
    etape2++;
    if (etape2 >= nbr__img2) { etape2 = 0; }
    enleverActiveImages2(); // ici on supprime la propriete active sur toutes les images
    img__slider2[etape2].classList.add('active');
    description2[etape2].classList.add('active');
}, 3000)




// navbar 
var navburger = document.getElementById("nav-burger");
var navburgerlist = document.getElementById("nav-burger-list");

navburger.addEventListener("click", () => {

    if (getComputedStyle(navburgerlist).display  == "none")
    {
        navburgerlist.style.display  = "block";
    }
    else {
        navburgerlist.style.display  = "none";
    }
    
})

// fin de ma navbar

// debut pour afficher mes commentaires
// var image_films_c = document.getElementsByClassName('image_films_c');
// var desc_film_c = document.getElementsByClassName('desc_film_c');

// var image_films_c2 = document.getElementsByClassName('image_films_c')[0];
// var desc_film_c2 = document.getElementsByClassName('desc_film_c')[0];

// var nombredefilm = image_films_c.length; //permet de savoir combien il y aura d"image a traiter dans notre "tableau"


// for (var i=0 ; i < nombredefilm ; i++)
// {
// console.log("desc film display");
// console.log(getComputedStyle(desc_film_c[i]).display);

// image_films_c[i].addEventListener('click', function() {
// if (getComputedStyle(desc_film_c[i]).display  =='none')
// {
//     desc_film_c[i].style.display = 'block';
// }
// else {
//     desc_film_c[i].style.display = 'none';
// }
// })

// }



function desFilms(a){

    var desc_film_c = a.parentElement.getElementsByClassName('desc_film_c')[0];

    var desc_film_ctous = document.getElementsByClassName('desc_film_c');

    var nombredefilm = desc_film_ctous.length; //permet de savoir combien il y aura d"image a traiter dans notre "tableau"
        // console.log(a);
        //     console.log(getComputedStyle(desc_film_c[a]).display);


if (getComputedStyle(desc_film_c).display  =='none')
{
    
for (var i=0 ; i < nombredefilm ; i++)
{
    desc_film_ctous[i].style.display = 'none';  
}
    desc_film_c.style.display = 'block'; 
}
else {
    desc_film_c.style.display = 'none';
}

}


    ////////////////////////////////////////////////////////////////////////////////////////
    ////                                  SYSTEME ETOILES               //////
    ////////////////////////////////////////////////////////////////////////////////////////


    