<?php
/**
 * Project: api_remote_yii
 * User: achelnokov
 * Date: 02.03.2020г.
 * Time: 23:32
 */

namespace app\modules\api;


use app\base\active_record\SettingsClient;
use yii\base\InvalidArgumentException;
use yii\web\IdentityInterface;
use Yii;
use yii\web\UnauthorizedHttpException;

class AuthUser extends SettingsClient implements IdentityInterface
{

    /**
     * @inheritDoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => [':id' => $id]]);
    }

    /**
     * @param mixed $token
     * @param null  $type
     *
     * @return AuthUser|array|bool|\yii\db\ActiveRecord|IdentityInterface|null
     * @throws UnauthorizedHttpException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        Yii::info($token, 'token');

        if (Yii::$app->params['api_token'] === false) {
            throw new InvalidArgumentException('Token not found on the server');
        }
        if ($token === Yii::$app->params['api_token']) {
            if (static::find()->count() === 1) {
                return static::find()->one();
            }
            if ($contract = Yii::$app->request->getHeaders()->get('X-Contract')) {
                return static::findOne(['client_id' => [':client_id' => $contract]]);
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @inheritDoc
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function getContract()
    {
        return $this->client_id;
    }
}