<?php

/**
 * This is the model class for table "boards".
 *
 * The followings are the available columns in table 'boards':
 * @property string $board_id
 * @property string $user_id
 * @property string $name
 * @property string $date_create
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Lists[] $lists
 */
class Boards extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'boards';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('board_id, user_id, name, date_create', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('board_id, user_id, name', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('board_id, user_id, name, date_create, status', 'safe', 'on'=>'search'),
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
			'lists' => array(self::HAS_MANY, 'Lists', 'board_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'board_id' => 'Board',
			'user_id' => 'User',
			'name' => 'Name',
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

		$criteria->compare('board_id',$this->board_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name,true);
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
	 * @return Boards the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function insertBoard($board_id, $name, $user_id)
	{
		$update = true;
		$model = Boards::getBoardbyBoardID($board_id);
		if($model === null){
			$model = new Boards();
			$update = false;
		}
		$model->board_id = $board_id;
		$model->name = $name;
		$model->user_id = $user_id;
		
		if($update)
		{
			if($model->save()){
			
			}
		}
		else{
			$model->insert();
		}

	}
	public static function updateBoard($board_id, $name)
	{
		
		$model=Yii::app()->db->createCommand()
		->update('boards', array(
		    'name'=>'$name',
		), 'board_id=:id', array(':id'=>$board_id));

	}
	public static function getBoardbyBoardID($idBoard)
	{
		$model=Boards::model()->findByPk($idBoard);		
			
		return $model;

		// return Yii::app()->db->createCommand()
		// 			 ->select('board_id')
		// 		    ->from('boards')
		// 		    ->where('board_id like :key', array(':key'=>$idBoard))
		// 		    ->queryAll();
		
	}
}
