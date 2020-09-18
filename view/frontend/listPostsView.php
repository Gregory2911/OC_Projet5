<?php $this->title = 'Mon blog'; ?>
<!--1. on definit le titre de la page dans $title. Celui ci sera intégré dans la balise <title> dans le template-->

<section id="monBlog" class="container">
    <h1 class="titreSectionBlog">Le blog d'un étudiant OpenClassrooms</h1>

    <div id="blog">
        <div class="row">
            <?php
            $nb = 1;
            foreach ($posts as $post) {
                if ($nb % 2 == 0) {
                    echo '<div class="col-lg-5 offset-lg-2 posts">';
                } else {
                    echo '<div class="col-lg-5 posts">';
                }
            ?>

                <div class="row">
                    <div class="col-lg-12 essai">
                        <a href="frontend/post/<?= $post->id() ?>">
                            <img src="../photoPost/<?= $post->id() ?>/<?= $post->srcPhotoMini() ?>" class="photoPost">
                        </a>
                    </div>
                </div>

                <h3>
                    <?= $this->sanitize($post->title()); ?>
                </h3>
                <p><?= $this->sanitize($post->creationDate()); ?></p>
                <p class="postContent">
                    <?= $post->content(); ?>
                </p>
                <p>
                    <em><a href="frontend/post/<?= $post->id() ?>/#ancrePrincipale">Voir plus</a></em>
                </p>

        </div>

    <?php
                $nb++;
            }
    ?>

    </div>
</section>

<!--section contact-->
<section>
    <div class="container" id="formContact">
        <div class="jumbotron text-center" id="FormContactTitle">
            <div class="container">
                <h1 class="jumbotron-heading">FORMULAIRE DE CONTACT</h1>
            </div>
        </div>

        <div class="row" id="formContact">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Me contacter
                    </div>
                    <div class="card-body">
                        <form action="contact/sendEmail" method="post">
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" name="name" id="name" value="" placeholder="Votre nom">
                            </div>
                            <div class="form-group">
                                <label for="email">Courriel</label>
                                <input type="text" class="form-control" name="email" id="email" value="" placeholder="Votre courriel">

                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" name="message" id="message" rows="6" placeholder="Votre message"></textarea>
                            </div>

                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary text-right">Envoyer</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<!--Section coordonnées-->
<section id="coordonnées">
    <div class="container">
        <div class="jumbotron text-center" id="FormContactTitle">
            <h1 class="jumbotron-heading">COORDONNEES</h1>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <strong>Grégory AGNAN</strong>
                <p>01 impasse des jardins de coavou<br />22980 Vildé Guingalan</p>
                <p>06 43 80 11 24</p>
            </div>
            <div class="col-lg-6">
                <iframe id="googlemap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d661.8819738861503!2d-2.1483261707520884!3d48.427207288621254!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x480e612e683a17bd%3A0x2290b56b86cb497a!2s57-37%20Coavou%2C%2022980%20Vild%C3%A9-Guingalan!5e0!3m2!1sfr!2sfr!4v1585309162144!5m2!1sfr!2sfr" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
</section>