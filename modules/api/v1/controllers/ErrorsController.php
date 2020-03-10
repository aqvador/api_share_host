<?php
/**
 * Project: api_remote_yii
 * User: achelnokov
 * Date: 02.03.2020г.
 * Time: 23:47
 */

namespace app\modules\api\v1\controllers;

use app\base\controllers\BaseRestController;
use app\modules\api\v1\controllers\actions\errors\ErrorsAction;


class ErrorsController extends BaseRestController
{
    public function actions()
    {
        return [
            'index' => ErrorsAction::class
        ];
    }
}