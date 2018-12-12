<?php

use humhub\modules\content\widgets\richtext\RichTextField;
use humhub\modules\post\models\Post;
?>
<div class="form-group">
    <?php foreach (Post::getPostTypes() as $key => $type) :?>
        <label class="radio-inline radio-<?= strtolower($key); ?>">
            <input  <?= $key === "POST" ? "checked" : ""; ?> type="radio" name="type" value="<?= $key; ?>">
            <?= $type; ?>
        </label>
    <?php endforeach;?>
</div>
<?= RichTextField::widget([
    'id' => 'contentForm_message',
    'layout' => RichTextField::LAYOUT_INLINE,
    'pluginOptions' => ['maxHeight' => '300px'],
    'placeholder' => Yii::t("PostModule.widgets_views_postForm", "What's on your mind?"),
    'name' => 'message',
    'disabled' => (property_exists(Yii::$app->controller, 'contentContainer') && Yii::$app->controller->contentContainer->isArchived()),
    'disabledText' => Yii::t("PostModule.widgets_views_postForm", "This space is archived."),
]); ?>
