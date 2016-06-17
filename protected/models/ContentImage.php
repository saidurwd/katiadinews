<?php

/**
 * This is the model class for table "{{content_image}}".
 *
 * The followings are the available columns in table '{{content_image}}':
 * @property integer $id
 * @property integer $content
 * @property string $title
 * @property string $content_image
 * @property string $created
 */
class ContentImage extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{content_image}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('created', 'required'),
            array('content', 'numerical', 'integerOnly' => true),
            array('title, content_image', 'length', 'max' => 250),
            //array('content_image', 'file', 'types' => 'jpg,jpeg,gif,png', 'allowEmpty' => true, 'minSize' => 2, 'maxSize' => 1024 * 1024 * 5, 'tooLarge' => 'The file was larger than 5MB. Please upload a smaller file.', 'wrongType' => 'File format was not supported.', 'tooSmall' => 'File size was too small or empty.'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, content, title, content_image, created', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'content' => 'Content',
            'title' => 'Title',
            'content_image' => 'More Images',
            'created' => 'Created',
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
    public function search($id) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        $criteria->alias = 't';
        $criteria->condition = 't.content=' . (int) $id;

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.content', $this->content);
        $criteria->compare('t.title', $this->title, true);
        $criteria->compare('t.content_image', $this->content_image, true);
        $criteria->compare('t.created', $this->created, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            ),
            'sort' => array('defaultOrder' => 't.created DESC')
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ContentImage the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}