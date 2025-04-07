<?php

use yii\db\Migration;

class m250405_042942_tbl_vehiculos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_vehiculos}}', [
            'id' => $this->primaryKey(),
            'placa' => $this->string(20)->notNull()->unique(),
            'marca' => $this->string(50)->notNull(),
            'modelo' => $this->string(50)->notNull(),
            'anio' => $this->integer()->notNull(),
            'tipo' => $this->string(30)->notNull(),
            'color' => $this->string(30)->null(),
            'datetime_created' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'createdby_id' => $this->integer()->notNull(),
        ]);

        // Añadir índices
        $this->createIndex(
            'idx-vehiculos-placa',
            '{{%tbl_vehiculos}}',
            'placa'
        );

        // Añadir clave foránea para createdby_id
        $this->addForeignKey(
            'fk-vehiculos-createdby',
            '{{%tbl_vehiculos}}',
            'createdby_id',
            '{{%tbl_usuarios}}',
            'tbl_usuarios_id',
            'RESTRICT',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-vehiculos-createdby', '{{%tbl_vehiculos}}');
        $this->dropIndex('idx-vehiculos-placa', '{{%tbl_vehiculos}}');
        $this->dropTable('{{%tbl_vehiculos}}');
    }
}