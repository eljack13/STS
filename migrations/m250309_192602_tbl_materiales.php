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
            'tbl_materiales_codigo' => $this->integer(100)->notNull(),
            'tbl_materiales_cantidad' => $this->integer(100)->notNull(),
            'tbl_materiales_fechaingreso' => $this->integer()->notNull(),
            'precio' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'categorias_id' => $this->integer()->notNull(),
            'ubicaciones_id' => $this->integer()->notNull(),
            'tbl_materiales_created' => $this->dateTime()->notNull(),
            'tbl_materiales_createdby' => $this->string(255)->notNull(),
        ]);
        // Añadir índices
        $this->createIndex(
            'idx-materiales-codigo',
            '{{%tbl_materiales}}',
            'codigo'
        );
        
        $this->createIndex(
            'idx-materiales-categorias',
            '{{%tbl_materiales}}',
            'categorias_id'
        );
        
        $this->createIndex(
            'idx-materiales-ubicaciones',
            '{{%tbl_materiales}}',
            'ubicaciones_id'
        );

        // Añadir claves foráneas
        $this->addForeignKey(
            'fk-materiales-categorias',
            '{{%tbl_materiales}}',
            'categorias_id',
            '{{%tbl_categorias}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        
        $this->addForeignKey(
            'fk-materiales-ubicaciones',
            '{{%tbl_materiales}}',
            'ubicaciones_id',
            '{{%tbl_ubicaciones}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );


    }

    public function down()
    {
        $this->dropForeignKey('fk-materiales-ubicaciones', '{{%tbl_materiales}}');
        $this->dropForeignKey('fk-materiales-categorias', '{{%tbl_materiales}}');
        $this->dropIndex('idx-materiales-ubicaciones', '{{%tbl_materiales}}');
        $this->dropIndex('idx-materiales-categorias', '{{%tbl_materiales}}');
        $this->dropIndex('idx-materiales-codigo', '{{%tbl_materiales}}');
        $this->dropTable('{{%tbl_materiales}}');
    }

}
