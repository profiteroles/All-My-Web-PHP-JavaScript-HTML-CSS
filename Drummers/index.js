document.addEventListener("keypress",function () {
    makeSound(event.key);
    btnAnima(event.key);
});

var sndCrash = new Audio("sounds/crash.mp3");
var sndKick = new Audio("sounds/kick-bass.mp3");
var sndSnare = new Audio("sounds/snare.mp3");
var sndTom1 = new Audio("sounds/tom-1.mp3");
var sndTom2 = new Audio("sounds/tom-2.mp3");
var sndTom3 = new Audio("sounds/tom-3.mp3");
var sndTom4 = new Audio("sounds/tom-4.mp3");

for (let i = 0; i < document.querySelectorAll("button").length; i++) {
    document.querySelectorAll("button")[i].addEventListener("click",function () {
        makeSound(this.innerHTML);
        btnAnima(this.innerHTML);
    } );
}

function makeSound(key) {
    switch (key) {
        case "a":
            sndTom1.play();
            break;
            case "s":
                sndTom2.play();
            break;
            case "d":
                sndTom3.play();
            break;
            case "f":
                sndTom4.play();
            break;
            case "j":
                sndSnare.play();
            break;
            case "k":
                sndKick.play();
                this.style.color = "blue";
            break;
            case "l":
                sndCrash.play();
                this.style.color = "white";
            break;
    
        default:
            console.log("WRONG BUTTON PRESSED");
    }
}

function btnAnima(key){
    var activeButton = document.querySelector("." + key);
    activeButton.classList.add("pressed");
    setTimeout(function () {
        activeButton.classList.remove("pressed");
    }, 100);
}