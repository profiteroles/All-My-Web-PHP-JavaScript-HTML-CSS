$("#darkModeToggle").click(function(){
  if($('#darkModeToggle').is(':checked')){
    $('body').css('background-color', 'black');
  } else if(!$('#darkModeToggle').is(':checked')){
    $('body').css('background-color', 'chocolate');
  }
});

function toggleTheme(time) {
  var sheets= document.getElementsByTagName('link');
      return sheets[0].href = 'css/'+ time+ '.css'
}