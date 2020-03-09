<div class="container">
	<table class="table table-bordered table-striped table-condensed" id="listComments">
		<caption>
			<h4>Liste des posts</h4>
		</caption>
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
			while ($data = $posts->fetch())
	        {                   
		?>
			<tr>
				<td><?= $data['pseudo']?></td>
				<td><?= $data['creation_date_fr']?></td>
				<td><?= $data['title']?></td>			
				<td><a data-toggle = "modal" href="#deletePost"><img src="view/images/Supprimer.png"></a><a data-toggle ="modal" href="#modifyPost"><img src="view/images/Valider.png"></a></td>
			</tr>
			<!--Popup de confirmation suppression de post-->
			<div class="modal" id="deletePost">
				<div class="modal-dialog"> <!--Intégration du formulaire-->
					<div class="modal-content">
	  					<div class="modal-header">							        
	    					<h4 class="modal-title">Confirmez-vous la suppression du post : <?= $data['title'] ?> ?</h4>
	    				
	  					</div>
		 				<div class="modal-body">
		 					<button type="button" onclick="window.location.href='backoffice/deletePost/<?= $data['id'] ?>';" data-dismiss="modal">Confirmer</button>	
		    				<button type="button" class="close" data-dismiss="modal">Annuler</button>	
		      			</div>
	    			</div>
	  			</div>
	 		</div>
			<!--popup de modification du post-->
			<div class="modal" id="modifyPost">
				<div class="modal-dialog modal-lg"> <!--Intégration du formulaire-->
					<div class="modal-content">
	  					<div class="modal-header">							        
		    				<h4 class="modal-title">Modification d'un post</h4>
		    				<button type="button" class="close" data-dismiss="modal">x</button>
	  					</div>
		 				<div class="modal-body">
		    				<form action="backoffice/updatePost" method="post" enctype="multipart/form-data">
		                        <div class="form-group">
		                            <label for="title">Titre</label>
		                            <input type="text" class="form-control" name="title" id="title" value="<?=$data['title'] ?>">
		                        </div>

		                        <div class="form-group">
		                            <label for="content">Contenu</label>
		                            <textarea class="form-control" name="content" id="content" rows="6"><?=$data['content'] ?></textarea>
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



