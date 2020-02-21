<?php $this->title = 'Mon blog';  //1. on definit le titre de la page dans $title. Celui ci sera intégré dans la balise <title> dans le template-->
//session_start();
?>
<section class="container">             
    <h1 id="postTitle">
        <?= $this->sanitize($post['title']); ?>
    </h1>

        <p><a href="index.php">Retour à la liste des billets</a></p>

        <div class="news">
            <img src= "view/images/<?=$post['src_photo']?>" id="photoPost">
            <h3>
                <em>Posté le <?= $post['creation_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br($this->sanitize($post['content'])); ?>
            </p>
        </div>

        <h2><?php 
        $nbComments = $nbComments->fetch();?>            
        </h2>

        <?php
        while ($comment = $comments->fetch())
        {        
        ?>
            <div id="commentAuthor">
                <strong><?= $this->sanitize($comment['author']);?></strong>
            </div>
            <div id="commentDate">
                le <?= $this->sanitize($comment['comment_date_fr']); ?> 
            </div>
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

        <h2>Posté un commentaire</h2>

        <form action="frontend/addComment/<?= $post['id'] ?>" method="post">            
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>
</section>    