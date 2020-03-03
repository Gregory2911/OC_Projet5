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
			<td><a href="backoffice/deletePost/<?= $data['id'] ?>"><img src="view/images/Supprimer.png"></a><a href="backoffice/modifyPost/<?= $data['id'] ?>/#connexion"><img src="view/images/Valider.png"></a></td>
		</tr>
	<?php
	  	}
    ?>              
    </tbody>
</table>
