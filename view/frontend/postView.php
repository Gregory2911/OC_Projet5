<?php $this->title = 'Mon blog';

?>
<section class="container">
    <h1 id="postTitle">
        <?= $this->sanitize($post->title()); ?>
    </h1>

    <p><a href="index.php/#ancrePrincipale">Retour à la liste des billets</a></p>

    <div class="news">
        <img src="public/photoPost/<?= $post->id() ?>/<?= $post->srcPhoto() ?>" id="photoPost">
        <p id="infoPost">Posté le <?= $post->creationDate() ?> par <?= $post->pseudo() ?> </p>

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
        foreach ($comments as $comment) {
        ?>
            <div class="media thumbmail">
                <img class="media-object" src="public/images/avatar.png">
                <div class="media-body">
                    <div id="commentAuthor" class="media-heading">
                        <strong><?= $this->sanitize($comment->author()); ?></strong>
                    </div>
                    <div id="commentDate">
                        le <?= $this->sanitize($comment->commentDate()); ?>
                    </div>
                    <?php
                    //on affiche le bouton modifier un comment que si c'est l'utilisateur connecté est celui qui a posté le comment
                    if (isset($_SESSION['id'])) {
                        if ($comment->memberId() == $_SESSION['id']) {
                    ?>
                            <a data-toggle="modal" href="#modifyComment" data-target="#modifyComment<?= $comment->id();
                                                                                                    $comment->content(); ?>">Modifier</a>
                    <?php }
                    } ?>
                    <p><?= nl2br($this->sanitize($comment->content())); ?></p>
                </div>
            </div>
            <!--popup de modification d'un commentaire-->
            <div class="modal" id="modifyComment<?= $comment->id();
                                                $comment->content(); ?>">
                <div class="modal-dialog modal-lg">
                    <!--Intégration du formulaire-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Modification d'un commentaire</h4>
                            <button type="button" class="close" data-dismiss="modal">x</button>
                        </div>
                        <div class="modal-body">
                            <form action="frontend/updateComment/<?= $comment->id() ?>/#ancrePrincipale" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-lg-4 col-4" for="comment">Commentaire</label><br />
                                    <textarea class="col-lg-8 col-8" id="commentFormTextArea" name="comment"><?= $this->sanitize($comment->content()); ?></textarea>
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

    <div id="formComment">
        <form action="frontend/addComment/<?= $post->id() ?>/#ancrePrincipale" method="post" class="col-lg-12">
            <div class="form-group">
                <textarea class="form-control" id="commentFormTextArea" name="comment" placeholder="Ecrivez votre commentaire içi."></textarea>
            </div>
            <p id="infoPostComment">Tout commentaire posté sera soumis à validation d'un modérateur avant d'être publié.</p>
            <button class="btn btn-primary" type="submit">Valider</button>

        </form>
    </div>
</section>