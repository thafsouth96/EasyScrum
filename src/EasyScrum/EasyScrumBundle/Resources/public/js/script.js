$(document).ready(function(){

  //Modifier le href
  $('#connexion').click(function(){
       // variable défini dans default/index.html
      //$(location).attr('href','http://localhost/Symfony/web/app_dev.php/login');
    $("body").html("<img id='loadingDiv' src='"+urlLoader+"'/>").load(urlConnexion);
  });
  $('#inscription').click(function(){
      // variable défini dans default/index.html
     //$(location).attr('href','http://localhost/Symfony/web/app_dev.php/register');
     $("body").html("<img id='loadingDiv' src='"+urlLoader+"'/>").load(urlInscription);
  });


  $('#projetsClick').click(function(){
    $("#content").html("<img id='loadingDiv' src='"+urlLoader+"'/>").load(urlProjets);
    $('#menuVertical ul li a').removeClass("active");
    $(this).addClass("active");
  });

  $("#personnesClick").click(function(){

    $("#content").html("<img id='loadingDiv' src='"+urlLoader+"'/>").load(urlTeamShow);
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

 $("#content").on('click', '#plusCreateProjet', function(){

   $.ajax({
     type : "POST",
     url: urlCreateProject,
     success: function(){
       //$("#content").load(urlCreateProject);

     }
   });
 });

 $("#content").on('click', '#plusCreateEquipe', function(){

   $.ajax({
     type : "POST",
     success: function(){
       //$("#content").load(urlCreateEquipe);

     }
   });
 });
 $("#content").on('click','#listAffichage', function(){
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

 /* Affichage des releases en colonne onclick sur une div d'un projet*/

 $("#content").on('click','#projetBlock',function(){
   urlReleases = $(this).children('.hidden_url').text();
    /*projectName = $('#projetNom').text();
    alert(projectName) ;*/
    $.ajax({
      method : "POST",
      url : urlReleases,

      success: function(){
        $("#content").html("<img id='loadingDiv' src='"+urlLoader+"'/>").load(urlReleases);
      }

    });
    //$("#content").load(urlReleases);
 });
 $('#formcreateP').submit(function(){

  /* $.ajax({
     type : $(this).attr('method'),
     url:$(this).attr('action'),
     data: $(this).serialize(),

   });
   $.done(function (data) {
            if (typeof data.message !== 'undefined') {
                alert(data.message);
            }
        })
        $.fail(function (jqXHR, textStatus, errorThrown) {
            if (typeof jqXHR.responseJSON !== 'undefined') {
                if (jqXHR.responseJSON.hasOwnProperty('form')) {
                    $('#form_body').html(jqXHR.responseJSON.form);
                }

                $('.form_error').html(jqXHR.responseJSON.message);

            } else {
                alert(errorThrown);
            }

        });*/


   });
 });
