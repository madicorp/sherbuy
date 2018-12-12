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
class Post extends ContentActiveRecord implements Searchable
{
    /**
     * @inheritdoc
     */
    public $wallEntryClass = 'humhub\modules\post\widgets\WallEntry';

    /**
     * @inheritdoc
     */
    public $moduleId = 'post';

    /**
     * @inheritdoc
     */
    public $canMove = true;

    /**
     * Space limit modes (include or exclude)
     */
    const POST = "POST";
    const GOOD = "GOOD";
    const NEED = "NEED";
    const SERVICE = "SERVICE";

    /**
     * @var string the post type
     */
    public $type = self::POST;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'required'],
            [['message'], 'string'],
            [['type'], 'string'],
            [['url'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        // Check if Post Contains an Url
        if (preg_match('/http(.*?)(\s|$)/i', $this->message)) {
            // Set Filter Flag
            $this->url = 1;
        }

        return parent::beforeSave($insert);
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
        return Yii::t('PostModule.models_Post', 'post');
    }

    /**
     * @inheritdoc
     */
    public function getLabels($result = [], $includeContentName = true)
    {
        return parent::getLabels($result, false);
    }

    /**
     * Returns available Post types how to handle given spaces
     *
     * @return array the modes
     */
    public static function getPostTypes()
    {
        return [
            Post::POST => Yii::t('PostModule.base', 'Post'),
            Post::GOOD => Yii::t('PostModule.base', 'Good'),
            Post::NEED => Yii::t('PostModule.base', 'Need'),
            Post::SERVICE => Yii::t('PostModule.base', 'Service'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getIcon()
    {
        return 'fa-comment';
    }

    /**
     * @inheritdoc
     */
    public function getContentDescription()
    {
        return (new MarkdownPreview())->parse($this->message);
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
            'user' => $this->getPostAuthorName()
        ];

        $this->trigger(self::EVENT_SEARCH_ADD, new \humhub\modules\search\events\SearchAddEvent($attributes));

        return $attributes;
    }

    /**
     * @return string
     */
    private function getPostAuthorName()
    {
        $user = User::findOne(['id' => $this->created_by]);

        if ($user !== null && $user->isActive()) {
            return $user->getDisplayName();
        }

        return '';
    }

}
