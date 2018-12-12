<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2016 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\post\models;

use Yii;
use humhub\libs\MarkdownPreview;
use humhub\modules\content\widgets\richtext\RichText;
use humhub\modules\content\components\ContentActiveRecord;
use humhub\modules\search\interfaces\Searchable;
use humhub\modules\user\models\User;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $message_2trash
 * @property string $message
 * @property string $type
 * @property string $url
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Need extends Post
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'need';
    }


    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {

        parent::afterSave($insert, $changedAttributes);
        RichText::postProcess($this->message, $this);
    }

    /**
     * @inheritdoc
     */
    public function getContentName()
    {
        return Yii::t('PostModule.models_Need', 'need');
    }

    /**
     * @inheritdoc
     */
    public function getIcon()
    {
        return 'fa-question-circle';
    }

    /**
     * @inheritdoc
     */
    public function getSearchAttributes()
    {
        $attributes = [
            'message' => $this->message,
            'type' => $this->type,
            'url' => $this->url,
            'user' => $this->getNeedAuthorName()
        ];

        $this->trigger(self::EVENT_SEARCH_ADD, new \humhub\modules\search\events\SearchAddEvent($attributes));

        return $attributes;
    }

    /**
     * @return string
     */
    private function getNeedAuthorName()
    {
        $user = User::findOne(['id' => $this->created_by]);

        if ($user !== null && $user->isActive()) {
            return $user->getDisplayName();
        }

        return '';
    }

}
