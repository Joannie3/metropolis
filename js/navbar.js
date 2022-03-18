
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
