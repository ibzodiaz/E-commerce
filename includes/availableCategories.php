<div class="categories">
	<button class="show-categories btn-style my-color"><i class="fa fa-chevron-right"></i></button>
	<a href="index.php?url=category" class="all-categories">Voir tout</a>
    <?php for($i = 0 ; $i < count($allCategories); $i++ ): ?>
        <div class="categories-style">
            <a href="index.php?url=category&article=<?= $allCategories[$i]->getCategory_name() ?>"><i class="fa-solid <?= $i < count($fontawsome) ? $fontawsome[$i] : "" ?>"></i><span class="categories-name"><?= $allCategories[$i]->getCategory_name() ?></span></a>
        </div>
    <?php endfor;?>
</div>