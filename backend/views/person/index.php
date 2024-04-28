<?php

use common\models\Person;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var common\models\PersonSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Person', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'first_name',
            'last_name',
            'birthdate',
            'age',
            'sex',
            'region',
            'province',
            'municipality',
            'contact',
            'status',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Person $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Total Number of Encoded Person
                    </div>
                    <ul class="list-group list-group-flush">
                    <?php
                        foreach ($totalNumPerson as $total) {
                            if ($total['status'] == 'Under Investigation') {
                                echo Html::tag('li', 'Under Investigation: ' . $total['count'], ['class' => 'list-group-item']);
                            }
                            else if ($total['status'] == 'Surrendered') {
                                echo Html::tag('li', 'Surrendered: ' . $total['count'], ['class' => 'list-group-item']);
                            }
                            else if ($total['status'] == 'Apprehended') {
                                echo Html::tag('li', 'Apprehended: ' . $total['count'], ['class' => 'list-group-item']);
                            }
                            else if ($total['status'] == 'Escaped') {
                                echo Html::tag('li', 'Escaped: ' . $total['count'], ['class' => 'list-group-item']);
                            }
                            else { 
                                echo Html::tag('li', 'Deceased: ' . $total['count'], ['class' => 'list-group-item']);
                            }
                        }
                        
                    ?>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Ratio per status againts population
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php
                            foreach ($totalNumPerson as $status) {
                                if ($total['status'] == 'Under Investigation') {
                                    echo Html::tag('li', 'Under Investigation: ' . $status['count']  . '/' . $totalStatus, ['class' => 'list-group-item']);
                                }
                                else if ($total['status'] == 'Surrendered') {
                                    echo Html::tag('li', 'Surrendered: ' . $status['count'] . '/' . $totalStatus, ['class' => 'list-group-item']);
                                }
                                else if ($total['status'] == 'Apprehended') {
                                    echo Html::tag('li', 'Apprehended: ' . $status['count'] . '/' . $totalStatus, ['class' => 'list-group-item']);
                                }
                                else if ($total['status'] == 'Escaped') {
                                    echo Html::tag('li', 'Escaped: ' . $status['count'] . '/' . $totalStatus, ['class' => 'list-group-item']);
                                }
                                else { 
                                    echo Html::tag('li', 'Deceased: ' . $status['count'] . '/' . $totalStatus, ['class' => 'list-group-item']);
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Age bracket
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php
                            foreach ($ageGroup as $age) {
                                echo Html::tag('li','Age '. $age['age_group'] . ': ' . $age['count'], ['class' => 'list-group-item']);
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
