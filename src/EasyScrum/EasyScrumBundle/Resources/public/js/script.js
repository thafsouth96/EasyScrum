$(document).ready(function(){


  $('#connexion').click(function(){
      $(location).attr('href','http://localhost/Symfony/web/app_dev.php/login');
  });
  $('#inscription').click(function(){
     $(location).attr('href','http://localhost/Symfony/web/app_dev.php/register');
  });

  $('#projetsClick').click(function(){
    $("#content").load(urlProjets);
    $('#menuVertical ul li a').removeClass("active");
    $(this).addClass("active");
  });

  $("#personnesClick").click(function(){
    $('#menuVertical ul li a').removeClass("active");
    $(this).addClass("active");
  });

  $("#codeClick").click(function(){
    $('#menuVertical ul li a').removeClass("active");
    $(this).addClass("active");
  });

  $("#docClick").click(function(){
    $('#menuVertical ul li a').removeClass("active");
    $(this).addClass("active");
  });

  $("#timeClick").click(function(){
    $('#menuVertical ul li a').removeClass("active");
    $(this).addClass("active");
  });

  $("#forumClick").click(function(){
    $('#menuVertical ul li a').removeClass("active");
    $(this).addClass("active");
  });

  $("#calendrierClick").click(function(){
    $('#menuVertical ul li a').removeClass("active");
    $(this).addClass("active");
  });

  $("#trackClick").click(function(){
    $('#menuVertical ul li a').removeClass("active");
    $(this).addClass("active");
  });

  $("#paramClick").click(function(){
    $('#menuVertical ul li a').removeClass("active");
    $(this).addClass("active");
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

 $("#content").on('click', '#plusCreate', function(){

   $.ajax({
     type : "POST",
     url: urlCreateProject,
     success: function(){
       $("#content").load(urlCreateProject);

     }
   });
 });

 $("#projects").on('click','#listAffichage', function(){
    //$("#content").load(urlProjetsList);
    //alert("coucou je fonctionne ") ;
 });

 // Traiter l'exception d'insertion d'un projet du meme nom

 /*$("#content").on('click','#createBtn',function(){
   $.ajax({
     url : urlCreateProject,
     dataType : 'json',
     success : function(){
       alert("Projet Créer");
     },
     error: function(){
       alert("Projet existant");
     }
   });
 });*/

});
