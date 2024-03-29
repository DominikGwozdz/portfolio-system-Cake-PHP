<?php
$this->layout = 'panel';
?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Strona o mnie</h1>
    </div>

    <div>
        <?= $this->Flash->render() ?>
    </div>

    <div class="mt-4 mb-4">Podgląd:</div>
    <img src="/assets/<?= h($about_me->photo) ?>" class="img-fluid w-25 text-center" /><br />
    <p>
        <?= $about_me->description ?>
    </p>

        <?= $this->Form->create("about_me", ['url' => '/panel/edit_about', 'enctype' => 'multipart/form-data']) ?>
        <?= $this->Form->control('image_path', ['type' => 'file', 'class' => 'form-control-file', 'label' => __('Wybierz zdjęcie: ')]) ?>
        <?= $this->Form->control('description', ['type' => 'textarea', 'class' => 'form-control', 'label' => __('Twój opis'), 'value' => $about_me->description]) ?>
        <?= $this->Form->control('Zapisz', ['type' => 'submit', 'class' => 'btn btn-success mt-3']) ?>
        <?= $this->Form->end() ?>



</div>
<!-- /.container-fluid -->
