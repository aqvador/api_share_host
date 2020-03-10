<?php
/**
 * Project: api_remote_yii
 * User: achelnokov
 * Date: 02.03.2020г.
 * Time: 23:52
 */

namespace app\base\controllers;


use yii\filters\auth\HttpBearerAuth;
use yii\filters\Cors;
use yii\rest\Controller;
use  Yii;

class BaseRestController extends Controller
{
    public $serializer = 'app\base\Serializer';

    public function runAction($id, $params = [])
    {
        return parent::runAction($id, array_merge(Yii::$app->request->post(), $params));
    }
}