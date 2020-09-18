<?php $this->title = 'Mon blog';  //1. on definit le titre de la page dans $title. Celui ci sera intégré dans la balise <title> dans le template-->

?>
<section class="container">
    <h1 id="postTitle">
        <?= $this->sanitize($post->title()); ?>
    </h1>

    <p><a href="index.php/#ancrePrincipale">Retour à la liste des billets</a></p>

    <div class="news">
        <img src="../photoPost/<?= $post->id() ?>/<?= $post->srcPhoto() ?>" id="photoPost">
        <h3>
            <em>Posté le <?= $post->creationDate() ?></em>
        </h3>

        <p>
            <?= $post->content() ?>
        </p>
    </div>

    <?php
    while ($nbComment = $nbComments->fetch()) {
        if ($nbComment['nbComments'] <= 1) {
    ?>
            <p><?= $nbComment['nbComments'] ?> commentaire</p>
        <?php
        } else {
        ?>
            <p><?= $nbComment['nbComments'] ?> commentaires</p>
    <?php
        }
    }
    ?>

    <div class="container">
        <?php
        while ($comment = $comments->fetch()) {
        ?>
            <div class="media thumbmail">
                <img class="media-object" src="public/images/avatar.png">
                <div class="media-body">
                    <div id="commentAuthor" class="media-heading">
                        <strong><?= $this->sanitize($comment['author']); ?></strong>
                    </div>
                    <div id="commentDate">
                        le <?= $this->sanitize($comment['comment_date_fr']); ?>
                    </div>
                    <?php
                    //on affiche le bouton modifier un comment que si c'est l'utilisateur connecté est celui qui a posté le comment
                    if (isset($_SESSION['id'])) {
                        if ($comment['member_id'] == $_SESSION['id']) {
                    ?>
                            <a data-toggle="modal" href="#modifyComment" data-target="#modifyComment<?= $comment['id'];
                                                                                                    $comment['comment']; ?>">Modifier</a>
                    <?php }
                    } ?>
                    <p><?= nl2br($this->sanitize($comment['comment'])); ?></p>
                </div>
            </div>
            <!--popup de modification d'un commentaire-->
            <div class="modal" id="modifyComment<?= $comment['id'];
                                                $comment['comment']; ?>">
                <div class="modal-dialog modal-lg">
                    <!--Intégration du formulaire-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Modification d'un commentaire</h4>
                            <button type="button" class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form action="frontend/updateComment/<?= $comment['id'] ?>/#ancrePrincipale" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-4" for="comment">Commentaire</label><br />
                                    <textarea class="col-lg-8 col-8" id="commentFormTextArea" name="comment"><?= $this->sanitize($comment['comment']); ?></textarea>
                                </div>

                                <div class="mx-auto">
                                    <button type="submit" class="btn btn-primary float-right">Modifier</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
        <form action="frontend/addComment/<?= $post->id() ?>/#ancrePrincipale" method="post" class="col-lg-12">
            <div class="form-group">
                <!--<label for="comment">Commentaire</label><br />-->
                <textarea class="form-control" id="commentFormTextArea" name="comment" placeholder="Ecrivez votre commentaire içi."></textarea>
            </div>

            <button class="btn btn-primary" type="submit">Valider</button>

        </form>
    </div>
</section>