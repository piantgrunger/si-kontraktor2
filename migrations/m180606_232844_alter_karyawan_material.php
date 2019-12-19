<?php

use yii\db\Migration;

/**
 * Class m180606_232844_alter_karyawan_material
 */
class m180606_232844_alter_karyawan_material extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_level_jabatan','upah','decimal(19,2)');
        $this->addColumn('tb_m_material', 'harga', 'decimal(19,2)');


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('tb_m_level_jabatan', 'upah');
        $this->dropColumn('tb_m_material', 'harga');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180606_232844_alter_karyawan_material cannot be reverted.\n";

        return false;
    }
    */
}
