<?php

namespace app\controllers;

use Yii;
use app\models\RABSearch;
use app\models\RAB_historySearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\RAB;
use app\models\d_RAB;
use app\models\sd_RAB_material;
use app\models\sd_RAB_pekerja;
use app\models\sd_RAB_peralatan;
use app\models\RAB_history;
use app\models\d_RAB_history;
use app\models\sd_RAB_history_material;
use app\models\sd_RAB_history_pekerja;
use app\models\sd_RAB_history_peralatan;

/**
 * RABController implements the CRUD actions for RAB model.
 */
class HistoryController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RAB models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RAB_historySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RAB model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new RAB model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    /**
     * Finds the RAB model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RAB the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RAB_history::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
