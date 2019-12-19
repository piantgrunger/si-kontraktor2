<?php

namespace app\controllers;

use Yii;
use app\models\Realisasi;
use app\models\RealisasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\d_RAB;
use yii\helpers\Json;
use app\models\sd_RAB_material;
use app\models\sd_RAB_peralatan;
use app\models\sd_RAB_pekerja;
use app\models\Karyawan;
use app\models\d_realisasi_peralatan;
use app\models\d_realisasi_material;
use app\models\d_realisasi_pekerja;

/**
 * ProgressController implements the CRUD actions for Progress model.
 */
class RealisasiController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Lists all Progress models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RealisasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Progress model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Progress model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Realisasi();
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->det_realisasi_material = Yii::$app->request->post('d_realisasi_material', []);

                $model->det_realisasi_peralatan = Yii::$app->request->post('d_realisasi_peralatan', []);
                $model->det_realisasi_pekerja = Yii::$app->request->post('d_realisasi_pekerja', []);

                if (($model->save()) && (count($model->det_realisasi_material) > 0)) {
                    $transaction->commit();
                    $model_d_material = d_realisasi_material::find()->where(['id_realisasi' => $model->id_realisasi]);
                    $model->total_biaya_material = is_null($model_d_material->sum('sub_total')) ? 0 : $model_d_material->sum('sub_total');
                    $model_d_peralatan = d_realisasi_peralatan::find()->where(['id_realisasi' => $model->id_realisasi]);
                    $model->total_biaya_peralatan = is_null($model_d_peralatan->sum('sub_total')) ? 0 : $model_d_peralatan->sum('sub_total');
                    $model_d_pekerja = d_realisasi_pekerja::find()->where(['id_realisasi' => $model->id_realisasi]);
                    $model->total_biaya_pekerja = is_null($model_d_pekerja->sum('sub_total')) ? 0 : $model_d_pekerja->sum('sub_total');

                    return $this->redirect(['index']); // 'id' => $model->id_realisasi]);
                }
                $transaction->rollBack();
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
            if (count($model->det_realisasi_material) == 0) {
                $model->addError('Detail Progress Material', 'Realisasi Harus memiliki detail material');
            }

            return $this->render('create', [
        'model' => $model,
    ]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Progress model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->det_realisasi_material = Yii::$app->request->post('d_realisasi_material', []);

                $model->det_realisasi_peralatan = Yii::$app->request->post('d_realisasi_peralatan', []);
                $model->det_realisasi_pekerja = Yii::$app->request->post('d_realisasi_pekerja', []);

                if (($model->save()) && (count($model->det_realisasi_material) > 0)) {
                    $transaction->commit();
                    $model_d_material = d_realisasi_material::find()->where(['id_realisasi' => $model->id_realisasi]);
                    $model->total_biaya_material = is_null($model_d_material->sum('sub_total')) ? 0 : $model_d_material->sum('sub_total');
                    $model_d_peralatan = d_realisasi_peralatan::find()->where(['id_realisasi' => $model->id_realisasi]);
                    $model->total_biaya_peralatan = is_null($model_d_peralatan->sum('sub_total')) ? 0 : $model_d_peralatan->sum('sub_total');
                    $model_d_pekerja = d_realisasi_pekerja::find()->where(['id_realisasi' => $model->id_realisasi]);
                    $model->total_biaya_pekerja = is_null($model_d_pekerja->sum('sub_total')) ? 0 : $model_d_pekerja->sum('sub_total');

                    $model->save();

                    return $this->redirect(['index']); // 'id' => $model->id_realisasi]);
                }
                $transaction->rollBack();
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
            if (count($model->det_realisasi_material) == 0) {
                $model->addError('Detail Progress Material', 'Realisasi Harus memiliki detail material');
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Progress model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (\yii\db\IntegrityException  $e) {
            Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dihapus Karena Dipakai Modul Lain');
        }

        return $this->redirect(['index']);
    }

    public function actionPekerjaan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id_rab = $_POST['depdrop_parents'];

            $out = [];
            $data = d_RAB::find()
                ->select([
                    'id' => 'id_d_rab', 'name' => "cast(tb_dt_rab.[level] as varchar(5))+  '  ' +[nama_jenis_pekerjaan]+' '+ ISNULL( [kode_pekerjaan]+' '+[nama_pekerjaan], '' )",
                ])
                ->leftJoin('tb_m_pekerjaan', 'tb_m_pekerjaan.id_pekerjaan = tb_dt_rab.id_pekerjaan ')
                ->leftJoin('tb_m_jenis_pekerjaan', 'tb_m_jenis_pekerjaan.id_jenis_pekerjaan = tb_dt_rab.id_jenis_pekerjaan ')

                ->where(['id_rab' => $id_rab])
                ->asArray()
                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => $list['name']];
            }
            // and return the default sub cat for the cat_id
            echo Json::encode(['output' => $out, 'selected' => '']);

            return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionMaterial()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id_rab = $_POST['depdrop_parents'];

            $out = [];
            $data = sd_RAB_material::find()
                ->select([
                    'id' => 'id_sd_rab', 'name' => "[kode_material]+'-'+[nama_material]",
                ])
                ->innerJoin('tb_m_material', 'tb_m_material.id_material = tb_sdt_rab_material.id_material ')

                ->where(['id_d_rab' => $id_rab])
                ->asArray()
                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => $list['name']];
            }

            if (!empty($_POST['depdrop_params'])) {
                $params = $_POST['depdrop_params'];
                $param1 = $params[0]; // get the value of input-type-1
                $param2 = $params[1]; // get the value of input-type-2
                if ($param1 !== '') {
                    $selected[] = ['id' => $param1, 'name' => $param2];
                } else {
                    $selected = '';
                }
            } else {
                $selected = '';
            }
            // and return the default sub cat for the cat_id
            echo Json::encode(['output' => $out, 'selected' => $selected]);

            return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionLeveljabatan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id_rab = $_POST['depdrop_parents'];

            $out = [];
            $data = sd_RAB_pekerja::find()
                ->select([
                    'id' => 'id_sd_rab', 'name' => "[kode_level_jabatan]+'-'+[nama_level_jabatan]",
                ])
                ->innerJoin('tb_m_level_jabatan', 'tb_m_level_jabatan.id_level_jabatan = tb_sdt_rab_pekerja.id_level_jabatan ')

                ->where(['id_d_rab' => $id_rab])
                ->asArray()
                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => $list['name']];
            }

            if (!empty($_POST['depdrop_params'])) {
                $params = $_POST['depdrop_params'];
                $param1 = $params[0]; // get the value of input-type-1
                $param2 = $params[1]; // get the value of input-type-2
                if ($param1 !== '') {
                    $selected[] = ['id' => $param1, 'name' => $param2];
                } else {
                    $selected = '';
                }
            } else {
                $selected = '';
            }
            // and return the default sub cat for the cat_id
            echo Json::encode(['output' => $out, 'selected' => $selected]);

            return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionKaryawan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id_rab = $_POST['depdrop_parents'];

            $out = [];
            $data = Karyawan::find()
                ->select([
                    'id' => 'id_karyawan', 'name' => "[kode_karyawan]+'-'+[nama_karyawan]",
                ])
                ->innerJoin('tb_sdt_rab_pekerja', 'tb_m_karyawan.id_level_jabatan = tb_sdt_rab_pekerja.id_level_jabatan ')

                ->where(['id_sd_rab' => $id_rab])
                ->asArray()
                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => $list['name']];
            }

            if (!empty($_POST['depdrop_params'])) {
                $params = $_POST['depdrop_params'];
                $param1 = $params[0]; // get the value of input-type-1
                $param2 = $params[1]; // get the value of input-type-2
                if ($param1 !== '') {
                    $selected[] = ['id' => $param1, 'name' => $param2];
                } else {
                    $selected = '';
                }
            } else {
                $selected = '';
            }
            // and return the default sub cat for the cat_id
            echo Json::encode(['output' => $out, 'selected' => $selected]);

            return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionPeralatan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id_rab = $_POST['depdrop_parents'];

            $out = [];
            $data = sd_RAB_peralatan::find()
                ->select([
                    'id' => 'id_sd_rab', 'name' => "[kode_material]+'-'+[nama_material]",
                ])
                ->innerJoin('tb_m_material', 'tb_m_material.id_material = tb_sdt_rab_peralatan.id_material ')

                ->where(['id_d_rab' => $id_rab])
                ->asArray()
                ->all();
            foreach ($data as $i => $list) {
                $out[] = ['id' => $list['id'], 'name' => $list['name']];
            }

            if (!empty($_POST['depdrop_params'])) {
                $params = $_POST['depdrop_params'];
                $param1 = $params[0]; // get the value of input-type-1
                $param2 = $params[1]; // get the value of input-type-2
                if ($param1 !== '') {
                    $selected[] = ['id' => $param1, 'name' => $param2];
                } else {
                    $selected = '';
                }
            } else {
                $selected = '';
            }
            // and return the default sub cat for the cat_id
            echo Json::encode(['output' => $out, 'selected' => $selected]);

            return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public function actionQtyrab($id)
    {
        $model = sd_RAB_material::findOne(['id_sd_rab' => $id]);

        return Json::encode([
            'qty_rab' => $model->qty_sisa(null),
        ]);
    }

    public function actionQtyrabperalatan($id)
    {
        $model = sd_RAB_peralatan::findOne(['id_sd_rab' => $id]);

        return Json::encode([
            'qty_rab' => $model->qty_sisa(null),
        ]);
    }

    public function actionGajipekerja($id)
    {
        $model = sd_RAB_pekerja::findOne(['id_sd_rab' => $id]);

        return Json::encode([
            'gaji' => $model->gaji,
        ]);
    }

    /**
     * Finds the Progress model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Progress the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Realisasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
