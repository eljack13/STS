<?php

use yii\db\Migration;

class m250405_042951_tbl_procesos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_procesos}}', [
            'id' => $this->primaryKey(),
            'tipo' => $this->string(50)->notNull(),
            'tabla_afectada' => $this->string(50)->notNull(),
            'registro_id' => $this->integer()->notNull(),
            'descripcion' => $this->text()->notNull(),
            'usuario_id' => $this->integer()->notNull(),
            'datetime_fecha' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'valores_anteriores' => $this->text()->null(),
            'valores_nuevos' => $this->text()->null(),
        ]);

        // Añadir índices
        $this->createIndex(
            'idx-procesos-tipo',
            '{{%tbl_procesos}}',
            'tipo'
        );
        
        $this->createIndex(
            'idx-procesos-tabla-registro',
            '{{%tbl_procesos}}',
            ['tabla_afectada', 'registro_id']
        );

        // Añadir clave foránea para usuario_id
        $this->addForeignKey(
            'fk-procesos-usuario',
            '{{%tbl_procesos}}',
            'usuario_id',
            '{{%tbl_usuarios}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-procesos-usuario', '{{%tbl_procesos}}');
        $this->dropIndex('idx-procesos-tabla-registro', '{{%tbl_procesos}}');
        $this->dropIndex('idx-procesos-tipo', '{{%tbl_procesos}}');
        $this->dropTable('{{%tbl_procesos}}');
    }
}