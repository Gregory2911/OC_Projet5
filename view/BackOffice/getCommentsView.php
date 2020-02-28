<table class="table table-bordered table-striped table-condensed">
  <caption>
  <h4>Liste des commentaires</h4>
  </caption>
  <thead>
    <tr>
      <th>Auteur</th>
      <th>Date</th>
      <th>Commentaire</th>
      <th>Post</th>
      <th></th>
    </tr>
  </thead>
    <tbody>
      <?php
        while ($data = $comments->fetch())
        {
          if ($data['isValide'] == 1)
          {
          ?>
            <tr class="table-success">
              <td><?= $data['pseudo']?></td>
              <td><?= $data['comment_date']?></td>
              <td><?= $data['comment']?></td>
              <td><?= $data['title']?></td>              
          <?php
          }
          else
          {
          ?>
            <tr class="table-danger">        
              <td><?= $data['pseudo']?></td>
              <td><?= $data['comment_date']?></td>
              <td><?= $data['comment']?></td>
              <td><?= $data['title']?></td>
              <td><a href="backoffice/deleteComment/<?= $data['id'] ?>"><img src="view/images/Supprimer.png"></a><a href=""><img src="view/images/Valider.png"></a></td>
          <?php
          }
        }
      ?>      
    </tbody>
</table>