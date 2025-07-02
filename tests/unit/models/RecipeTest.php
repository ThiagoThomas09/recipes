<?php
namespace tests\unit\models;

use app\models\Recipe;
use app\models\User;
use app\models\Favorite;
use Yii;

class RecipeTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
        Yii::$app->db->createCommand()->delete('favorite')->execute();
        Yii::$app->db->createCommand()->delete('recipe_category')->execute();
        Yii::$app->db->createCommand()->delete('recipe')->execute();
        Yii::$app->db->createCommand()->delete('user')->execute();
    }

    public function testValidation()
    {
        $recipe = new Recipe();
        $this->assertFalse($recipe->validate());
        $this->assertArrayHasKey('title', $recipe->getErrors());
        $this->assertArrayHasKey('description', $recipe->getErrors());

        $recipe->title = 'My Recipe';
        $recipe->description = 'Some description';
        $this->assertTrue($recipe->validate());
    }

    public function testSlugGeneration()
    {
        $recipe = new Recipe([
            'title' => 'Test Recipe',
            'description' => 'Description',
        ]);
        $this->assertTrue($recipe->save());

        $this->assertNotEmpty($recipe->slug);
        $this->assertEquals('test-recipe', $recipe->slug);
    }

    public function testSlugUnique()
    {
        $r1 = new Recipe(['title' => 'Duplicate', 'description' => 'first']);
        $this->assertTrue($r1->save());

        $r2 = new Recipe(['title' => 'Duplicate', 'description' => 'second']);
        $this->assertTrue($r2->save());

        $this->assertNotEquals($r1->slug, $r2->slug);
    }

    public function testTimestamps()
    {
        $recipe = new Recipe(['title' => 'With time', 'description' => 'desc']);
        $this->assertTrue($recipe->save());

        $this->assertNotEmpty($recipe->created_at);
        $this->assertNotEmpty($recipe->updated_at);
    }

    public function testIsFavoritedBy()
    {
        $user = new User(['username' => 'tester']);
        $user->password_hash = Yii::$app->security->generatePasswordHash('pass');
        $this->assertTrue($user->save());

        $recipe = new Recipe([
            'title' => 'Recipe',
            'description' => 'desc',
            'user_id' => $user->id,
        ]);
        $this->assertTrue($recipe->save());

        $favorite = new Favorite([
            'user_id' => $user->id,
            'recipe_id' => $recipe->id,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $this->assertTrue($favorite->save());

        $this->assertTrue($recipe->isFavoritedBy($user->id));
    }
}