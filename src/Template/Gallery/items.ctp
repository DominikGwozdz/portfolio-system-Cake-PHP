<?php

$this->layout = 'default';

?>

<!--/.Navbar -->
<!-- Blog-Section -->
<div class="about-page pb-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Galeria - <?= h($gallery->name) ?></h3>
            </div>
        </div>
    </div>
</div>

<section id="portfolio">
    <div class="container">
        <a href="/gallery/show/<?= h($gallery->category_id) ?>" class="text-muted d-flex mb-4"> <- Wróć do kategorii</a>
        <div class="row justify-content-center">
            <div class="col-md-12 col-12">
                <div class="row">
                    <?php foreach($gallery_items as $item) : ?>
                        <div class="col-xl-3 col-md-4 box-2">
                            <a href="/assets/<?= h($item->url) ?>" class="w-100 d-block" data-toggle="lightbox" data-gallery="single_gallery">
                                <img src="/assets/<?= h($item->url) ?>" class="img-fluid" alt="">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
