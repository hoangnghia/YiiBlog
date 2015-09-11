<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $post_ID
 * @property string $post_title
 * @property string $post_content
 * @property integer $category_id
 * @property string $date
 *
 * The followings are the available model relations:
 * @property Category $category
 */
class Post extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id', 'numerical', 'integerOnly'=>true),
			array('post_title', 'length', 'max'=>255),
			array('post_content, date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('post_ID, post_title, post_content, category_id, date', 'safe', 'on'=>'search'),
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
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'post_ID' => 'Post',
			'post_title' => 'Post Title',
			'post_content' => 'Post Content',
			'category_id' => 'Category',
			'date' => 'Date',
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

		$criteria->compare('post_ID',$this->post_ID);
		$criteria->compare('post_title',$this->post_title,true);
		$criteria->compare('post_content',$this->post_content,true);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Post the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function Get_Detail_Post($id)
	{			
		// return Yii::app()->db->createCommand()
		// 		    ->select('post_ID, post_title, post_content, category_id, date')
		// 		    ->from('post')
		// 		    ->where('post_ID=:id', array(':id'=>$id))//where($condition, $params) 
		// 		    ->queryRow();

		$sql = "SELECT * FROM post WHERE post_ID =". $id;
		$dependency = new CDbCacheDependency('SELECT MAX(post_ID) FROM post');
		return Yii::app()->db->cache(1000, $dependency)->createCommand($sql)->queryRow();

		 

	}
	public static function Search_Blogs($key)
	{
		// return Yii::app()->db->createCommand()
		// 			 ->select('post_ID, post_title, post_content, category_id, date')
		// 		    ->from('post')
		// 		    ->where('post_title like :key', array(':key'=>$key))//where($condition, $params) 
		// 		    ->queryAll();
		$sql = "SELECT * FROM post WHERE post_title LIKE '%".$key."%'";
		$dependency = new CDbCacheDependency('SELECT MAX(post_ID) FROM post');
		return Yii::app()->db->cache(1000, $dependency)->createCommand($sql)->queryAll();
	}
	public static function Get_All_Post()
	{
		return Yii::app()->db->createCommand()
					 ->select('post_ID, post_title, post_content, category_id, date')
				    ->from('post')				    
				    ->queryAll();

	}
	public static function Get_New_Post()
	{
		return Yii::app()->db->createCommand()
					->select('post_ID, post_title, post_content, category_id, date')
				    ->from('post')				    
				    ->limit(5)
				    ->order('post_ID DESC ')
				    ->queryAll();	
		// $sql = "SELECT * FROM post order by post_ID DESC limit 5";
		// $dependency = new CDbCacheDependency('SELECT MAX(post_ID) FROM post');
		// return Yii::app()->db->cache(1000, $dependency)->createCommand($sql)->queryRow();	
	}
	

}
