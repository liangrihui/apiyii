<?php 
namespace backend\models;

use yii\base\Model;
use common\models\Adminuser;
use yii\helpers\VarDumper;

/**
* 
*/
class SignupForm extends Model
{
	
	public $username;
	public $realname;
	public $password;
	public $password_repeat;
	public $email;
	

	public function rules()
	{
		return [
			['username', 'filter', 'filter' => 'trim'],
			['username', 'required'],
			['username', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '该用户名已经存在'],
			['username', 'string', 'min' => 4, 'max' => 255],

			['realname', 'required'],
			['realname', 'string', 'max' => 255],

			['email', 'filter', 'filter' => 'trim'],
			['email', 'email'],
			['email', 'required'],
			['email','string', 'max' => 255],
			['email', 'unique', 'targetClass' => '\common\models\Adminuser', 'message' => '该邮件地址已经存在'],

			['password', 'required'],
			['password', 'string', 'min' => 6],
			['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => '两次输入的密码不一样'],


		];
	}


	public function attributeLabels()
	{
		return [
			'username' => '用户名',
			'realname' => '昵称',
			'password_repeat' => '再次输入密码',
			'password' => '密码',
			'email' => '电子邮箱'
		];
	}


	public function signup()
	{
		if (!$this->validate()) {
			
			return null;
		}
		$user = new Adminuser();
		$user->username =$this->username;
		$user->realname = $this->realname;
		$user->email = $this->email;

		$user->setPassword($this->password);
		$user->generateAuthKey();
 // $user->save(); VarDumper::dump($user->errors);exit(0);
		return $user->save() ? $user : null;
	}












}




















 ?>