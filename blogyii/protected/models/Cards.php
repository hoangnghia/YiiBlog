<?php

/**
 * This is the model class for table "cards".
 *
 * The followings are the available columns in table 'cards':
 * @property string $card_id
 * @property string $name
 * @property string $desc
 * @property string $due
 * @property string $list_id
 * @property integer $status
 * @property string $date_create
 *
 * The followings are the available model relations:
 * @property Lists $list
 */
class Cards extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cards';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('card_id, name, desc, due, list_id, date_create', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('card_id, name, desc, list_id', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('card_id, name, desc, due, list_id, status, date_create', 'safe', 'on'=>'search'),
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
			'list' => array(self::BELONGS_TO, 'Lists', 'list_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'card_id' => 'Card',
			'name' => 'Name',
			'desc' => 'Desc',
			'due' => 'Due',
			'list_id' => 'List',
			'status' => 'Status',
			'date_create' => 'Date Create',
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

		$criteria->compare('card_id',$this->card_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('desc',$this->desc,true);
		$criteria->compare('due',$this->due,true);
		$criteria->compare('list_id',$this->list_id,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_create',$this->date_create,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cards the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function insertCard($card_id, $name, $desc, $due, $list_id)
	{
		$update = true;
		$model= Cards::getCardbyCardID($card_id);
		{
			if($model === null)
			{
				$model = new Cards();
				$update = false;
			}
		}
		$model->card_id = $card_id;
		$model->name = $name;
		$model->desc = $desc;
		$model->due = $due;
		$model->list_id = $list_id;
		if($update)
		{
			if($model->save())
			{

			}
		}
		else
		{
			$model->insert();	
		}
		
		
	}
	public static function updateCard($card_id, $name, $desc, $due, $list_id)
	{
		
		$model=Yii::app()->db->createCommand()
		->update('cards', array(
		    'name'=> $name,
		    'desc'=> $desc,
		    'due'=> $due,
		    'list_id'=>$list_id,
		), 'card_id=:id', array(':id'=>$card_id));

	}
	public static function getCardbyCardID($idCart)
	{
		$model=Cards::model()->findByPk($idCart);		
			
		return $model;
		
	}

}
