<section>
	<div class="container">
		<div class="jumbotron text-center" id="FormContactTitle">
			<h1 class="jumbotron-heading">LISTE DES POSTS</h1>
		</div>
		<table class="table table-bordered table-striped table-condensed" id="listComments">
			<thead>
				<tr>
					<th>Auteur</th>
					<th>Date</th>
					<th>titre</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($posts as $post) {
				?>
					<tr>
						<td><?= $post->pseudo() ?></td>
						<td><?= $post->creationDate() ?></td>
						<td><?= $post->title() ?></td>
						<td>
							<button type="button" class="btn" data-toggle="modal" data-target="#deletePost<?= $post->id();
																											$this->sanitize($post->title()); ?>"><img src="public/images/Supprimer.png"></button>
							<button type="button" class="btn" data-toggle="modal" data-target="#modifyPost<?= $post->id();
																											$this->sanitize($post->title());
																											$this->sanitize($post->content()); ?>"><img src="public/images/Valider.png"></button>
						</td>
					</tr>
					<!--Popup de confirmation suppression de post-->
					<div class="modal fade" role="dialog" id="deletePost<?= $post->id();
																		$post->title(); ?>">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Confirmez-vous la suppression du post : <?= $post->title() ?> </h4>
								</div>
								<div class="modal-body">
									<button type="button" onclick="window.location.href='backoffice/deletePost/<?= $post->id() ?>';" data-dismiss="modal">Confirmer</button>
									<button type="button" class="close" data-dismiss="modal">Annuler</button>
								</div>
							</div>
						</div>
					</div>
					<!--popup de modification du post-->
					<div class="modal" id="modifyPost<?= $post->id();
														$post->title();
														$post->content(); ?>">
						<div class="modal-dialog modal-lg">
							<!--Intégration du formulaire-->
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Modification d'un post</h4>
									<button type="button" class="close" data-dismiss="modal">x</button>
								</div>
								<div class="modal-body">
									<form action="backoffice/updatePost/<?= $post->id() ?>" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="title">Titre</label>
											<input type="text" class="form-control" name="title" id="title" value="<?= $post->title() ?>">
										</div>

										<div class="form-group">
											<label for="content">Contenu</label>
											<textarea class="form-control" name="content" id="content" rows="6"><?= $this->sanitize($post->content()); ?></textarea>
										</div>

										<div class="form-group">
											<label for="imgPost">Ajout d'une photo</label>
											<input type="file" class="form-control" name="imgPost" id="imgPost" value="" placeholder="Titre du post">
										</div>

										<div class="mx-auto">
											<button type="submit" class="btn btn-primary text-right">Modifier</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				<?php
				}
				?>


			</tbody>
		</table>
	</div>
</section>