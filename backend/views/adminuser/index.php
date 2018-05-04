<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Adminuser;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员用户';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adminuser-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建管理员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        // 'layout'=> '{items}<div class="text-center tooltip-demo">{pager}</div>',
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            ['attribute' => 'id',
            'contentOptions' => ['width' => '40px'],
             
        ],
            'username',
            'realname',
            'email:email',
            // 'status',
            ['attribute' => 'status',
            'value' => 'statusStr',
            'filter' => Adminuser::allstatu()],
            //'password_hash',
            //'auth_key',
            //'password_reset_token',
            //'access_token',
            //'expire_at',
            // 'logged_at', 
            //'created_at',
            // ['attribute' => 'logged_at',
            // 'format' => ['date','php:Y-m-d H:i:s']],
             ['attribute' => 'created_at',
            'format' => ['date','php:Y-m-d H:i:s']],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn','header' => '操作',
            'template' => '{view} {update} {delete} {resetpwd} {privilege}',
            'buttons' => [
                'resetpwd' => function($url,$model,$key){
                    $options =[
                        'title' => Yii::t('yii','重置密码'),
                        'aria-label' => Yii::t('yii','重置密码'),
                        'data-pjxa' => '0',];
                        return Html::a('<span class="glyphicon glyphicon-lock"></span>',$url,$options);

                },
                'privilege'=>function($url,$model,$key)
                            {
                                $options=[
                                        'title'=>Yii::t('yii','权限'),
                                        'aria-label'=>Yii::t('yii','权限'),
                                        'data-pjax'=>'0',
                                ];
                                return Html::a('<span class="glyphicon glyphicon-user"></span>',$url,$options);
                            },
                // 'offshelf' => function ($url, $model, $key){
                //     return    $model['status'] ? Html::a('<span class="glyphicon glyphicon-remove"></span>',
                //         ['item/shelf'],
                //         ['title' => '下架商品', 'data' => ['method' => 'post', 'id' => $key, 'type' => 'off'], 'class'=> 'shelf']) : '';
                // },
            ],
        ],
        ],
    ]); ?>
</div>
