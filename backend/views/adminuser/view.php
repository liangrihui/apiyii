<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = $model->realname;
$this->params['breadcrumbs'][] = ['label' => 'Adminusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->username;
?>
<div class="adminuser-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除这个用户吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'realname',
            'email:email',
            // 'status',
            // 'password_hash',
            // 'auth_key',
            // 'password_reset_token',
            // 'access_token',
            // 'expire_at',
            // 'logged_at',
            // 'created_at',
            // 'updated_at',
            ['attribute' => 'status',
            'value' => $model->statusStr,], 
            ['attribute' => 'created_at',
            'value' => date('Y-m-d H:i:s',$model->created_at),],
             
        ],
    ]) ?>

</div>
