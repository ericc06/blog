<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<section id="posts-list">
    <div class="container">
        <br>
        <h4>
            <p>Tous les billets du blog :</p>
        </h4>

        <?php
        while ($data = $posts->fetch())
        {
        ?>
            <div class="news">
                <h3>
                    <?= htmlspecialchars($data['title']) ?>
                    <em class="post-date">le <?= $data['last_modif_date_fr'] ?></em>
                </h3>
                
                <p>
                    <?= nl2br(htmlspecialchars($data['intro'])) ?> <a href="index.php?action=post&id=<?= $data['id'] ?>">(voir plus)</a>
                    <br />
                </p>
                </div>
<?php
}
$posts->closeCursor();
?>
    </div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
