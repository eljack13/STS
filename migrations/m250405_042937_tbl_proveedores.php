<?php

use yii\db\Migration;

class m250405_042937_tbl_proveedores extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_proveedores}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(100)->notNull(),
            'contacto' => $this->string(100)->null(),
            'direccion' => $this->text()->null(),
        ]);

        // Añadir índice para la columna nombre
        $this->createIndex(
            'idx-proveedores-nombre',
            '{{%tbl_proveedores}}',
            'nombre'
        );

        // Insertar algunos proveedores de ejemplo
        $this->batchInsert('{{%tbl_proveedores}}', ['nombre', 'contacto', 'direccion'], [
            ['Herramientas Industriales S.A.', 'Juan Pérez - 555-1234', 'Calle Industrial 123'],
            ['Repuestos Automotrices', 'María López - 555-5678', 'Av. Mecánica 456'],
            ['Materiales Generales', 'Carlos Rodríguez - 555-9012', 'Calle Suministros 789'],
            ['Equipos Técnicos', 'Ana Martínez - 555-3456', 'Av. Tecnología 101'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-proveedores-nombre', '{{%tbl_proveedores}}');
        $this->dropTable('{{%tbl_proveedores}}');
    }
}