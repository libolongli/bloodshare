<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $id
 * @property integer $sex
 * @property string $realname
 * @property string $nickname
 * @property integer $age
 * @property string $phone
 * @property string $email
 * @property integer $province
 * @property integer $city
 * @property integer $county
 * @property string $address
 * @property integer $isill
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	private $_salt;
	protected function beforeSave()
	{
		$this->_salt = "qiuxue";
	    if(parent::beforeSave())
	    {
	        if($this->isNewRecord)
	        {
	            $this->password = md5(md5($this->_salt.$this->password));
	        }
	        return true;
	    }
	    else
	        return false;
	}
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nickname,email,phone,password','required'),
			array('sex, age, province, city, county, isill', 'numerical', 'integerOnly'=>true),
			array('id, realname, nickname, phone', 'length', 'max'=>20),
			array(' email, address', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('email','email'),
			array('sex, realname, nickname, age, phone, email, province, city, county, address, isill', 'safe', 'on'=>'search'),
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
			'sex' => '性别:',
			'realname' => '姓名:',
			'nickname' => '昵称:',
			'age' => '年龄:',
			'phone' => '电话号码:',
			'email' => '邮箱:',
			'province' => '省份:',
			'city' => '市',
			'county' => '县',
			'address' => '地址',
			'isill' => '是否有特殊疾病',
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
		$criteria->compare('sex',$this->sex);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('province',$this->province);
		$criteria->compare('city',$this->city);
		$criteria->compare('county',$this->county);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('isill',$this->isill);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}