<?php
/**
 * Project: api_remote_yii
 * User: achelnokov
 * Date: 03.03.2020г.
 * Time: 0:26
 */

namespace app\modules\api\v1\controllers\actions\errors;

use yii\base\UserException;
use yii\web\ErrorAction;
use Yii;

class ErrorsAction extends ErrorAction
{
    public function run()
    {
        Yii::$app->getResponse()->setStatusCodeByException($this->exception);
        return ['code' => $this->getExceptionCode(), 'message' => $this->getExceptionMessage()];
    }

    protected function getExceptionMessage()
    {
        if ($this->getExceptionCode() == 404) {
            return 'Method not allowed or not found';
        }
        if ($this->getExceptionCode() == 500) {
            return 'Something went wrong';
        }
        if ($this->exception instanceof UserException) {
            return $this->exception->getMessage();
        }

        return $this->defaultMessage;
    }

}