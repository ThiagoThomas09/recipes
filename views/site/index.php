<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Receitas';
?>
<div class="site-index">

    <h1 class="my-4"><?= Html::encode($this->title) ?></h1>

    <div class="row g-4">
        <?php foreach ($recipes as $recipe): ?>
            <div class="col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm">

                    <?php if ($recipe->image): ?>
                        <img src="<?= Url::to('@web/'.$recipe->image, true) ?>"
                             class="card-img-top object-fit-cover"
                             style="height:200px"
                             alt="<?= Html::encode($recipe->title) ?>">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center"
                             style="background-color:#eee; height:200px">
                            <span class="text-muted">Sem imagem</span>
                        </div>
                    <?php endif; ?>

                    <div class="card-body d-flex flex-column">

                        <!-- TÍTULO e CATEGORIA -->
                        <div class="d-flex align-items-start justify-content-between mb-1">
                            <h5 class="card-title mb-0">
                                <?= Html::encode($recipe->title) ?>
                            </h5>
                            <?php
                                $badge = $recipe->categories
                                    ? Html::tag('span', Html::encode($recipe->categories[0]->name), ['class'=>'badge bg-secondary'])
                                    : Html::tag('span', 'Sem categoria', ['class'=>'badge bg-secondary']);
                            ?>
                            <div class="ms-2"><?= $badge ?></div>
                        </div>

                        <!-- AUTOR e TEMPO -->
                        <div class="d-flex justify-content-between text-muted small mb-3">
                            <div>
                                Por <?= Html::encode($recipe->user->username ?? '—') ?>
                            </div>
                            <div>
                                <i class="bi bi-clock"></i>
                                <?= $recipe->cook_time ? $recipe->cook_time.' min' : '—' ?>
                            </div>
                        </div>

                        <!-- BOTÃO DETALHES -->
                        <?= Html::a('Ver detalhes',
                            ['recipe/view','id'=>$recipe->id],
                            ['class'=>'btn btn-primary mt-auto']) ?>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($recipes)): ?>
        <p class="text-center text-muted mt-5">Nenhuma receita encontrada.</p>
    <?php endif; ?>
</div>
