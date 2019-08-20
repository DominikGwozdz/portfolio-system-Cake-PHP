<?php
$this->layout = 'panel';
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Górny slider</h1>
    </div>

    <p class="pt-5 pb-5">Wszystkie zdjęcia w sliderze:</p>
    <?php foreach($top_slider_homepage as $slider): ?>

        <img src="/assets/<?= $slider->url ?>" class="img-fluid w-25" />
    <?php endforeach; ?>

    <p class="pt-5 pb-5">Dodaj nowe zdjęcia:</p>

    <?= $this->Form->create("top_slider_homepage", ['url' => '/panel/upload', 'enctype' => 'multipart/form-data']) ?>
    <?= $this->Form->control('image_path', ['type' => 'file', 'label' => __('Wybierz zdjęcie: ')]) ?>
    <?= $this->Form->control('Wyślij zdjęcie', ['type' => 'submit']) ?>
    <?= $this->Form->end() ?>
</div>
<!-- /.container-fluid -->