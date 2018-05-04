<?php 
namespace api\controllers;

use yii\rest\Controller;
use yii\models\Actricle;
use yii\db\Query;
class TopController extends Controller
{

	public function actionIndex()
	{
		$top10 = (new Query())
		->from('article')
		->select(['created_by','Count(id) as creatercount'])
		->groupBy(['created_by'])
		->orderBy('creatercount DESC')
		->limit(10)
		->all();
		return $top10;
	}
}



 ?>