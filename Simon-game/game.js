
var gamePattern = [];
var userClickedPattern = [];
var buttonColours = ['red', 'blue', 'green','yellow'];
var snd = "sounds/";
var mp3 = ".mp3";
var wrnAudio = new Audio(snd+"wrong"+mp3);
var isKeyPressed = false;
var level = gamePattern.length+1;


$("h1").on("tap",function(){
    $(this).hide();
  });

$(document).keypress(function (e) { 
    if(!isKeyPressed){
        isKeyPressed= true;
        nextSequence();
    }
});


$(".btn").click(function () {
    var userChosenColour = $(this).attr("id");
    userClickedPattern.push(userChosenColour);
    

if(isKeyPressed){
    playSound(userChosenColour);
    animatedPress(userChosenColour);
    checkAnswer(userClickedPattern.length-1);
}
});

function nextSequence() {
    userClickedPattern = [];
    $("h1").text('Level ' + level);
    var randomNumber = Math.floor(Math.random() * 4);
    randomChosenColour = buttonColours[randomNumber];
    gamePattern.push(randomChosenColour);
    playSound(randomChosenColour);
    $('#' + randomChosenColour).fadeOut(100).fadeIn(100);
}

function playSound(name){
    var audio = new Audio(snd + name + mp3);
    audio.play();
}

function animatedPress(btn){
    $("." + btn).addClass("pressed").delay(100)
    .queue(function(next){
      $(this).removeClass('pressed');
      next();
    });
}

function checkAnswer(currentLevel) {
    if(gamePattern[currentLevel] == userClickedPattern[currentLevel] && isKeyPressed){
        if(gamePattern.length === userClickedPattern.length){
            setTimeout(function () {
                level++;
                nextSequence();
            }, 700);
        }
    }else{
        level =1 ;
        wrnAudio.play();
        startOver();
    }
  }
    

  function startOver(){
    gamePattern = [];
    isKeyPressed = false;
    
    $('h1').text('Game Over, Press Any Key to Restart');
    $(body).css('game-over').delay(200).queue(function (next) {
        $(this).removeClass('game-over');
        next();
    });


  }


  
