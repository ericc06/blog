<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<section id="single-post">
    <div class="container">
        <br>
        <p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>

        <div class="news">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['last_modif_date_fr'] ?></em>
            </h3>
            
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
