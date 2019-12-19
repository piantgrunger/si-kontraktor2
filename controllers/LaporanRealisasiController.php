<?php

namespace app\controllers;

use Yii;
use app\models\VwProgressRealisasi;
use app\models\VwProgressRealisasiRp;

use yii\web\Controller;
use yii\base\DynamicModel;
use yii\db\Expression;
use yii\web\Response;

/**
 * VwRealisasiDetailController implements the CRUD actions for VwRealisasiDetail model.
 */
class LaporanRealisasiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\ContentNegotiator',
                'only' => ['data'],  // in a controller
            // if in a module, use the following IDs for user actions
            // 'only' => ['user/view', 'user/index']
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    /**
     * Lists all VwRealisasiDetail models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new DynamicModel([
          'id_rab',
        ]);
        $model->addRule(['id_rab'], 'required');
        if ($model->load(Yii::$app->request->post())) {
            $data = VwProgressRealisasi::find()
                                ->select('progress')
                                ->where(['id_rab' => $model->id_rab])
                                ->orderBy('tgl_ak_realisasi')
                                ->all();
            $chartData = [];
            foreach ($data as $isi) {
                $chartData[] = (float) $isi->progress;
            }
            $data2 = VwProgressRealisasiRp::find()
                ->select('progress')
                ->where(['id_rab' => $model->id_rab])
                ->orderBy('tgl_ak_realisasi')
                ->all();
            $chartData2 = [];
            foreach ($data2 as $isi) {
                $chartData2[] = (float)$isi->progress;
            }

            $dataTanggal = VwProgressRealisasi::find()
                ->select('tgl_ak_realisasi')

                ->where(['id_rab' => $model->id_rab])
                ->orderBy('tgl_ak_realisasi')
                ->column();

            $dataTanggalRp = VwProgressRealisasiRp::find()
                ->select('tgl_ak_realisasi')

                ->where(['id_rab' => $model->id_rab])
                ->orderBy('tgl_ak_realisasi')
                ->column();

            return $this->render('index', [
                'model' => $model,
                'chartData' => $chartData,
                'chartData2' => $chartData2,

                'dataTanggal' => $dataTanggal,
                'dataTanggalRp' => $dataTanggalRp,
            ]);
        }

        return $this->render('index', [
            'model' => $model,
            'chartData' => '',
            'chartData2' => '',
            'dataTanggal' => '',
            'dataTanggalRp' => '',

            ]);
    }

    public function actionData($id_rab)
    {
        $datediff = new Expression('DATEDIFF(day,tgl_aw_realisasi,tgl_ak_realisasi)');
        $searchModel = (new yii\db\Query())
                                ->select(['id_realisasi' => 'id_realisasi', 'no_realisasi' => "[no_realisasi] +' -  '+[nama_pekerjaan]", 'tgl_aw_realisasi' => 'tgl_aw_realisasi', 'duration' => $datediff])
                                ->from('tb_mt_realisasi')
                                ->leftJoin('tb_dt_rab', 'tb_dt_rab.id_d_rab = tb_mt_realisasi.id_d_rab')
                                ->leftJoin('tb_m_pekerjaan', 'tb_dt_rab.id_pekerjaan = tb_m_pekerjaan.id_pekerjaan')

                                ->where(['tb_mt_realisasi.id_rab' => $id_rab])
                                ->orderBy('tgl_aw_realisasi')
                                ->all()
                                ;

        $datax = [];
        $link = [];
        foreach ($searchModel as $model) {
            $datax[] = [
                'id' => $model['id_realisasi'],
                'start_date' => $model['tgl_aw_realisasi'],
                'text' => $model['no_realisasi'],
                'duration' => $model['duration'],
                'parent' => 0,
            ];
            $link[] = [
                    'id' => $model['id_realisasi'],
                    'source' => $model['id_realisasi'],
                    'target' => $model['id_realisasi'],
                    'type' => 0,
            ];
        }
        $data = ['data' => $datax, 'link' => $link];

        return $data;
    }
}
