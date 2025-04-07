<?php

use yii\db\Migration;

class m250405_042924_tbl_ubicaciones extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_ubicaciones}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(100)->notNull(),
            'descripcion' => $this->text()->null(),
            'capacidad' => $this->integer()->null(),
        ]);

        // Añadir índice para la columna nombre
        $this->createIndex(
            'idx-ubicaciones-nombre',
            '{{%tbl_ubicaciones}}',
            'nombre'
        );

        // Insertar algunas ubicaciones de ejemplo
        $this->batchInsert('{{%tbl_ubicaciones}}', ['nombre', 'descripcion', 'capacidad'], [
            ['Almacén Principal', 'Almacén central de la empresa', 1000],
            ['Bodega A', 'Bodega de herramientas', 500],
            ['Bodega B', 'Bodega de repuestos', 500],
            ['Taller', 'Área de mantenimiento', 300],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-ubicaciones-nombre', '{{%tbl_ubicaciones}}');
        $this->dropTable('{{%tbl_ubicaciones}}');
    }
}