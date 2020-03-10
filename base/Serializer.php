<?php
/**
 * Project: lk4.alltel24.ru
 * User: achelnokov
 * Date: 28.02.2020г.
 * Time: 23:35
 */

namespace app\base;


use yii\rest\Serializer as YiiRestSerializer;

class Serializer extends YiiRestSerializer
{
    protected function getRequestedFields()
    {
        $fields = $this->request->get($this->fieldsParam)
            ? $this->request->get($this->fieldsParam)
            : $this->request->getBodyParam($this->fieldsParam);

        $expand = $this->request->get($this->expandParam)
            ? $this->request->get($this->expandParam)
            : $this->request->getBodyParam($this->expandParam);

        return [
            is_string($fields) ? preg_split('/\s*,\s*/', $fields, -1, PREG_SPLIT_NO_EMPTY) : [],
            is_string($expand) ? preg_split('/\s*,\s*/', $expand, -1, PREG_SPLIT_NO_EMPTY) : [],
        ];
    }
}