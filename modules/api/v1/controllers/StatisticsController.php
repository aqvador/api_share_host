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
use yii\web\NotFoundHttpException;

class StatisticsController extends BaseRestController
{
    public $prefixRecord = '/srv/rsync/';

    /**
     * @param $path
     *
     * @return \yii\console\Response|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionRecord($path)
    {
        $fullPath = $this->prefixRecord . DIRECTORY_SEPARATOR . trim($path, '/');
        if ($files = glob($fullPath . '*')) {
            $file = $this->wavToMp3($files[0]);
            return Yii::$app->response->sendFile($file, pathinfo($file));
        }
        throw new NotFoundHttpException("The file is missing or deleted");
    }

    /**
     * @param string $file
     *
     * @return string
     */
    private function wavToMp3($file)
    {
        $mp3File = str_replace('.wav', '.mp3', $file);
        if (pathinfo($file, FILEINFO_EXTENSION) === 'wav') {
            exec("lame --cbr -b 32k {$file} {$mp3File}");
            if (file_exists($mp3File)) {
                $this->extension = '.mp3';
                exec("rm -f $file");
                return $mp3File;
            }
        }
        return $file;
    }
}