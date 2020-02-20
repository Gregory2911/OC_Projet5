<?php
//session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<base href="<?= $racineWeb ?>">
	<title><?= $title ?></title>
	<link href="public/bootstrap-4.3.1/bootstrap-4.3.1/dist/css/bootstrap.css" rel="stylesheet">
	<link href="public/style.css" rel="stylesheet">
</head>

<body data-spy="scroll" data-target="#essai">

	<!--Menu de navigation-->
	<nav id="essai" class="navbar navbar-light bg-light navbar-expand-lg sb-navbar sticky-top">
		<a class="navbar-brand" id="logo" href="frontend/listPosts">
			<!--<img src="header.png" alt="logo festival film plein air">-->
			<h1 id="sloganMenu"> | Grégory AGNAN | </h1>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<div class="navbar-nav ml-auto">
				<a class="nav-link" href="frontend/listPosts/#blog">Mon Blog</a>
				<a class="nav-link" href="#">A propos</a>
				<a class="nav-link" href="#">Mon parcours</a>							
				<a class="nav-link" href="contact/formContact/#formContact">Contact</a>
				<?php

					if (isset($_SESSION) && !empty($_SESSION['pseudo']))
					{
						echo '<p>Bonjour '. $this->sanitize($_SESSION['pseudo']) .' !</p>';
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
	 	<div class="container-fluid bouton">
	 		<div class="container">
		 		<div class="row">			 			
		 			<a href="#programmation" class="btn btn-lg btn-primary" data-toggle="popover" data-content="Programmation" id="btnProg"><img class="photoMenu" src="public/images/btn_prog.png" alt="programmation festival films plein air"/></a>
		 			<a data-toggle="modal" data-content="Inscription" id="btnInscription" href="#inscription" class="btn btn-lg btn-primary photoMenuInscription"><img class="photoMenu" src="public/images/btn_inscription.png" alt="inscription festival films plein air"/></a>
		 			<a href="#actualités" class="btn btn-lg btn-primary" data-toggle="popover" data-content="Actualités" id="btnNews"><img class="photoMenu" src="public/images/btn_news.png" alt="actualites festival films plein air"/></a>			 					 									
		 			<a href="#photos" class="btn btn-lg btn-primary" data-toggle="popover" data-content="Photos" id="btnPhoto"><img class="photoMenu" src="public/images/btn_photo.png" alt="photo festival film plein air"/></a>			
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
        			<form method="post" action="connexion/connexion">
        				<p>
	        				<label class="" for="login">login : </label>
	        				<input type="text" name="login" id="login" placeholder="login"/>
						</p>					        
	        			<p>
	        				<label class="" for="password">Mot de passe : </label>
        					<input type="text" name="password" id="password" placeholder="mot de passe"/>
						</p>			    
        				<p>
    						<input type="submit" value="Connexion">
        				</p>        					
       				</form>
       				<button data-toggle="modal" href="#inscription" class="btn btn-primary inscription" id="suivant">Inscription</button>       				
	      		</div>
	    	</div>
	  	</div>
	 </div>

	 <!--Popup d'inscription'-->
  	<div class="modal" id="inscription">
  		<div class="modal-dialog"> <!--Intégration du formulaire-->
    		<div class="modal-content">
      			<div class="modal-header">							        
        			<h4 class="modal-title">Inscription</h4>
        			<button type="button" class="close" data-dismiss="modal">x</button>
      			</div>
     			<div class="modal-body">
        			<form method="post" action="connexion/inscription">
        				<p>
	        				<label class="" for="prénom">Prénom : </label>
	        				<input type="text" name="prénom" id="prénom" placeholder="prénom"/>
						</p>					        						        			
	        			<p>
	        				<label class="" for="nom">Nom : </label>
	        				<input type="text" name="nom" id="nom" placeholder="Nom"/>
						</p>					        
	        			<p>
	        				<label class="sr-only" for="email">Adresse Email</label>
	        				<input type="email" name="email" id="email" placeholder="Email"/>
						</p>					        
        				<p>
	        				<label class="" for="login">login : </label>
	        				<input type="text" name="login" id="login" placeholder="login"/>
						</p>					        
	        			<p>
	        				<label class="" for="password">Mot de passe : </label>
        					<input type="text" name="password" id="password" placeholder="mot de passe"/>
						</p>			    
        				<p>
    						<input type="submit" value="Inscription">
        				</p>        					
       				</form>
       			</div>
       		</div>
       	</div>
	</div>								    
	
  	<?= $content ?>

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

 	

 	<footer>
 		<p>Grégory AGNAN</p>
 	</footer>

</body>

<script src="public/js/jquery-3.4.1.min.js"></script>

<script src="public/bootstrap-4.3.1/bootstrap-4.3.1/dist/js/bootstrap.bundle.min.js"></script>

<!--<script src="bootstrap-4.3.1/bootstrap-4.3.1/dist/js/bootstrap.js"></script>-->

<script>
	$(function (){
		$("#btnProg").popover({placement:'bottom',trigger:'hover'}); 
		$("#btnPhoto").popover({placement:'bottom',trigger:'hover'}); 
		$("#btnInscription").popover({placement:'bottom',trigger:'hover'});
		$("#btnNews").popover({placement:'bottom',trigger:'hover'});  
	});
	
	$("#suivant").click(function() {
		$('#connexion').modal('hide');
		//$('#inscription').modal('show');		
	});

</script>
</html>