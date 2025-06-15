<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Recipe $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Recipes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="recipe-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'title',
            'slug',
            'description:ntext',
            'cook_time',
            [
                'label' => 'Category',
                'value' => implode(', ', ArrayHelper::getColumn($model->categories, 'name')),
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => $model->image ? Html::img('/' . $model->image, ['style' => 'max-width:300px;']) : null,
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
