<?php $this->title = 'Mon blog'; ?> <!--1. on definit le titre de la page dans $title. Celui ci sera intégré dans la balise <title> dans le template-->

<h1>Mon super blog !</h1>
    <p>Derniers billets du blog :</p>

    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </p>
    </div>

    <h2>Commentaires</h2>

    <?php
    while ($comment = $comments->fetch())
    {
    ?>
        <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?><a href="frontend/comment/<?= $comment['id'] ?>">Modifier</a></p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <?php
    }
    ?>

    <!-- ... -->

    <h2>Commentaires</h2>

    <form action="frontend/addComment/id=<?= $post['id'] ?>" method="post">            
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>
    