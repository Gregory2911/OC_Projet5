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
                <?=$post['content']?>
            </p>
        </div>

        <?php 
        while ($nbComment = $nbComments->fetch())
        {
            if ($nbComment['nbComments'] < 1)
            {
                ?>             
            	<p><?=$nbComment['nbComments']?> commentaire</p>
            <?php
            }
            else
            {
                ?>
                <p><?=$nbComment['nbComments']?> commentaires</p>
            <?php
            }
    	}
    	?>
        
        <div class="container">
            <?php
            while ($comment = $comments->fetch())
            {        
            ?>
                <div class="media thumbmail">
                    <img class="media-object" src="view/images/avatar.png">
                    <div class="media-body">
                        <div id="commentAuthor" class="media-heading">
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
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <!--
        <div class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Poster un commentaire</h1>       
            </div>
        </div>        
        -->
        <div id="formComment">
            <form action="frontend/addComment/<?= $post['id'] ?>" method="post" class="col-lg-12">            
                <div class="form-group">
                    <!--<label for="comment">Commentaire</label><br />-->
                    <textarea class="form-control" id="commentForm" name="comment" placeholder="Ecrivez votre commentaire içi."></textarea>
                </div>
                
                <button class="btn btn-primary" type="submit">Valider</button>
                
            </form>
        </div>
</section>    