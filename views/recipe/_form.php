<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Category;

/** @var yii\web\View $this */
/** @var app\models\Recipe $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="recipe-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cook_time')
    ->input('number', ['min' => 0, 'step' => 1])
    ->label('Tempo de preparo (minutos)')
    ?>

    <?= $form->field($model, 'categoryIds')
        ->listBox(Category::getDropdownList(), ['multiple' => true, 'size' => 6]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?php if (!$model->isNewRecord && $model->image): ?>
        <div class="mb-2">
            <?= Html::img('@web/' . $model->image, ['style' => 'max-width:200px;']) ?>
        </div>
        <?= $form->field($model, 'removeImage')->checkbox() ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
