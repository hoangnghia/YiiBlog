<?php

/**
 * This is the model class for table "lists".
 *
 * The followings are the available columns in table 'lists':
 * @property string $list_id
 * @property string $name
 * @property string $board_id
 * @property string $date_create
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Cards[] $cards
 * @property Boards $board
 */
class Lists extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'lists';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('list_id, name, board_id, date_create', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('list_id, name, board_id', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('list_id, name, board_id, date_create, status', 'safe', 'on'=>'search'),
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
			'cards' => array(self::HAS_MANY, 'Cards', 'list_id'),
			'board' => array(self::BELONGS_TO, 'Boards', 'board_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'list_id' => 'List',
			'name' => 'Name',
			'board_id' => 'Board',
			'date_create' => 'Date Create',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('list_id',$this->list_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('board_id',$this->board_id,true);
		$criteria->compare('date_create',$this->date_create,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Lists the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function insertList($list_id, $name, $board_id)
	{
		$update = true;
		$model = Lists::getListbyListID($list_id);
		if($model === null)
		{
			$model = new Lists();
			$update = false;
		}		
		$model->list_id = $list_id;
		$model->name = $name;
		$model->board_id = $board_id;
		if($update)
		{
			if($model->save())
			{

			}
		}
		else{
			$model->insert();	
		}		
		
	}
	public static function updateList($list_id, $name, $board_id)
	{
		
		$model=Yii::app()->db->createCommand()
		->update('lists', array(
		    'name'=> $name,
		    'board_id'=>$board_id,
		), 'list_id=:id', array(':id'=>$list_id));

	}
	public static function getListbyListID($idList)
	{
		$model=Lists::model()->findByPk($idList);		
			
		return $model;
		
	}
	
}
