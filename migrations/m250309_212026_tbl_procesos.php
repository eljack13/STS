<?php

use yii\db\Migration;

class m250309_212026_tbl_procesos extends Migration
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
        echo "m250309_212026_tbl_procesos cannot be reverted.\n";

        return false;
    }

   
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('tbl_procesos', [
            'tbl_procesos_id' => $this->primaryKey(),
            'tbl_procesos_nombre' => $this->string(100)->notNull(),
            'tbl_procesos_usuario' => $this->string(100)->notNull(),
            'tbl_procesos_descripcion' => $this->string(100)->notNull(),
            'tbl_procesos_fecha' => $this->dateTime()->notNull(),
        ]);
    }

    public function down()
    {
        echo "m250309_212026_tbl_procesos cannot be reverted.\n";

        return false;
    }
  
}
