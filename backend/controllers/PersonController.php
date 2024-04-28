<?php

namespace backend\controllers;

use common\models\Person;
use common\models\PersonSearch;
use common\models\Region;
use common\models\Municipality;
use common\models\Province;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\helpers\Json;
use yii\filters\AccessControl;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class'=> AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ]

                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Person models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PersonSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $query = new Query();
        $totalNumPerson = $query->select(['status', 'COUNT(status) as count'])
            ->from('person')
            ->groupBy('status')
            ->all();


        // Query to count total person_status
        $queryTotal = new Query();
        $totalStatus = $queryTotal->select(['COUNT(status) as total'])
            ->from('person')
            ->scalar();
        
        $queryAge = new Query();
        $queryAge->select([
            'age_group' => new \yii\db\Expression('
                CASE
                    WHEN age BETWEEN 0 AND 12 THEN \'0-12\'
                    WHEN age BETWEEN 13 AND 18 THEN \'13-18\'
                    WHEN age BETWEEN 19 AND 25 THEN \'19-25\'
                    WHEN age BETWEEN 26 AND 35 THEN \'26-35\'
                    WHEN age BETWEEN 36 AND 50 THEN \'36-50\'
                    WHEN age BETWEEN 51 AND 65 THEN \'51-65\'
                    ELSE \'65+\'
                END
            '),
            'count' => new \yii\db\Expression('COUNT(*)'),
        ])
        ->from('person')
        ->groupBy('age_group')
        ->orderBy('age_group');

        $ageGroup = $queryAge->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalNumPerson' => $totalNumPerson,
            'totalStatus' => $totalStatus,
            'ageGroup' => $ageGroup,
        ]);
    }

    // public function actionGetProvinces($region_id)
    // {
    //     $provinces = Province::find()->where(['region_c' => $region_id])->all();
    //     return json_encode($provinces);
    // }

    // public function actionGetMunicipalities($province_id)
    // {
    //     $municipalities = Municipality::find()->where(['province_c' => $province_id])->all();
    //     return json_encode($municipalities);
    // }

    /**
     * Displays a single Person model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Person();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        //$regions = Region::find()->all();
        
        return $this->render('create', [
            'model' => $model,
            //'regions' => $regions,
        ]);
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
