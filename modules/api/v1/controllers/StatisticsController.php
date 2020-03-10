<?php
/**
 * Project: api_remote_yii
 * User: achelnokov
 * Date: 02.03.2020г.
 * Time: 20:00
 */

namespace app\modules\api\v1\controllers;


use app\base\controllers\BaseRestController;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class StatisticsController extends BaseRestController
{
    public $prefixRecord = '/srv/rsync/';

    /**
     * @return \yii\console\Response|\yii\web\Response
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionCallRecording()
    {
        $params = Yii::$app->request->getBodyParam('path');
        $path = (!empty($params)) ? $params : Yii::$app->request->getBodyParam('record');
        if ($path) {
            $fullPath = $this->prefixRecord . trim($path, '/');
            if ($files = glob($fullPath . '*')) {
                $file = $this->wavToMp3($files[0]);
                return Yii::$app->response->sendFile($file, basename($file));
            }
            throw new NotFoundHttpException("The file is missing or deleted");
        }
        throw new BadRequestHttpException("The `path` or `record` parameter could not be determined");
    }

    /**
     * @param string $file
     *
     * @return string
     */
    private function wavToMp3($file)
    {
        $mp3File = str_replace('.wav', '.mp3', $file);
        if (pathinfo($file, PATHINFO_EXTENSION) === 'wav') {
            exec("lame --cbr -b 32k {$file} {$mp3File}");
            if (file_exists($mp3File)) {
                exec("rm -f $file");
                return $mp3File;
            }
        }
        return $file;
    }
}