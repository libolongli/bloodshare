<?php
class Register extends CFormModel
{
	
	/**
	 * @author Nomius 2013.06.25 create
	 * create rules
	 */
	public function rules()
	{
		return array(
			//for improve register rating ,just need fill username & email
			array('nickname,email','requried'), 
			// email format checking
			array('email','email'),
			
		);
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'tags' => 'Tags',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'update_time' => 'Update Time',
			'author_id' => 'Author',
		);
	}
}