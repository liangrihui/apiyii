<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use yii\bootstrap\ActiveForm;

$this->title ='重置密码';
$this->params['breadcrumbs'][]= ['label' =>'管理员用户','url' =>['index']];
$this->params['breadcrumbs'][]= $this->title;


 ?>
 <div class="password-reset">
 	<div class="user-form">
 		<?php 
 		$form=ActiveForm::begin();
 		echo $form->field($model,'password')->passwordInput(['maxlength' => true]);
 		echo $form->field($model,'password_repeat')->passwordInput();

 		 ?>
 		 <div class="form-group">
 		 	<?php echo Html::submitButton('重置',['class' => 'btn btn-success']); ?>
 		 </div>
 		 <?php ActiveForm::end(); ?>
 	</div>
 </div>