<?php
//include("menuBackOffice.php");
?>

<div class="container" id="formContact">



	<section class="jumbotron text-center">
		<div class="container">
			<h1 class="jumbotron-heading">AJOUT D'UN POST</h1>
		</div>
	</section>


	<div class="row" id="formContact">
		<div class="col">
			<form action="backoffice/addPost" method="post" enctype="multipart/form-data" class="form-horizontal col-lg-12">
				<div class="form-group">
					<label for="title">Titre</label>
					<input type="text" class="form-control" name="title" id="title" value="" placeholder="Titre du post">
				</div>

				<div class="form-group">
					<label for="châpo">Châpo</label>
					<input type="text" class="form-control" name="châpo" id="châpo" value="" placeholder="Châpo du post">
				</div>

				<div class="form-group contentFormTextArea">
					<label for="content">Contenu</label>
					<textarea class="form-control contentFormTextArea" name="content" id="content" rows="6" placeholder="Contenu du post"></textarea>
				</div>

				<div class="form-group">
					<label for="imgPost">Ajout d'une photo</label>
					<input type="file" class="form-control" name="imgPost" id="imgPost" value="" placeholder="Titre du post">
				</div>

				<div class="mx-auto">
					<button type="submit" class="btn btn-primary float-right">Enregistrer</button>
				</div>
			</form>
		</div>
	</div>

</div>