<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<base href="<?= $racineWeb ?>">
	<title><?= $title ?></title>
	<link href="public/bootstrap-4.3.1/bootstrap-4.3.1/dist/css/bootstrap.css" rel="stylesheet">
	<link href="view/style.css" rel="stylesheet">
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: '#content'
		});
    </script>
</head>

<body data-spy="scroll" data-target="#essai">

	<!--Menu de navigation-->
	<nav id="mainNav" class="navbar navbar-light bg-light navbar-expand-lg sb-navbar sticky-top">
		<a class="navbar-brand" id="logo" href="frontend/listPosts">
			<!--<img src="header.png" alt="logo festival film plein air">-->
			<h1 id="sloganMenu"> | Grégory AGNAN | </h1>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<div class="navbar-nav ml-auto">
				<a class="nav-link" href="frontend/listPosts/#ancrePrincipale">Mon Blog</a>
				<a class="nav-link" href="#">A propos</a>
				<a class="nav-link" href="#">Mon parcours</a>							
				<a class="nav-link" href="#formContact">Contact</a>
				<?php

					if (isset($_SESSION) && !empty($_SESSION['pseudo']))
					{
						echo '<p id="helloMember">Bonjour '. $this->sanitize($_SESSION['pseudo']) .' !</p>';
						if ($_SESSION['isAdmin'] == 1)
						{
							echo '<a class="nav-link" href="backoffice/formPost">BackOffice</a>';
						}
						echo '<a class="nav-link" href="connexion/deconnexion">Deconnexion</a>';
					}
					else
					{
						echo '<a class="nav-link" data-toggle="modal" href="#connexion">Se connecter</a>';
					}					
				?>
				
			</div>
		</div>
	</nav>

	<!-- entête de page -->
  	<header>
		<!--photo entête accueil-->
	  	<div class="container-fluid" id="headerAccueil">		  		
			<div class="row d-none d-lg-block"  id="sloganHeader">
				<div class="offset-lg-6 col-lg-6">
					<h2>Grégory AGNAN</h2>
					<p>| Développeur PHP Symfony |
				</div>
			</div>		  		
	 	</div>

	 	<!--Boutons liens entête-->
	 	<div class="container-fluid bouton" id="ancrePrincipale">
	 		<div class="container">
		 		<div class="row">			 			
		 			<a href="frontend/listPosts/#ancrePrincipale" class="btnEntete" data-toggle="popover" data-content="Mon Blog" id="btnProg"><img class="photoMenu" src="view/images/blog_v2.png" alt="programmation festival films plein air"/></a>
		 			<a data-toggle="modal" data-content="Connexion" id="btnInscription" href="#connexion" class="btnEntete"><img class="photoMenu" src="view/images/connexion_v3.png" alt="inscription festival films plein air"/></a>
		 			<a href="#actualités" class="btnEntete" data-toggle="popover" data-content="Mon parcours" id="btnNews"><img class="photoMenu" src="view/images/CV_v2.png" alt="actualites festival films plein air"/></a>			 					 									
		 			<a href="#formContact" class="btnEntete" data-toggle="popover" data-content="Contact" id="btnPhoto"><img class="photoMenu" src="view/images/contact_v3.png" alt="photo festival film plein air"/></a>			
		 		</div>
	 		</div>
	 	</div>	 	
  	</header>

  	<!--Popup de connexion-->
  	<div class="modal" id="connexion">
  		<div class="modal-dialog"> <!--Intégration du formulaire-->
    		<div class="modal-content">
      			<div class="modal-header">							        
        			<h4 class="modal-title">Connexion</h4>
        			<button type="button" class="close" data-dismiss="modal">x</button>
      			</div>
     			<div class="modal-body">
        			<form id="formEssai" method="post" action="connexion/connexion" class="col-lg-12">
        				<div class="form-group row">
	        				<label class="col-lg-4 col-4" for="login">login : </label>
	        				<input class="col-lg-8 col-8" type="text" name="login" id="login" placeholder="login"/>
						</div>					        
	        			<div class="form-group row">
	        				<label class="col-lg-4 col-4" for="password">Mot de passe : </label>
        					<input class="col-lg-8 col-8" type="password" name="password" id="password" placeholder="mot de passe"/>
						</div>			            				
    					<button class="btn btn-primary float-right" type="submit">Se connecter</button>        				        				
       				</form>
       				<button data-toggle="modal" href="#inscription" class="btn btn-primary inscription" id="suivant">Inscription</button>       				
	      		</div>
	    	</div>
	  	</div>
	 </div>

	 <!--Popup d'inscription'-->
  	<div class="modal" id="inscription">
  		<div class="modal-dialog modal-lg"> <!--Intégration du formulaire-->
    		<div class="modal-content">
      			<div class="modal-header">							        
        			<h4 class="modal-title">Inscription</h4>
        			<button type="button" class="close" data-dismiss="modal">x</button>
      			</div>
      			
     			<div class="modal-body">     				     			
        			<form method="post" action="connexion/inscription" class="col-lg-12">        				
        				<div class="form-group row">
	        				<label class="col-lg-4 col-4 col-form-label" for="prénom">Prénom : </label>	        				
	        				<input class="col-lg-8 col-8" type="text" name="prénom" id="prénom" placeholder="Prénom"/>	        				
						</div>												
		        		<div class="form-group row">
	        				<label class="col-lg-4 col-4 col-form-label" for="nom">Nom : </label>	        				
	        				<input class="col-lg-8 col-8" type="text" name="nom" id="nom" placeholder="Nom"/>										       	        				
						</div>
	        			<div class="form-group row">
	        				<label class="col-lg-4 col-4 col-form-label" for="email">Adresse Email</label>
	        				<input class="col-lg-8 col-8" type="email" name="email" id="email" placeholder="Email"/>
						</div>        
        				<div class="form-group row">
	        				<label class="col-lg-4 col-4 col-form-label" for="login">login : </label>
	        				<input class="col-lg-8 col-8" type="text" name="login" id="login" placeholder="login"/>
						</div>					        
	        			<div class="form-group row">
	        				<label class="col-lg-4 col-5 col-form-label" for="password">Mot de passe : </label>
        					<input class="col-lg-8 col-7" type="password" name="password" id="password" placeholder="mot de passe"/>
						</div>			            				
    					<button class="btn btn-primary float-right" type="submit">S'insrire</button>    							
       				</form>       			       				
       			</div>
       			
       		</div>
       	</div>
	</div>
									   
	<?php
		if (isset($_SESSION['admin']) and $_SESSION['admin'] == 1)
		{
			include ('BackOffice/menuBackOffice.php');
		}
	?>
  	<?= $content ?>
 	
 	<div class="container" id="formContact">
	    <section class="jumbotron text-center" id="FormContactTitle">
	        <div class="container">
	            <h1 class="jumbotron-heading">FORMULAIRE DE CONTACT</h1>       
	        </div>
	    </section>
	    
	    <div class="row" id="formContact">
	            <div class="col">
	                <div class="card mb-4">
	                    <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Me contacter
	                    </div>
	                    <div class="card-body">
	                        <form action="contact/sendEmail" method="post">
	                            <div class="form-group">
	                                <label for="name">Nom</label>
	                                <input type="text" class="form-control" name="name" id="name" value="" placeholder="Votre nom">
	                            </div>
	                            <div class="form-group">
	                                <label for="email">Courriel</label>
	                                <input type="text" class="form-control" name="email" id="email" value="" placeholder="Votre courriel">

	                            </div>
	                            <div class="form-group">
	                                <label for="message">Message</label>
	                                <textarea class="form-control" name="message" id="message" rows="6" placeholder="Votre message"></textarea>
	                            </div>                            

	                            <div class="mx-auto">
	                            <button type="submit" class="btn btn-primary text-right">Envoyer</button></div>
	                        </form>
	                    </div>
	                </div>
	            </div>
	     </div>
	</div> 

	<!--Section coordonnées-->
 	<section id="coordonnées">	 		
 		<div class="container">
 			<h2 class="titreSection">Me contacter</h2>
	 		<div class="row">	 			
	 			<div class="col-lg-6">		 				
	 				<strong>Grégory AGNAN</strong>
	 				<p>01 impasse des jardins de coavou<br/>22980 Vildé Guingalan</p>
	 				<p>06 43 80 11 24</p>
	 				<p>
	 					<a href="mailto:contact@filmsdepleinair.org">contact@filmsdepleinair.org</a>
	 				</p>
	 			</div>
	 			<div class="col-lg-6">
	 				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.8735531366574!2d2.30676631580437!3d48.87968700716066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66fbe98f714c3%3A0xe62425fddeddc402!2sParc%20Monceau!5e0!3m2!1sfr!2sfr!4v1570031727777!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
	 			</div>
	 		</div>
	 	</div>
 	</section>

 	<!--<div class="col-lg-4">
		<form id="essai" class="form-inline well">
			<div class="form-group">
			  <label class="sr-only" for="text">Saisie</label>
			  <input id="text" type="text" class="form-control" placeholder="Texte ici">
			  <span class="help-block" style="display: none">Corrigez l'erreur s'il vous plait</span>
			</div>
			<button type="submit" class="btn btn-primary pull-right">Envoyer</button>		  	
		</form>
	</div>-->
		

 	<footer>
 		<p>Grégory AGNAN</p>
 	</footer>

</body>

<script src="public/js/jquery-3.4.1.min.js"></script>


<script src="public/bootstrap-4.3.1/bootstrap-4.3.1/dist/js/bootstrap.bundle.min.js"></script>
<!--<script src="public/bootstrap-4.3.1/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script>-->
<!--<script src="bootstrap-4.3.1/bootstrap-4.3.1/dist/js/bootstrap.js"></script>-->

		<script>
		  /*$(function(){
		    $("form").on("submit", function() {
		      if($("#text").val().length < 4) {
		        $("div.form-group").addClass("has-error");
		        $("span.help-block").show("slow").delay(4000).hide("slow");
		        return false;
		      }
		    });
		  });*/
		</script>
<script>
	$(function (){
		$("a").popover({placement:'bottom',trigger:'hover'}); 
		$("#btnPhoto").popover({placement:'bottom',trigger:'hover'}); 
		$("#btnInscription").popover({placement:'bottom',trigger:'hover'});
		$("#btnNews").popover({placement:'bottom',trigger:'hover'});  
	});
	
	$("#suivant").click(function() {
		$('#connexion').modal('hide');
		//$('#inscription').modal('show');		
	});

	/*$(function(){
	    $("#essai").on("submit", function() {
	      if($("input").val().length < 4) {
	        $("div.form-group").addClass("has-error");
	        $("div.alert").show("slow").delay(4000).hide("slow");
	        return false;
	      }
	    });
	});*/

</script>
</html>