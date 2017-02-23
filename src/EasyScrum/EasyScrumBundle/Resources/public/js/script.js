$(document).ready(function(){

  $('#connexion').click(function(){
       // variable défini dans default/index.html
    $("body").html("<img id='loadingDiv' src='"+urlLoader+"'/>").load(urlConnexion);
  });
  $('#inscription').click(function(){
      // variable défini dans default/index.html
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

 $("#content").on('click','#listAffichage', function(){
 });

 /* Affichage des releases en colonne onclick sur une div d'un projet*/

 $("#content").on('click','#projetBlock',function(){
   urlReleases = $(this).children('.hidden_url').text();
   console.log(urlReleases);
    $.ajax({
      method : "POST",
      url : urlReleases,

      success: function(){
        $("#content").html("<img id='loadingDiv' src='"+urlLoader+"'/>").load(urlReleases);
      }

    });
 });
 $("#content").on('click','#projetBlock',function(){
   project_id =  $(this).children('.hidden_id').text();
   console.log(project_id);
   //utilisation de l'id dans releaseCreateView
   //Ajout d'un input hidden afin de pouvoir récupérer l'id du projet parent de la release et le passer au controlleur avec la variable POST
 });


 //Toggle the description of a release à modifier

 $('#content').on('click', '.dropDownDescription', function() {
  var toggleDiv = $(this).parents(".releaseColonne").children(".toggleDivDesc");
   releaseDesc = toggleDiv.children(".releaseRecap");
  console.log(releaseDesc.text());
  if( releaseDesc.text() == ""){
    releaseDesc.text("Aucune description n'est enregistrée");
    releaseDesc.css("font-style", "italic");
  }
  toggleDiv.slideToggle(50);
 });



 $('#content').on('click','#plusCreateSprint', function(){
   release_id = $(this).parents(".releaseName").children('.hidden_release_id').text();
   console.log(release_id);
   if(!$('#hidden_input_release_id').length){
       $('#create_sprint').append('<input type="text" id="hidden_input_release_id" name="release_id" value="'+ release_id +'">');
   } else {
      $('#hidden_input_release_id').val(release_id);
   }
 });

 $('#content').on('click','.archiveProject',function(){

   // récupérer id du projet
   projectToarchive_id = $(this).parents('.divProject').children('#projetBlock').children('.hidden_id').text();
   console.log(projectToarchive_id);
   // Mettre la div en visibility : none

   // Dans le controleur Récupérer le projet
   //update dans la base de donnée : attribut active en true
   //
 });
$('#content').on('click', '#archiveIcon', function(){
  console.log("coucou");
  $('#content').load(urlArchivedProjects);

});
$('#content').on('click', '.editIcon', function(){
  var current_name = $(this).parents('#projetNom').children('.pName').text();
  var current_description= $(this).parents('.divProject').children('#projetBlock').children('#projetRecap').text();
  $('#edit_project_nom').val(current_name);
  $('#edit_project_description').val(current_description);

  projectToEdit_id = $(this).parents('.divProject').children('#projetBlock').children('.hidden_id').text();

  if(!$('.hidden_input_project_id').length){
      $('#formEditProjectContent').append('<input type="text" class="hidden_input_project_id" name="projectToEdit_id" value="'+ projectToEdit_id +'">');
  } else {
     $('.hidden_input_project_id').val(projectToEdit_id);
  }

});


});
