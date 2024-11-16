


<?php if (!empty($articles)): ?>
    <?php foreach ($articles as $article): ?>
        <div class="article">
            <h3><?= $article->prodprice; ?></h3>
            <p><?= $article->prodqty; ?></p>
   
        </div>
    <?php endforeach; ?>
<?php endif; ?>



