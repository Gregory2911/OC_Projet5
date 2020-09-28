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
        foreach ($comments as $comment) {
          $dateFR = $this->sanitize($comment->commentDate());
          if ($comment->isValide() == 1) {
        ?>
            <tr class="table-success">
              <td><?= $comment->pseudo() ?></td>
              <td><?= $dateFR ?></td>
              <td><?= $this->sanitize($comment->content()) ?></td>
              <td><?= $this->sanitize($comment->postTitle()) ?></td>
            </tr>
          <?php
          } else {
          ?>
            <tr class="table-danger">
              <td><?= $this->sanitize($comment->pseudo()) ?></td>
              <td><?= $dateFR ?></td>
              <td><?= $this->sanitize($comment->content()) ?></td>
              <td><?= $this->sanitize($comment->postTitle()) ?></td>
              <td><a href="backoffice/deleteComment/<?= $comment->id() ?>/#ancrePrincipale"><img src="public/images/Supprimer.png"></a><a href="backoffice/validateComment/<?= $comment->id() ?>/#ancrePrincipale"><img src="public/images/Valider.png"></a></td>
            </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</section>