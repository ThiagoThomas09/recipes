<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-view container py-4">

    <!-- Título -->
    <h2 class="mb-3"><?= Html::encode($model->title) ?></h2>

    <!-- Autor -->
    <p class="text-muted small mb-2">
        Por <?= Html::encode($model->user->username ?? '—') ?>
    </p>

    <!-- Categorias -->
    <p class="mb-4">
        <?php if ($model->categories): ?>
            <?php foreach ($model->categories as $cat): ?>
                <span class="badge bg-secondary"><?= Html::encode($cat->name) ?></span>
            <?php endforeach; ?>
        <?php else: ?>
            <span class="badge bg-secondary">Sem categoria</span>
        <?php endif; ?>
    </p>

    <!-- Imagem -->
    <?php if ($model->image): ?>
        <div class="mb-4">
            <img src="<?= Url::to('@web/'.$model->image, true) ?>"
                 class="img-fluid rounded"
                 style="max-width:80%; max-height:350px; object-fit:cover;"
                 alt="<?= Html::encode($model->title) ?>">
        </div>
    <?php else: ?>
        <div class="d-flex align-items-center justify-content-center bg-secondary text-white mb-4"
             style="height:350px; max-width:50%;">
            <strong>Sem imagem</strong>
        </div>
    <?php endif; ?>

    <!-- Modo de preparo -->
    <div class="d-flex align-items-center mb-2" style="gap:1rem">
        <h5 class="mb-0">Modo de preparo</h5>
        <span class="text-muted small">
            Tempo estimado: <?= $model->cook_time ? Html::encode($model->cook_time).' minutos' : '—' ?>
        </span>
    </div>

    <!-- Descrição -->
    <p class="pre-line"><?= Html::encode($model->description) ?></p>

    <!-- Botão Voltar -->
    <p class="mt-4">
        <?= Html::a('← Voltar à lista', ['site/index'], ['class'=>'btn btn-outline-secondary']) ?>
    </p>

</div>
