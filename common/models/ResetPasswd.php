<?php 
 namespace common\models;

 use yii\base\Model;
 use common\models\User;
 use common\models\Adminuser;


 class ResetPasswd extends Model
 {

 	public $password;
 	public $password_repeat;



 	public function rules()
 	{
 		return [
 			['password','required'],
 			['password','string','min'=> 6,'max' => '255'],

 			['password_repeat','compare','compareAttribute' => 'password','message'=>'两次输入的密码不一样'],
 		];
 	}

 	public function attributeLabels()
 	{
 		return [
 		'password' => '密码',
 		'password_repeat' => '再次输入密码'];

 	}

 	public function u_resetpasswd($id)
 	{
 		
 		$user = User::findOne($id);
 		$user->setPassword($this->password);
 		$user->removePasswordResetToken();
 		return $user->save() ? true : null;
 	}
 	public function a_resetpasswd($id)
 	{	
 		$user = Adminuser::findOne($id);

 		$user->setPassword($this->password);
 		$user->removePasswordResetToken();
 		return $user->save() ? true : false;
 	}


 }













 ?>