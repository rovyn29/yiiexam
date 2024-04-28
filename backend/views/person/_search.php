<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\PersonSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="person-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'first_name') ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'last_name') ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'birthdate')->textInput(['type' => 'date']) ?>
            </div>
        </div>
    </div>

    <div class="form-group my-2">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
