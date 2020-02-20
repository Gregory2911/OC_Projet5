<?php $this->title = 'Commentaire'; ?> <!--1. on definit le titre de la page dans $title. Celui ci sera intégré dans la balise <title> dans le template-->

<h1>Modification d'un commentaire</h1>

<?php
while ($data = $comment->fetch())
{
?>

    <form action="frontend/updateComment/<?= $data['id'] ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" value="<?=$this->sanitize($data['author']); ?>" />
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment"><?= $this->sanitize($data['comment']);?></textarea>
        </div>
        <div>
            <input type="submit" value="Modifier"/>
        </div>
    </form>
<?php
}
//$posts->closeCursor();
