<?php
/**
 * Миграция m140223_151957_materials_and_places
 *
 * @property string $prefix
 */
 
class m140223_151957_materials_and_places extends CDbMigration
{
    // таблицы к удалению, можно использовать '{{table}}'
	private $dropped = array('{{materials}}','{{places}}');
    //, '{{catalog_materials}}', '{{catalog_places}}'
 
    public function safeUp()
    {
        $this->_checkTables();
 
        $this->createTable('{{materials}}', array(
            'id' => 'pk', // auto increment
			'name' => "string NOT NULL COMMENT 'Название'",
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        $this->createTable('{{places}}', array(
            'id' => 'pk', // auto increment
            'name' => "string NOT NULL COMMENT 'Название'",
            'coords' => "string COMMENT 'Координаты'"
        ),
        'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        // $this->createTable('{{catalog_materials}}', array(
        //     'catalog_id' => "int",
        //     'material_id' => "int",
        //     'PRIMARY KEY (`catalog_id`, `material_id`)'
        // ),
        // 'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');

        // $this->createTable('{{catalog_places}}', array(
        //     'catalog_id' => "int",
        //     'place_id' => "int",
        //     'PRIMARY KEY (`catalog_id`, `place_id`)'
        // ),
        // 'ENGINE=MyISAM DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci');
    }
 
    public function safeDown()
    {
        $this->_checkTables();
    }
 
    /**
     * Удаляет таблицы, указанные в $this->dropped из базы.
     * Наименование таблиц могут сожержать двойные фигурные скобки для указания
     * необходимости добавления префикса, например, если указано имя {{table}}
     * в действительности будет удалена таблица 'prefix_table'.
     * Префикс таблиц задается в файле конфигурации (для консоли).
     */
    private function _checkTables ()
    {
        if (empty($this->dropped)) return;
 
        $table_names = $this->getDbConnection()->getSchema()->getTableNames();
        foreach ($this->dropped as $table) {
            if (in_array($this->tableName($table), $table_names)) {
                $this->dropTable($table);
            }
        }
    }
 
    /**
     * Добавляет префикс таблицы при необходимости
     * @param $name - имя таблицы, заключенное в скобки, например {{имя}}
     * @return string
     */
    protected function tableName($name)
    {
        if($this->getDbConnection()->tablePrefix!==null && strpos($name,'{{')!==false)
            $realName=preg_replace('/{{(.*?)}}/',$this->getDbConnection()->tablePrefix.'$1',$name);
        else
            $realName=$name;
        return $realName;
    }
 
    /**
     * Получение установленного префикса таблиц базы данных
     * @return mixed
     */
    protected function getPrefix(){
        return $this->getDbConnection()->tablePrefix;
    }
}