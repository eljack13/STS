<?php

use yii\db\Migration;

class m250309_192505_tbl_usuarios extends Migration
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
        echo "m250309_192505_tbl_usuarios cannot be reverted.\n";

        return false;
    }

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('tbl_usuarios', [
            'tbl_usuarios_id' => $this->primaryKey(),
            'tbl_usuarios_nombre' => $this->string(100)->notNull(),
            'tbl_usuarios_apellido' => $this->string(100)->notNull(),
            'tbl_usuarios_email' => $this->string(100)->notNull(),
            'tbl_usuarios_password' => $this->string(100)->notNull(),
            'tbl_usuarios_recoverpass' => $this->string(100)->Null(),
            'tbl_usuarios_auth_key' => $this->string(100)->notNull(),
            'tbl_usuarios_access_token' => $this->string(100)->notNull(),
            'tbl_usuarios_telefono' => $this->string(100)->notNull(),
            'tbl_usuarios_rol' => $this->string(100)->notNull(),
            'tbl_usuarios_created' => $this->dateTime()->notNull(),
            'tbl_usuarios_createdby' => $this->dateTime()->notNull(),
        ]);
    }

    public function down()
    {
        
        echo "m250309_192505_tbl_usuarios cannot be reverted.\n";

        return false;
    }
    
}
