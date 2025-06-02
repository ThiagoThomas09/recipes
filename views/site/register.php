<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Cadastro';
?>
<div class="site-register"></div>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Cadastrar', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
