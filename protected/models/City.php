<?php

/**
 * This is the model class for table "{{city}}".
 *
 * The followings are the available columns in table '{{city}}':
 * @property string $id
 * @property string $parentid
 * @property string $name
 * @property integer $level
 * @property string $first
 * @property integer $ismunicipality
 * @property integer $hasschool
 */
class City extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return City the static model class
	 */
	
	private static $_items = array();
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{city}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('level, ismunicipality, hasschool', 'numerical', 'integerOnly'=>true),
			array('parentid', 'length', 'max'=>5),
			array('name', 'length', 'max'=>120),
			array('first', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, parentid, name, level, first, ismunicipality, hasschool', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parentid' => 'Parentid',
			'name' => 'Name',
			'level' => 'Level',
			'first' => 'First',
			'ismunicipality' => 'Ismunicipality',
			'hasschool' => 'Hasschool',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('parentid',$this->parentid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('first',$this->first,true);
		$criteria->compare('ismunicipality',$this->ismunicipality);
		$criteria->compare('hasschool',$this->hasschool);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
public static  function items($type)
	{
		if(!isset(self::$_items[$type])) self::loadItems($type);
		return self::$_items[$type];
	}
	
	public static function item($type,$code)
	{
		if(!isset(self::$_items[$type])) self::loadItems($type);
		return isset(self::$_items[$type][$code])?self::$_items[$type][$code]:false;
	}
	
	public static function loadItems($type)
	{
		self::$_items[$type] = array();
		$models = self::model()->findAll(
			array('condition'=>'parentid=:type',
				'params'=>array(':type'=>$type),
				'order'=>'id',
			)
		);
		foreach($models as $model) 
			self::$_items[$type][$model->id] = $model->name;
	}
	
}