<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
?>
<?php echo "<?php\n"; ?>

/**
* This is the model class for table "<?php echo $tableName; ?>".
*
* The followings are the available columns in table '<?php echo $tableName; ?>':
<?php foreach($columns as $column): ?>
    * @property <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
<?php if(!empty($relations)): ?>
    *
    * The followings are the available model relations:
    <?php foreach($relations as $name=>$relation): ?>
        * @property <?php
        if (preg_match("~^array\(self::([^,]+), '([^']+)', '([^']+)'\)$~", $relation, $matches))
        {
            $relationType = $matches[1];
            $relationModel = $matches[2];

            switch($relationType){
                case 'HAS_ONE':
                    echo $relationModel.' $'.$name."\n";
                    break;
                case 'BELONGS_TO':
                    echo $relationModel.' $'.$name."\n";
                    break;
                case 'HAS_MANY':
                    echo $relationModel.'[] $'.$name."\n";
                    break;
                case 'MANY_MANY':
                    echo $relationModel.'[] $'.$name."\n";
                    break;
                default:
                    echo 'mixed $'.$name."\n";
            }
        }
        ?>
    <?php endforeach; ?>
<?php endif; ?>
*/
class <?php echo $modelClass; ?> extends <?php echo $this->baseClass."\n"; ?>
{
    public function tableName()
    {
        return '<?php echo $tableName; ?>';
    }


    public function rules()
    {
        return array(
        <?php foreach($rules as $rule): ?>
    <?php echo $rule.",\n"; ?>
        <?php endforeach; ?>
    // The following rule is used by search().
            array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe', 'on'=>'search'),
        );
    }


    public function relations()
    {
        return array(
        <?php foreach($relations as $name=>$relation): ?>
            <?php echo "'$name' => $relation,\n"; ?>
        <?php endforeach; ?>
);
    }


    public function attributeLabels()
    {
        return array(
    <?php foreach($labels as $name=>$label): ?>
        <?php echo "'$name' => '$label',\n"; ?>
    <?php endforeach; ?>
    );
    }


<?php if ( $behaviors !== null ): ?>
    public function behaviors()
    {
        return CMap::mergeArray(parent::behaviors(), array(
        <?php foreach ($behaviors as $behavior)
            echo $behavior;
        ?>
        ));
    }
<?php endif; ?>
    public function search()
    {
        $criteria=new CDbCriteria;
<?php
foreach($columns as $name=>$column)
{
    if($column->type==='string')
    {
        echo "\t\t\$criteria->compare('$name',\$this->$name,true);\n";
    }
    else
    {
        echo "\t\t\$criteria->compare('$name',\$this->$name);\n";
    }
}
?>
<?php if(isset($columns['sort'])): ?>
        $criteria->order = 'sort';
<?php endif; ?>
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
<?php if($connectionId!='db'):?>
    public function getDbConnection()
    {
    return Yii::app()-><?php echo $connectionId ?>;
    }

<?php endif?>

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
<?php if ( !empty($this->translition) ): ?>

    public function translition()
    {
        return '<?php echo $this->translition; ?>';
    }
<? endif; ?>

<?php echo $this->generateBeforeSave($columns); ?>

<?php echo $this->generateAfterFind($columns); ?>
}
