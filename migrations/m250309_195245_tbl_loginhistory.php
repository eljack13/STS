<?php

use yii\db\Migration;

class m250309_195245_tbl_loginhistory extends Migration
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
        echo "m250309_195245_tbl_loginhistory cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('tbl_loginhistory', [
            'tbl_loginhistory_id' => $this->primaryKey(),
            'tbl_loginhistory_usuario' => $this->string(100)->notNull(),
            'tbl_loginhistory_fecha' => $this->dateTime()->notNull(),
            'tbl_loginhistory_ip' => $this->string(100)->notNull(),
        ]);
    }

    public function down()
    {
        echo "m250309_195245_tbl_loginhistory cannot be reverted.\n";

        return false;
    }

}
