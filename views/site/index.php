<?php
use yii\helpers\Html;

$this->title = 'Portal de Receitas';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Bem-vindo ao Portal de Receitas!</h1>

        <p class="lead">Você está autenticado com sucesso.</p>

        <p>
            <?= Html::a('Sair', ['site/logout'], ['data-method' => 'post', 'class' => 'btn btn-danger']) ?>
        </p>
    </div>
</div>
