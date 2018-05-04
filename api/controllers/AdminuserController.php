<?php 
 
 namespace api\controllers;

 use yii;
 use yii\rest\ActiveController;
 use common\models\Adminuser;
 use api\models\ApiLoginForm;
 class AdminuserController extends ActiveController
 {


    public $modelClass = 'common\models\Adminuser';

//     public function behaviors() 
// {
//     return ArrayHelper::merge (parent::behaviors(), [ 
//             'authenticator' => [ 
//                 'class' => QueryParamAuth::className(),
//                 'optional' => [
//                     'login',
//                     'signup-test'
//                 ],
//             ] 
//     ] );
// }

    public function actionLogin()
    {
        $model = new ApiLoginForm();

        // $model->username =$_POST['username'];
        // $model->password = $_POST['password'];

         $model->load(Yii::$app->getRequest()->getBodyParams(), '');


        if ($model->login()) {
            return ['access_token' => $model->login()];
        }else{
            $model->validate();
            return $model;
        }
    }

 }


















 ?>