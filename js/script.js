
// des que ma page est chargé alors je fais ce qui est dans mes accolades
window.onload = () => {

        // on va chercher toutes les etoiles
        const stars = document.querySelectorAll(".la-star");
        
        // on va cherche notre input soit la note on prend notre ID
        const note = document.querySelector("#note");

        // on va boucler sur les etoiles pour leur ajouter un ecouteurs d'evenements
        // ecouteur evenement = Permet de savoir qu'on va cliquer dessus ou survoler

        for (star of stars){

                // on fait en sorte de coloré en rouge les etoiles au moment du survole
                star.addEventListener("mouseover", function(){
                    resetStars();
                    this.style.color = "red";
                    this.classList.add("las");
                    this.classList.remove("lar");

                    // c'est l'element precedent  du meme niveau donc les etoiles précedentes. ou balise soeurs
                    let previousStar = this.previousElementSibling;

                    // on passe l'etoile qui precede en rouge et on le fais tant qu'il y a une etoile avant
                    while (previousStar){
                    previousStar.style.color = "red";
                    previousStar.classList.add("las");
                    previousStar.classList.remove("lar");
                    previousStar = previousStar.previousElementSibling;
                    }
                });

                // ici on fait un evenement sur le click
                star.addEventListener("click", function(){
                    // note.value c notre input
                        note.value = this.dataset.value;
                        // dataset va cherche la valeur de la data
                });

                // on remet en noir les etoiles ou on a pas cliquer
                star.addEventListener("mouseout", function(){
                    resetStars(note.value);
                });
            }

            //  ici on repasse toutes les etoiles en white au moment ou je passe ma souris sur une etoile
            function resetStars(note = 0){
                for (star of stars)
                {
                    if (star.dataset.value > note){
                        star.style.color = "white";
                        star.classList.add("lar");
                        star.classList.remove("las");
                    }
                    else { star.style.color = "red";
                            star.classList.add("las");
                            star.classList.remove("lar");
                }
                    
                }
                
            }

}

