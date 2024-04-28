<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\Person $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthdate')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'age')->textInput('date') ?>

    <?= $form->field($model, 'sex')->dropDownList(['male' => 'Male', 'female'=> 'Female'], ['prompt'=> 'Select Sex']) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'municipality')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact')->textInput() ?>

    <?= $form->field($model, 'status')
        ->dropDownList([
            'Under Investigation' => 'Under Investigation', 
            'Surrenderd'=> 'Surrenderd',
            'Apprehended'=> 'Apprehended',
            'Escaped'=> 'Escaped',
            'Deceased'=> 'Deceased',
        ], ['prompt'=> 'Select Status']) 
    ?>

    <div class="form-group mt-3">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
