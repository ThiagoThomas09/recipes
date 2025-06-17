<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\Favorite;

class FavoriteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index','toggle'],
                'rules' => [
                    ['allow'=>true, 'roles'=>['@']],
                ],
            ],
        ];
    }

    // Lista as receitas favoritas do usuário
    public function actionIndex()
    {
        $recipes = Yii::$app->user->identity
            ->getFavoriteRecipes()
            ->all();

        return $this->render('index', [
            'recipes' => $recipes,
        ]);
    }

    // Adiciona ou remove um favorito
    public function actionToggle($id)
    {
        $userId = Yii::$app->user->id;
        $fav = Favorite::findOne(['user_id'=>$userId,'recipe_id'=>$id]);

        if ($fav) {
            $fav->delete();
        } else {
            $fav = new Favorite();
            $fav->user_id   = $userId;
            $fav->recipe_id = $id;
            $fav->created_at = date('Y-m-d H:i:s');
            $fav->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}
