<?php

use yii\db\Migration;

class m250309_212036_tbl_empresas extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m250309_212036_tbl_empresas cannot be reverted.\n";

        return false;
    }

   
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('tbl_empresas', [
            'tbl_empresas_id' => $this->primaryKey(),
            'tbl_empresas_nombre' => $this->string(100)->notNull(),
            'tbl_empresas_descripcion' => $this->string(100)->notNull(),
            'tbl_empresas_fecha' => $this->dateTime()->notNull(),
        ]);
    }

    public function down()
    {
        echo "m250309_212036_tbl_empresas cannot be reverted.\n";

        return false;
    }
   
}
