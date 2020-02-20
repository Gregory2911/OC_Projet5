<?php $this->title = 'Mon blog'; ?> <!--1. on definit le titre de la page dans $title. Celui ci sera intégré dans la balise <title> dans le template-->


    <h1>Mon super blog !</h1>
    <p>Derniers billets du blog :</p>

<div id="blog">
    <?php
    while ($data = $posts->fetch())
    {
    ?>
        <div class="news">
            <h3>
                <?= $this->sanitize($data['title']); ?>
                <em>le <?= $this->sanitize($data['creation_date_fr']); ?></em>
            </h3>
            
            <p>
                <?= nl2br($this->sanitize($data['content'])); ?>
                <br />
                <em><a href="frontend/post/<?= $data['id'] ?>">Commentaires</a></em>
            </p>
        </div>
    <?php
    }
    $posts->closeCursor();
    ?>
</div>
