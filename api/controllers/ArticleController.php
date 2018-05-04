<?php 
namespace api\controllers;

use yii\rest\ActiveController;
use common\models\Article;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\filters\auth\QueryParamAuth;
use yii\filters\auth\HttpBasicAuth;
use common\models\Adminuser;

class ArticleController extends ActiveController
{
	public $modelClass= 'common\models\Article';


	//为API控制器设置认证 需要令牌才能操作
	public function behaviors()
	{
		return ArrayHelper::merge(parent::behaviors(),[
				'authenticatior' => ['class' => QueryParamAuth::className()]]);
	}
// Http 基本认证
	// public function behaviors()
	// {
	// 	return ArrayHelper::merge(parent::behaviors(),[
	// 			'authenticatior' => [
	// 				'class' => HttpBasicAuth::className(),
	// 				'auth' => function($username,$password)
	// 				{
	// 					$user =Adminuser::find()->where(['username' => $username])->one();
	// 					if ($user->validatePassword($password)) {
	// 						return $user;
	// 					}else{
	// 						return null;
	// 					}
	// 				}
	// 			]
	// 		]
	// 	);
	// }


	public function actions()
	{
		$actions =parent::actions();

		unset($actions['index']);
		return $actions;
	}

	public function actionIndex()
	{
		$modelClass =$this->modelClass;
		return new ActiveDataProvider([
			'query' => $modelClass::find()->asArray(),
			'pagination' => ['pageSize' => 5],

		]);

	}

	public function actionSearch() {
        return Article::find()->where(['like','title',$_POST['keyword']])->all();
    }

}











 ?>