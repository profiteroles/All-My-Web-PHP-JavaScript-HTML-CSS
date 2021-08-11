$("#darkModeToggle").click(function(){
  if($('#darkModeToggle').is(':checked')){
    
    // $("tasks").addClass("dark-mode");
    // $("bottom-aside").addClass("dark-mode");
    // $("body").addClass("dark-mode");
    $('body').css('background-color', 'black');
  } else{
    $("#tasks").removeClass("dark-mode");
    $("body").removeClass("dark-mode");
  }
});
