<?php $this->title = 'Mon blog';  //1. on definit le titre de la page dans $title. Celui ci sera intégré dans la balise <title> dans le template-->
//session_start();
?>
<h1>Mon super blog !</h1>
    <p>Derniers billets du blog :</p>

    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class="news">
        <h3>
            <?= $this->sanitize($post['title']); ?>
            <em>le <?= $post['creation_date_fr'] ?></em>
        </h3>
        
        <p>
            <?= nl2br($this->sanitize($post['content'])); ?>
        </p>
    </div>

    <h2>Commentaires</h2>

    <?php
    while ($comment = $comments->fetch())
    {        
    ?>
        <p><strong><?= $this->sanitize($comment['author']);?></strong> le <?= $this->sanitize($comment['comment_date_fr']); ?> 
        <?php
            //on affiche le bouton modifier un comment que si c'est l'utilisateur connecté est celui qui a posté le comment
            if (isset($_SESSION['id']))
            {
                if ($comment['member_id'] == $_SESSION['id'])
                {                        
            ?>
                <a href="frontend/comment/<?= $comment['id'] ?>">Modifier</a>
            <?php }} ?>
        </p>
        <p><?= nl2br($this->sanitize($comment['comment'])); ?></p>
    <?php
    }
    ?>

    <!-- ... -->

    <h2>Commentaires</h2>

    <form action="frontend/addComment/<?= $post['id'] ?>" method="post">            
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
    </form>
    