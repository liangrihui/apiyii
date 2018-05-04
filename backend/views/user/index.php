<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            ['attribute' => 'id',
            'contentOptions' => ['width' => '20px'],],
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            //'status',
            ['attribute' => 'status',
            'value' => 'StatuStr',
            'filter' => User::allStatu()],
            //'created_at',
            // 'updated_at',
            ['attribute' => 'updated_at',
            'format' => ['date','php:Y-m-d :H:i:s']],

            ['class' => 'yii\grid\ActionColumn',
            'template' => '{view}  {update}  {delete}  {resetpwd}  {privilege}',
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
            ],
        ],
        ],
    ]); ?>
</div>
