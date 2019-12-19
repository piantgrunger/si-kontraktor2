<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\commands;

use yii\console\Controller;
use app\models\LevelJabatan;
use app\models\JenisPekerjaan;
use Yii;
use yii\helpers\ArrayHelper;
/**
 *
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
use Faker\Factory;

class SeederController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {

        $faker = Factory::create('id_ID');

        $row = 3;
        $iterate = 1;
        $start = microtime(true);
        $datas = [];


        for ($j = 1; $j <= $iterate; $j++) {
            for ($i = 1; $i <= $row; $i++) {

                $datas[$i] = [
                    'jbt-'.$i,
                    'Jabatan ' . $faker->words(3, true),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    1,
                    1


                ];
            }
            Yii::$app->db->createCommand()->batchInsert('tb_m_level_jabatan', [
                'kode_level_jabatan',
                'nama_level_jabatan',
                'created_at',
                'updated_at',
                'created_by',
                'updated_by',

            ], $datas)->execute();
            $time_elapsed_us = microtime(true) - $start;
            echo ($row * $iterate) . ' = ' . $time_elapsed_us . ' <br>';

        }




        $row = 5;
        $iterate = 1;
        $start = microtime(true);
        $lvl1 =LevelJabatan::find()->select('id_level_jabatan')->asArray() ->all();
        $lvl = ArrayHelper::getColumn($lvl1, 'id_level_jabatan');

        $datas = [];


        for ($j = 1; $j <= $iterate; $j++) {
            for ($i = 1; $i <= $row; $i++) {

                $datas[$i] = [
                    'kry-'.$i,
                     $faker->name,
                    $faker->randomElement($lvl),

                     $faker->address,
                     $faker->city,
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    $faker->randomElement(['Tetap','Borongan']),


                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    1,
                    1


                ];
            }
            Yii::$app->db->createCommand()->batchInsert('tb_m_karyawan', [
                'kode_karyawan',
                'nama_karyawan',
                'id_level_jabatan',
                'alamat_karyawan',
                'tempat_lahir',
                'tanggal_lahir',
                'status_karyawan',
                'created_at',
                'updated_at',
                'created_by',
                'updated_by',

            ], $datas)->execute();
            $time_elapsed_us = microtime(true) - $start;
            echo ($row * $iterate) . ' = ' . $time_elapsed_us . ' <br>';

        }
        $row = 3;
        $iterate = 1;
        $start = microtime(true);
        $datas = [];


        for ($j = 1; $j <= $iterate; $j++) {
            for ($i = 1; $i <= $row; $i++) {

                $datas[$i] = [
                    'jp-' . $i,
                    'Jenis Pekerjaan ' . $faker->words(1, true),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    1,
                    1


                ];
            }
            Yii::$app->db->createCommand()->batchInsert('tb_m_jenis_pekerjaan', [
                'kode_jenis_pekerjaan',
                'nama_jenis_pekerjaan',
                'created_at',
                'updated_at',
                'created_by',
                'updated_by',

            ], $datas)->execute();
            $time_elapsed_us = microtime(true) - $start;
            echo ($row * $iterate) . ' = ' . $time_elapsed_us . ' <br>';



        }

        $row = 15;
        $iterate = 1;
        $start = microtime(true);

        $lvl1x = JenisPekerjaan::find()->select('id_jenis_pekerjaan')->asArray()->all();
        $lvlx = ArrayHelper::getColumn($lvl1x, 'id_jenis_pekerjaan');


        $datas = [];


        for ($j = 1; $j <= $iterate; $j++) {
            for ($i = 1; $i <= $row; $i++) {

                $datas[$i] = [
                    'pkrj-' . $i,
                    'Pekerjaan ' . $faker->words(2, true),

                    $faker->randomElement($lvlx),
                    $faker->randomElement(['Meter','Hari','KiloMeter','Tahun']),

                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    1,
                    1


                ];
            }
            Yii::$app->db->createCommand()->batchInsert('tb_m_pekerjaan', [
                'kode_pekerjaan',
                'nama_pekerjaan',
                'id_jenis_pekerjaan',
                'satuan',

                'created_at',
                'updated_at',
                'created_by',
                'updated_by',

            ], $datas)->execute();
            $time_elapsed_us = microtime(true) - $start;
            echo ($row * $iterate) . ' = ' . $time_elapsed_us . ' <br>';

        }

        $row = 10;
        $iterate = 1;
        $start = microtime(true);
        $datas = [];


        for ($j = 1; $j <= $iterate; $j++) {
            for ($i = 1; $i <= $row; $i++) {

                $datas[$i] = [
                    'AM-' . $i,
                    'Barang  ' . $faker->words(2, true),
                    $faker->randomElement(['Material','Peralatan']),
                    $faker->words(5,true),
                    $faker->randomElement(['PCS', 'KG','BIJI','TON']),

                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    1,
                    1


                ];
            }
            Yii::$app->db->createCommand()->batchInsert('tb_m_material', [
                'kode_material',
                'nama_material',
                'jenis',
                'spesifikasi',
                'satuan',
                'created_at',
                'updated_at',
                'created_by',
                'updated_by',

            ], $datas)->execute();
            $time_elapsed_us = microtime(true) - $start;
            echo ($row * $iterate) . ' = ' . $time_elapsed_us . ' <br>';



        }




        $row = 10;
        $iterate = 1;
        $start = microtime(true);

        $datas = [];


        for ($j = 1; $j <= $iterate; $j++) {
            for ($i = 1; $i <= $row; $i++) {



                $datas[$i] = [
                    'cust-' . $i,
                    $faker->company,

                    $faker->address,
                    $faker->city,
                    $faker->phoneNumber,

                    $faker->phoneNumber,
                    $faker->name,



                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    1,
                    1


                ];
            }
            Yii::$app->db->createCommand()->batchInsert('tb_m_customer', [
                'kode_customer',
                'nama_customer',
                'alamat_customer',
                'kota',
                'telepon',
                'fax',
                'kontak_person',

                'created_at',
                'updated_at',
                'created_by',
                'updated_by',

            ], $datas)->execute();
            $time_elapsed_us = microtime(true) - $start;
            echo ($row * $iterate) . ' = ' . $time_elapsed_us . ' <br>';

        }




    }





}