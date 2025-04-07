<?php

use yii\db\Migration;

class m250405_042911_tbl_categorias extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_categorias}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(100)->notNull(),
            'descripcion' => $this->text()->null(),
        ]);

        // Insertar algunas categorías de ejemplo
        $this->batchInsert('{{%tbl_categorias}}', ['nombre', 'descripcion'], [
            ['Herramientas', 'Todo tipo de herramientas para mantenimiento'],
            ['Repuestos', 'Repuestos para vehículos y maquinaria'],
            ['Consumibles', 'Materiales de uso frecuente'],
            ['Equipos', 'Equipos y maquinaria general'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_categorias}}');
    }
}