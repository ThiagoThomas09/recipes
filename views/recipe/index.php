<?php

use app\models\Recipe;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\RecipeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Recipes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Recipe', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'description:ntext',
            [
                'label' => 'Categorie',
                'value' => function($model) {
                    // ArrayHelper::getColumn extrai o atributo 'name' de cada Categoria
                    $names = ArrayHelper::getColumn($model->categories, 'name');
                    return implode(', ', $names);
                },
                'format' => 'raw',
            ],
            //'cook_time:datetime',
            //'image',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Recipe $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
