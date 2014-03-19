<?php
/**
 * Миграция m140318_165251_update_contacts
 *
 * @property string $prefix
 */
 
class m140318_165251_update_contacts extends CDbMigration
{
    public function up(){
        $this->addColumn('{{contacts}}', 'email', 'string COMMENT "E-mail"');
    }

    public function down(){
        $this->dropColumn('{{contacts}}', 'email');
    }
}