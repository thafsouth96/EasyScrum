$(document).ready(function(){

  $('#connexion').click(function(){
      $(location).attr('href','http://localhost/Symfony/web/app_dev.php/login');
  });
  $('#inscription').click(function(){
     $(location).attr('href','http://localhost/Symfony/web/app_dev.php/register');
  });

  $(function(){
   $(window).scroll(function () {//Au scroll dans la fenetre on déclenche la fonction
      if ($(this).scrollTop() > 80) { //si on a défilé de plus de 80px du haut vers le bas
          $('#navigation').addClass("fixNavigation"); //on ajoute la classe "fixNavigation" à <div id="navigation">
      } else {
      $('#navigation').removeClass("fixNavigation");//sinon on retire la classe "fixNavigation" à <div id="navigation">
      }
   });
 });

 /* Modification de la page de connexion */
/*var divUserOpen = $('<div id="userDiv">') ;
var divPassword = $('<div id="PasswordDiv">');
var divRemember = $('<div id="rememberDiv">');
var divClosed = $('</div>');

$('label[for=username]').prepend(divUserOpen);
$('#username').append(divClosed) ;

$('label[for=password]').prepend(divPassword);
$('#password').append(divClosed);

$('#remember_me').prepend(divRemember);
$('label[for="remember_me"]').append(divClosed);

*/


});
