<?php

use yii\db\Migration;

class m250405_043015_tbl_movimientos_inventario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_movimientos_inventario}}', [
            'id' => $this->primaryKey(),
            'material_id' => $this->integer()->notNull(),
            'tipo' => $this->string(30)->notNull()->comment('entrada, salida, ajuste'),
            'entrada_salida_ajuste' => $this->decimal(10, 2)->notNull(),
            'cantidad' => $this->decimal(10, 2)->notNull()->comment('Cantidad final después del movimiento'),
            'fecha' => $this->dateTime()->notNull(),
            'motivo' => $this->string(255)->null(),
            'usuario_id' => $this->integer()->notNull(),
        ]);
    
        // Índices
        $this->createIndex('idx-movimientos-material', '{{%tbl_movimientos_inventario}}', 'material_id');
        $this->createIndex('idx-movimientos-tipo', '{{%tbl_movimientos_inventario}}', 'tipo');
        $this->createIndex('idx-movimientos-usuario', '{{%tbl_movimientos_inventario}}', 'usuario_id');
    
        // CLAVES FORÁNEAS (ÚNICAS)
        $this->addForeignKey(
            'fk-movimientos-material',
            '{{%tbl_movimientos_inventario}}',
            'material_id', 
            '{{%tbl_materiales}}',
            'tbl_materiales_id',
            'RESTRICT',
            'CASCADE'
        );
        
        // SOLO ESTA FK PARA USUARIO (NO DUPLICAR)
        $this->addForeignKey(
            'fk-movimientos-usuario',
            '{{%tbl_movimientos_inventario}}',
            'usuario_id',
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
        $this->dropForeignKey('fk-movimientos-usuario', '{{%tbl_movimientos_inventario}}');
        $this->dropForeignKey('fk-movimientos-material', '{{%tbl_movimientos_inventario}}');
        $this->dropIndex('idx-movimientos-usuario', '{{%tbl_movimientos_inventario}}');
        $this->dropIndex('idx-movimientos-tipo', '{{%tbl_movimientos_inventario}}');
        $this->dropIndex('idx-movimientos-material', '{{%tbl_movimientos_inventario}}');
        $this->dropTable('{{%tbl_movimientos_inventario}}');
    }
}