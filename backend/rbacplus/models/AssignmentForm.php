<?php

namespace app\rbacplus\models;

use Yii;
use yii\base\Model;
use yii\rbac\Item;

abstract class AuthItem extends \johnitvn\rbacplus\models\AuthItem {

    public function uniqueValidator() {
        $authManager = Yii::$app->authManager;
        $value = $this->name;
        if ($authManager->getRole($value) !== null || $authManager->getPermission($value) !== null) {
            $message = Yii::t('yii', '{attribute} "{value}" has already been taken.');
            $params = [
                'attribute' => $this->getAttributeLabel('name'),
                'value' => $value,
            ];
            $this->addError('name', Yii::$app->getI18n()->format($message, $params, Yii::$app->language));
        }
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['ruleName'], 'in',
                'range' => array_keys(Yii::$app->authManager->getRules()),
                'message' => Yii::t('rbac', 'Rule not exists')],
            [['name'], 'required'],
            [['name'], 'uniqueValidator', 'when' => function() {
            return $this->isNewRecord || ($this->item->name != $this->name);
        }],
            [['description', 'data', 'ruleName'], 'default'],
            [['name'], 'string', 'max' => 64]
        ];
    }
}
