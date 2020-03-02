<?php $this->title = 'Mon blog'; ?> <!--1. on definit le titre de la page dans $title. Celui ci sera intégré dans la balise <title> dans le template-->

<section id="monBlog" class="container">             
    <h1 class="titreSectionBlog">Le blog d'un étudiant OpenClassrooms</h1>
    <p class="titreSectionBlog">Derniers billets du blog :</p>

    <div id="blog">
        <div class="row">
        <?php
        $nb = 1;
        while ($data = $posts->fetch())
        {
            
            if ($nb % 2 == 0)
            {
                echo '<div class="col-lg-5 offset-lg-2 posts">';       
            }
            else
            {                
                echo '<div class="col-lg-5 posts">';    
            }
        ?>            
            
                <div class="row">
                    <div class="col-lg-12 essai">
                        <a href="frontend/post/<?= $data['id'] ?>">
                            <img src= "view/images/<?=$data['src_photo_mini']?>" id="photoPost">
                        </a>
                    </div>
                </div>

                <h3>
                    <?= $this->sanitize($data['title']); ?>
                    <em>le <?= $this->sanitize($data['creation_date_fr']); ?></em>
                </h3>                                        
                <p class ="postContent">
                    <?= nl2br($this->sanitize($data['content'])); ?>                                        
                </p>                    
                <p>
                    <em><a href="frontend/post/<?= $data['id'] ?>">Commentaires</a></em>
                </p>
                
            </div>
            
        <?php
         $nb++;
        }
        $posts->closeCursor();
        ?>

    </div>
</section>
