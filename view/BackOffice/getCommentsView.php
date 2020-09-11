<section>
  <div class="container">
    <div class="jumbotron text-center" id="FormContactTitle">            
            <h1 class="jumbotron-heading">LISTE DES COMMENTAIRES</h1>                   
        </div>          
    <table class="table table-bordered table-striped table-condensed" id="listComments">      
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
          $date = new DateTime($data['comment_date']);
          $dateFR = $date->format('d/m/Y');
          if ($data['isValide'] == 1)
          {
      ?>
        <tr class="table-success">
          <td><?= $data['pseudo']?></td>              
          <td><?= $dateFR ?></td>
          <td><?= $data['comment']?></td>
          <td><?= $data['title']?></td>              
        </tr>
        <?php
        }
        else
        {
        ?>
        <tr class="table-danger">        
          <td><?= $data['pseudo']?></td>
          <td><?= $dateFR ?></td>
          <td><?= $data['comment']?></td>
          <td><?= $data['title']?></td>
          <td><a href="backoffice/deleteComment/<?= $data['id'] ?>/#ancrePrincipale"><img src="public/images/Supprimer.png"></a><a href="backoffice/validateComment/<?= $data['id'] ?>/#ancrePrincipale"><img src="public/images/Valider.png"></a></td>
        </tr>
      <?php
      }
      }
      ?>      
      </tbody>
    </table>
  </div>
</section>