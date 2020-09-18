<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<base href="<?= $this->sanitize($racineWeb) ?>">
	<title><?= $this->sanitize($title) ?></title>
	<link href="vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
	<link href="public/css/style.css" rel="stylesheet">
	<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		tinymce.init({
			selector: '#content'
		});
	</script>
</head>

<body data-spy="scroll" data-target="#essai">

	<!--topbar-->
	<div class="container-fluid">
		<div class="row" id="topbar">
			<div class="offset-lg-4 col-lg-4 btn_reseaux_sociaux">
				<a class="img_reseaux_sociaux" href="#"><img src="public/images/facebook.png" alt="facebook" /></a>
				<a class="img_reseaux_sociaux" href="https://www.linkedin.com/in/gr%C3%A9gory-agnan-32165818b/" target="_blank"><img src="public/images/linkedin.png" alt="linkedin" /></a>
				<a class="img_reseaux_sociaux" href="#"><img src="public/images/git.png" alt="git" /></a>
			</div>
		</div>
	</div>

	<!--Menu de navigation-->
	<nav id="mainNav" class="navbar navbar-light bg-light navbar-expand-lg sb-navbar sticky-top">
		<a class="navbar-brand" id="logo" href="frontend/listPosts">
			<h1 id="sloganMenu"> | Grégory AGNAN | </h1>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<div class="navbar-nav ml-auto">
				<a class="nav-link" href="frontend/listPosts/#ancrePrincipale">Mon Blog</a>
				<a class="nav-link" href="#">À propos</a>
				<a class="nav-link" href="#formContact">Contact</a>
				<?php
				if (isset($_SESSION) && !empty($_SESSION['pseudo'])) {
					if ($_SESSION['isAdmin'] == 1) {
						echo '<a class="nav-link" href="backoffice/formPost">BackOffice</a>';
					}
				?>

					<div class="btn-group">
						<button id="helloMember" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<img src="public/images/avatar_menu.png">
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="connexion/deconnexion">Deconnexion</a>
						</div>
					</div>
				<?php
				} else {
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
			<div class="row d-none d-lg-block" id="sloganHeader">
				<div class="offset-lg-6 col-lg-6">
					<h2>Grégory AGNAN</h2>
					<p>| Développeur PHP Symfony |</p>
				</div>
			</div>
		</div>

		<!--Boutons liens entête-->
		<div class="container-fluid bouton" id="ancrePrincipale">
			<div class="container">
				<div class="row">
					<a href="frontend/listPosts/#ancrePrincipale" class="btnEntete" data-toggle="popover" data-content="Mon Blog" id="btnProg"><img class="photoMenu" src="public/images/blog_v2.png" alt="blog de Grégory AGNAN" /></a>
					<a data-toggle="modal" data-content="Connexion" id="btnInscription" href="#connexion" class="btnEntete"><img class="photoMenu" src="public/images/connexion_v3.png" alt="connexion" /></a>
					<a href="../CV.pdf" target="_blank" class="btnEntete" data-toggle="popover" data-content="Mon parcours" id="btnNews"><img class="photoMenu" src="public/images/CV_v2.png" alt="cv de Grégory AGNAN" /></a>
					<a href="#formContact" class="btnEntete" data-toggle="popover" data-content="Contact" id="btnPhoto"><img class="photoMenu" src="public/images/contact_v3.png" alt="contact" /></a>
				</div>
			</div>
		</div>
	</header>

	<!--Popup de connexion-->
	<div class="modal" id="connexion">
		<div class="modal-dialog">
			<!--Intégration du formulaire-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Connexion</h4>
					<button type="button" class="close" data-dismiss="modal">x</button>
				</div>
				<div class="modal-body">
					<form id="formEssai" method="post" action="connexion/connexion" class="col-lg-12">
						<div class="form-group row">
							<label class="col-lg-4 col-4" for="login">login : </label>
							<input class="col-lg-8 col-8" type="text" name="login" id="login" placeholder="login" />
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-4" for="password">Mot de passe : </label>
							<input class="col-lg-8 col-8" type="password" name="password" id="password" placeholder="mot de passe" />
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
		<div class="modal-dialog modal-lg">
			<!--Intégration du formulaire-->
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Inscription</h4>
					<button type="button" class="close" data-dismiss="modal">x</button>
				</div>

				<div class="modal-body">
					<form method="post" action="connexion/inscription" class="col-lg-12">
						<div class="form-group row">
							<label class="col-lg-4 col-4 col-form-label" for="prénom">Prénom : </label>
							<input class="col-lg-8 col-8" type="text" name="prénom" id="prénom" placeholder="Prénom" />
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-4 col-form-label" for="nom">Nom : </label>
							<input class="col-lg-8 col-8" type="text" name="nom" id="nom" placeholder="Nom" />
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-4 col-form-label" for="email">Adresse Email</label>
							<input class="col-lg-8 col-8" type="email" name="email" id="email" placeholder="Email" />
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-4 col-form-label" for="login">login : </label>
							<input class="col-lg-8 col-8" type="text" name="login" id="login" placeholder="login" />
						</div>
						<div class="form-group row">
							<label class="col-lg-4 col-5 col-form-label" for="password">Mot de passe : </label>
							<input class="col-lg-8 col-7" type="password" name="password" id="password" placeholder="mot de passe" />
						</div>
						<button class="btn btn-primary float-right" type="submit">S'insrire</button>
					</form>
				</div>

			</div>
		</div>
	</div>

	<?php
	if (isset($_SESSION['admin']) and $_SESSION['admin'] == 1) {
		include('BackOffice/menuBackOffice.php');
	}
	?>

	<?= $content ?>

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
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<p>Grégory AGNAN</p>
				</div>
				<div class="col-lg-6">
					<a class="img_reseaux_sociaux_footer" href="#"><img src="public/images/facebook.png" alt="facebook" /></a>
					<a class="img_reseaux_sociaux_footer" href="https://www.linkedin.com/in/gr%C3%A9gory-agnan-32165818b/" target="_blank"><img src="public/images/linkedin.png" alt="linkedin" /></a>
					<a class="img_reseaux_sociaux_footer" href="#"><img src="public/images/git.png" alt="git" /></a>
				</div>
			</div>
		</div>
	</footer>

</body>

<script src="vendor/components/jquery/jquery.min.js"></script>


<!--<script src="public/bootstrap-4.3.1/bootstrap-4.3.1/dist/js/bootstrap.bundle.min.js"></script>-->
<!--<script src="public/bootstrap-4.3.1/bootstrap-4.3.1/dist/js/bootstrap.min.js"></script>-->
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script>
	$(function() {
		$("a").popover({
			placement: 'bottom',
			trigger: 'hover'
		});
		$("#btnPhoto").popover({
			placement: 'bottom',
			trigger: 'hover'
		});
		$("#btnInscription").popover({
			placement: 'bottom',
			trigger: 'hover'
		});
		$("#btnNews").popover({
			placement: 'bottom',
			trigger: 'hover'
		});
	});

	$("#suivant").click(function() {
		$('#connexion').modal('hide');
		//$('#inscription').modal('show');		
	});
</script>

</html>