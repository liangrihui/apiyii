<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Categorys;
use common\models\Article;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '文章管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'pager'=>[
               //'options'=>['class'=>'hidden']//关闭自带分页
               'firstPageLabel'=>"1",
                // 'prevPageLabel'=>'Prev',
                'nextPageLabel'=>'下一页',
                'lastPageLabel'=>'尾页',
      ],
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            ['attribute' => 'id',
            'contentOptions'=> ['width' => '20xp']],
            'title',
            // 'content:ntext',
            // 'category_id',
            ['attribute' => 'category_id',
            'value' => 'category.category_name',
            // 'filter' => Categorys::find()->select('category_name')->indexBy('id')->column(),
            'filter' => Article::AllCategory(),
        ],
            // 'status',
        ['attribute' => 'status',
        'value' => 'statusStr',
        'filter' => Article::AllStatus()],
            //'created_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {approve}',
            'buttons' => [
                'approve' =>function($url,$model,$key)//渲染回调函数 为按钮创建的URl 当前渲染模型对象 数据提供者数组中的模型键
                {
                    $options=[
                        'title' =>Yii::t('yii','审核'), 
                        // 'aria-label' =>Yii::t('yii','审核'),
                        'data-confirm' =>Yii::t('yii',$model->status==0?'你确定审核通过这篇文章吗？':'你把这篇文章设为草稿吗？'),
                        'data-method' =>'post',
                        'data-pjax'=>'0',];
                    return Html::a('<span class="glyphicon glyphicon-check"></span>',$url,$options);
                },
            ],],
        ],
        // 'template' => '<tr><th style="width:130px;text-align:center;">{label}</th><td>{value}</td></tr>',
        // 'options' => ['class' => 'table table-striped table-bodered detail-view',]
    ]); ?>
</div>
