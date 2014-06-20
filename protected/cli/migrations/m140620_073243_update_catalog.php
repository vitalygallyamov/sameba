<?php
/**
 * Миграция m140620_073243_update_catalog
 *
 * @property string $prefix
 */
 
class m140620_073243_update_catalog extends CDbMigration
{
    public function up(){
        $this->alterColumn('{{catalog}}', 'period', 'string');
        $this->addColumn('{{catalog}}', 'price_desc', 'string COMMENT "Услуга"');
    }

    public function down(){
        $this->alterColumn('{{catalog}}', 'period', 'integer');
        $this->dropColumn('{{catalog}}', 'price_desc');
    }
}