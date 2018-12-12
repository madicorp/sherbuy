<?php

/**
 * @link https://www.humhub.org/
 * @copyright Copyright (c) 2015 HumHub GmbH & Co. KG
 * @license https://www.humhub.com/licences
 */

namespace humhub\modules\post\controllers;

use humhub\modules\content\widgets\WallCreateContentForm;
use humhub\modules\content\components\ContentContainerController;
use humhub\modules\post\models\Good;
use humhub\modules\post\models\Need;
use humhub\modules\post\models\Post;
use humhub\modules\post\models\Service;
use humhub\modules\post\permissions\CreatePost;
use Yii;

/**
 * @package humhub.modules_core.post.controllers
 * @since 0.5
 */
class PostController extends ContentContainerController
{

    public function actionPost()
    {
        // Check createPost Permission
        if (!$this->contentContainer->getPermissionManager()->can(new CreatePost())) {
            return [];
        }
        $post = null;
        $type = Yii::$app->request->post('type');
        switch ($type) {
            case Post::GOOD:
                $post = new Good($this->contentContainer);
                break;
            case Post::NEED:
                $post = new Need($this->contentContainer);
                break;
            case Post::SERVICE:
                $post = new Service($this->contentContainer);
                break;
            case Post::POST:
            default:
            $post = new Post($this->contentContainer);
            break;
        }

        $post->message = Yii::$app->request->post('message');
        $post->type = $type;

        return WallCreateContentForm::create($post, $this->contentContainer);
    }

    public function actionEdit()
    {
        $id = Yii::$app->request->get('id');

        $edited = false;
        $model = Post::findOne(['id' => $id]);

        if (!$model->content->canEdit()) {
            $this->forbidden();
        }

        if ($model->load(Yii::$app->request->post())) {
            // Reload record to get populated updated_at field
            if ($model->validate() && $model->save()) {
                $model = Post::findOne(['id' => $id]);
                return $this->renderAjaxContent($model->getWallOut());
            } else {
                Yii::$app->response->statusCode = 400;
            }
        }

        return $this->renderAjax('edit', [
            'post' => $model
        ]);
    }

}
