<?php

namespace common\models;

use Yii;
use common\models\Categorys;

/**
 * This is the model class for table "article".
 *
 * @property int $id ID
 * @property string $title 标题
 * @property string $content 内容
 * @property int $category_id 分类
 * @property int $status 状态
 * @property int $created_by 创建人
 * @property int $created_at 创建时间
 * @property int $updated_at 最后修改时间
 *
 * @property Adminuser $createdBy
 */
class Article extends \yii\db\ActiveRecord
{

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 10;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'title', 'content'], 'required'],
            [[ 'category_id', 'status', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 512],
            
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Adminuser::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }
 
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'category_id' => '类别',
            'status' => '状态',
            'created_by' => '创建者',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    // 为API的字段进行设置
    public function fields()
    {
        return [
            'id',
            'content',
            '标题' => 'title',
            'status' => function($model){
                return $model->getStatusStr();
            },
            // 'status' => function($model){
            //     return $model->status==self::STATUS_DRAFT?'草稿':'已发布';
            // },
            '作者 ' =>function($model){
                return $model->createdBy->username;
            }];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Adminuser::className(), ['id' => 'created_by']);
    }

    public function getCategory()
    {
        return $this->hasOne(Categorys::className(),['id' => 'category_id']);
    }

    public static function AllCategory()
    {
        return Categorys::find()->select('category_name')->indexBy('id')->column();

    }

    public function getStatusStr()
    {
        return $this->status == self::STATUS_PUBLISHED ? '发布':'草稿';
    }

    public static function AllStatus()
    {
        return [self::STATUS_PUBLISHED => '发布',self::STATUS_DRAFT => '草稿'];
    }

    public function approve()
    {
        if ($this->status==0) {
            
        $this->status = 10;
        }else{
        $this->status=0;
        }
        return ($this->save() ? true :false);
    }

    public function getContents($length)
    {
        $cont = strip_tags($this->content);
        $len = mb_strlen($cont);
        return mb_substr($con, $length, 'utf-8').($len>$length? '.....':'');
    }

    public function beforeSave($inset)
    {
        if (parent::beforeSave($inset)) {
            # code...
        if ($inset) {
            # code...
            $this->created_at=time();
            $this->updated_at=time();
        }else{
            $this->updated_at=time();
        }
        return true;
        }else{
            return false;
        }

    }


}
