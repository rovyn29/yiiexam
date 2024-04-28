<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;
use common\models\Region;
use common\models\Province;
use common\models\Municipality;

/** @var yii\web\View $this */
/** @var common\models\Person $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthdate')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'age')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'sex')->dropDownList(
        [
            'male' => 'Male',
            'female'=> 'Female'
        ], 
        ['prompt'=> 'Select Sex'])
    ?>

    <?= $form->field($model, 'region')->dropDownList(
            ArrayHelper::map(Region::find()->All(), 'abbreviation', 'abbreviation'),
            ['prompt'=>'Select Region']
        );
    ?>

    <?= $form->field($model, 'province')->dropDownList(
            ArrayHelper::map(Province::find()->All(), 'province_m', 'province_m'),
            ['prompt'=>'Select Province']
        );
    ?>

    <?= $form->field($model, 'municipality')->dropDownList(
            ArrayHelper::map(Municipality::find()->All(), 'citymun_m', 'citymun_m'),
            ['prompt'=>'Select Municipality']
        );
    ?>


    <?= $form->field($model, 'contact')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'status')
        ->dropDownList([
            'Under Investigation' => 'Under Investigation', 
            'Surrenderd'=> 'Surrenderd',
            'Apprehended'=> 'Apprehended',
            'Escaped'=> 'Escaped',
            'Deceased'=> 'Deceased',
        ], ['prompt'=> 'Select Status']) 
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
