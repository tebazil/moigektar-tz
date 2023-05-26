<?php


namespace app\controllers;


use app\commands\ServiceController;
use yii\console\widgets\Table;
use yii\web\Controller;

class ConsoleController extends Controller
{
    public function actionIndex()
    {
        \Yii::$container->set(Table::class, ['screenWidth' => 800]);
        ob_start();
        \Yii::$container->get(ServiceController::class)->actionRun($_GET['cadastreNumbers'] ?? '');
        $result = ob_get_clean();
        return $this->renderPartial('index', ['result' => $result]);
    }
}