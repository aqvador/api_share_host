<?php
/**
 * Project: api_remote_yii
 * User: achelnokov
 * Date: 02.03.2020г.
 * Time: 19:44
 */

return [
    'errorHandler' => [
        'errorAction' => 'v1/errors'
    ],
    'request' => [
        'parsers' => [
            'application/json' => 'yii\web\JsonParser'
        ],
        'enableCsrfCookie' => false,
        'enableCsrfValidation' => false,
        'enableCookieValidation' => false,
    ],
    'user' => [
        'identityClass' => 'app\modules\api\AuthUser',
        'enableSession' => false,
        'identityCookie' => false,
        'loginUrl' => false
    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'enableStrictParsing' => true,

        'showScriptName' => false,
        'rules' => [
            'record' => 'api/v1/statistics/record',
            [
                'class' => 'yii\rest\UrlRule',
                'controller' => ['v1/statistics'],
                'pluralize' => false,
                'prefix' => 'api',
                'extraPatterns' => [
                    'GET,POST record' => 'record',
                    'GET,POST getFile' => 'record',
                    'GET,POST get-file' => 'record',
                ],
            ],
            '<url:(.*)>' => 'v1/errors',
        ],
    ],
    /*
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
        ],
    ],
    */
];