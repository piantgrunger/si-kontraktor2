<?php

namespace app\controllers;

use Yii;
use app\models\RABSearch;
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
use app\models\Pekerjaan;
use app\models\Material;
use app\models\LevelJabatan;
use kartik\mpdf\Pdf;
use yii\helpers\Json;

/**
 * RABController implements the CRUD actions for RAB model.
 */
class RabController extends Controller
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
     * Lists all RAB models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RABSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRap()
    {
        $searchModel = new RABSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->scenario = 'RAP';

        return $this->render('index_rap', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RAB model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $content = $this->renderPartial('view', [
            'model' => $this->findModel($id),
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_A4,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak Kelompok '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionKomparasi($id)
    {
        return $this->render('view_rekap', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDetailRap($id)
    {
        return $this->render('edit_pekerjaan', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPrint($id)
    {
        $content = $this->renderPartial('view', [
            'model' => $this->findModel($id),
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_A4,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak Kelompok '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionViewRekap($id)
    {
        $content = $this->renderPartial('view_rekap', [
            'model' => $this->findModel($id),
        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_A4,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak Rekap '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionReport($tgl_aw, $tgl_ak)
    {
        $model = RAB::find()
        ->FilterWhere(['between', 'tgl_rab', $tgl_aw, $tgl_ak])
        ->orderBy('tgl_rab')
        ->all();
        $content = $this->renderPartial('laporan_rekap', [
            'model' => $model,
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_A4,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak Rekap '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionViewHarga($id)
    {
        $content = $this->renderPartial('view_harga', [
            'model' => $this->findModel($id),
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_A4,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak Harga '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionJenisPekerjaan($id)
    {
        $content = $this->renderPartial('view_rekap2', [
            'model' => $this->findModel($id),
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_A4,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak Jenis Pekerjaan '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    /**
     * Creates a new RAB model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RAB();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailRab = Yii::$app->request->post('d_RAB', []);

                if (($model->save()) && (count($model->detailRab) > 0)
                   ) {
                    $transaction->commit();
                    $model_d = d_RAB::find()->where(['id_rab' => $model->id_rab]);
                    $model->nilai_real = is_null($model_d->sum('nilai_pagu')) ? 0 : $model_d->sum('nilai_pagu');
                    $model->total_rab = 0;
                    $model->save();

                    return $this->redirect('index');
                }
                $transaction->rollBack();
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
            if (count($model->detailRab) == 0) {
                $model->addError('detailRAB', 'RAB Harus memiliki detail Pekerjaan');
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            $model->tgl_rab = date('Y-m-d');
            $model->ppn = 10;

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RAB model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionRevisi($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'revisi';
        $old_revisi = $model->tgl_revisi;
        $model->old_file_acuan_revisi = $model->file_acuan_revisi;

        $historyModel = new RAB_history();
        $historyModel->setAttributes($model->getAttributes(null, ['id_rab']), false);
        $historyModel->no_rab = $model->no_rab.' Revisi :'.date('Y-m-d H:i:s');
        $dhistoryModel1 = [];
        foreach ($model->detailRab as  $dmodel1) {
            $dhistoryModel = new d_RAB_history();
            $dhistoryModel->setAttributes($dmodel1->getAttributes(null, ['id_rab', 'id_d_rab']), false);

            $sdHistoryMaterial = [];
            foreach ($dmodel1->sDetailRabMaterial as $sdModel1) {
                $SModelMaterial = new sd_RAB_history_material();
                $SModelMaterial->setAttributes($sdModel1->getAttributes(null, ['id_d_rab', 'id_sd_rab']), false);

                $sdHistoryMaterial[] = $SModelMaterial;
            }
            $dhistoryModel->sDetailRabMaterial = $sdHistoryMaterial;

            $sdHistoryPeralatan = [];
            foreach ($dmodel1->sDetailRabPeralatan as $sdModel2) {
                $SModelPeralatan = new sd_RAB_history_peralatan();
                $SModelPeralatan->setAttributes($sdModel2->getAttributes(null, ['id_d_rab', 'id_sd_rab']), false);

                $sdHistoryPeralatan[] = $SModelPeralatan;
            }
            $dhistoryModel->sDetailRabPeralatan = $sdHistoryPeralatan;

            $sdHistoryPekerja = [];
            foreach ($dmodel1->sDetailRabPekerja as $sdModel3) {
                $SModelPekerja = new sd_RAB_history_pekerja();
                $SModelPekerja->setAttributes($sdModel3->getAttributes(null, ['id_d_rab', 'id_sd_rab']), false);

                $sdHistoryPekerja[] = $SModelPekerja;
            }
            $dhistoryModel->sDetailRabPekerja = $sdHistoryPekerja;

            $dhistoryModel1[] = $dhistoryModel;
        }
        $historyModel->detailRab = $dhistoryModel1;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailRab = Yii::$app->request->post('d_RAB', []);

                if (($model->upload('file_acuan_revisi')) && ($model->save()) && (count($model->detailRab) > 0)) {
                    $transaction->commit();
                    if ($old_revisi !== $model->tgl_revisi) {
                        $historyModel->save(false);
                    }
                    $model_d = d_RAB::find()->where(['id_rab' => $model->id_rab]);
                    $model->nilai_real = is_null($model_d->sum('nilai_pagu')) ? 0 : $model_d->sum('nilai_pagu');
                    $model->save();

                    return $this->redirect('index');
                }
                $transaction->rollBack();
            } catch (\yii\db\IntegrityException $e) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('error', 'Data Tidak Dapat Direvisi Karena Dipakai Modul Lain');
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
            if (count($model->detailRab) == 0) {
                $model->addError('detailRAB', 'RAB Harus memiliki detail Pekerjaan');
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

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailRab = Yii::$app->request->post('d_RAB', []);

                if (($model->upload('file_acuan_revisi')) && ($model->save()) && (count($model->detailRab) > 0)) {
                    $transaction->commit();

                    return $this->render('edit_pekerjaan', [
                        'model' => $this->findModel($id),
                    ]);
                }
                $transaction->rollBack();
            } catch (\yii\db\IntegrityException $e) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('error', 'Data Tidak Dapat Diubah Karena Dipakai Modul Lain');
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
            if (count($model->detailRab) == 0) {
                $model->addError('detailRAB', 'RAB Harus memiliki detail Pekerjaan');
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

    public function actionPekerjaan($id)
    {
        $model = d_RAB::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->sDetailRabMaterial = Yii::$app->request->post('sd_RAB_material', []);
                $model->sDetailRabPeralatan = Yii::$app->request->post('sd_RAB_peralatan', []);
                $model->sDetailRabPekerja = Yii::$app->request->post('sd_RAB_pekerja', []);
                if (($model->save())) {
                    $transaction->commit();
                    $modelRAB = d_RAB::findOne($model->id_d_rab);
                    $model_d_material = sd_RAB_material::find()->where(['id_d_rab' => $model->id_d_rab]);
                    $modelRAB->total_biaya_material = is_null($model_d_material->sum('sub_total')) ? 0 : $model_d_material->sum('sub_total');
                    $model_d_peralatan = sd_RAB_peralatan::find()->where(['id_d_rab' => $model->id_d_rab]);
                    $modelRAB->total_biaya_peralatan = is_null($model_d_peralatan->sum('sub_total')) ? 0 : $model_d_peralatan->sum('sub_total');
                    $model_d_pekerja = sd_RAB_pekerja::find()->where(['id_d_rab' => $model->id_d_rab]);
                    $modelRAB->total_biaya_pekerja = is_null($model_d_pekerja->sum('sub_total')) ? 0 : $model_d_pekerja->sum('sub_total');
                    if ($modelRAB->total_biaya_material + $modelRAB->total_biaya_peralatan + $modelRAB->total_biaya_pekerja != 0) {
                        $modelRAB->total_rab = $modelRAB->total_biaya_material + $modelRAB->total_biaya_peralatan + $modelRAB->total_biaya_pekerja;
                    }
                    $modelRAB->retensi_rp = $modelRAB->retensi_persen / 100 * $modelRAB->total_rab;

                    $modelRAB->save();
                    $modelRAB = RAB::findOne($model->id_rab);
                    $model_d = d_RAB::find()->where(['id_rab' => $model->id_rab]);
                    $modelRAB->total_biaya_material = is_null($model_d->sum('total_biaya_material')) ? 0 : $model_d->sum('total_biaya_material');
                    $modelRAB->total_biaya_peralatan = is_null($model_d->sum('total_biaya_peralatan')) ? 0 : $model_d->sum('total_biaya_peralatan');
                    $modelRAB->total_biaya_pekerja = is_null($model_d->sum('total_biaya_pekerja')) ? 0 : $model_d->sum('total_biaya_pekerja');

                    $modelRAB->total_rab = is_null($model_d->sum('total_rab')) ? 0 : $model_d->sum('total_rab');
                    $modelRAB->retensi_rp = is_null($model_d->sum('retensi_rp')) ? 0 : $model_d->sum('retensi_rp');

                    $modelRAB->save();
                    $modelRAB->ppn_rp = $modelRAB->total_rab * ($modelRAB->ppn / 100);
                    $modelRAB->total_rab = $modelRAB->total_rab + $modelRAB->ppn_rp;

                    $modelRAB->save();

                    return $this->redirect(['detail-rap',
            'id' => $model->id_rab,
        ]);
                }
                $transaction->rollBack();
            } catch (\yii\db\IntegrityException $e) {
                $transaction->rollBack();

                Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dihapus Karena Dipakai Modul Lain');
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
            if (is_null($model->total_rab)) {
                $model->total_rab = 0;
            }

            return $this->render('pekerjaan', [
                'model' => $model,
            ]);
        } else {
            if (is_null($model->total_rab)) {
                $model->total_rab = 0;
            }

            return $this->render('pekerjaan', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RAB model.
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

    public function actionSatuanPekerjaan($id)
    {
        $model = Pekerjaan::findOne(['id_pekerjaan' => $id]);

        return Json::encode([
            'satuan' => $model->satuan,
        ]);
    }

    public function actionSatuanMaterial($id)
    {
        $model = Material::findOne(['id_material' => $id]);

        return Json::encode([
            'satuan' => $model->satuan,
            'harga' => $model->harga,
        ]);
    }

    public function actionUpahPekerja($id)
    {
        $model = LevelJabatan::findOne(['id_level_jabatan' => $id]);

        return Json::encode([
            'upah' => $model->upah,
        ]);
    }

    /**
     * Finds the RAB model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return RAB the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RAB::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
