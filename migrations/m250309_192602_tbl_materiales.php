<?php

use yii\db\Migration;

class m250309_192602_tbl_materiales extends Migration
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
        echo "m250309_192602_tbl_materiales cannot be reverted.\n";

        return false;
    }

  
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {   
        $this->createTable('tbl_materiales', [
            'tbl_materiales_id' => $this->primaryKey(),
            'tbl_materiales_nombre' => $this->string(100)->notNull(),
            'tbl_materiales_descripcion' => $this->string(100)->notNull(),
            'tbl_materiales_cantidad' => $this->integer(100)->notNull(),
            'tbl_materiales_fechaingreso' => $this->integer()->notNull(),
            'tbl_materiales_created' => $this->dateTime()->notNull(),
            'tbl_materiales_createdby' => $this->dateTime()->notNull(),
        ]);

    }

    public function down()
    {
        echo "m250309_192602_tbl_materiales cannot be reverted.\n";

        return false;
    }

}
