<?php
namespace tests\unit\models;

use app\models\Category;
use Yii;

class CategoryTest extends \Codeception\Test\Unit
{
    protected function _before()
    {
        // Opcional: Limpar tabela antes de cada teste
        Yii::$app->db->createCommand()->delete('recipe_category')->execute();
        Yii::$app->db->createCommand()->delete('category')->execute();
    }

    public function testValidation()
    {
        $category = new Category();

        // name é obrigatório
        $this->assertFalse($category->validate());
        $this->assertArrayHasKey('name', $category->getErrors());

        // name válido
        $category->name = 'Tech';
        $this->assertTrue($category->validate());
    }

    public function testSlugGeneration()
    {
        $category = new Category();
        $category->name = 'Test Category';
        $this->assertTrue($category->save());

        $this->assertNotEmpty($category->slug);
        $this->assertEquals('test-category', $category->slug);
    }

    public function testSlugUnique()
    {
        $cat1 = new Category(['name' => 'Duplicate']);
        $this->assertTrue($cat1->save());

        $cat2 = new Category(['name' => 'Duplicate']);
        $this->assertTrue($cat2->save());

        $this->assertNotEquals($cat1->slug, $cat2->slug);
    }

    public function testTimestamps()
    {
        $category = new Category(['name' => 'With Timestamps']);
        $this->assertTrue($category->save());

        $this->assertNotEmpty($category->created_at);
        $this->assertNotEmpty($category->updated_at);
    }

    public function testGetDropdownList()
    {
        (new Category(['name' => 'Cat 1']))->save();
        (new Category(['name' => 'Cat 2']))->save();

        $list = Category::getDropdownList();

        $this->assertCount(2, $list);
        $this->assertContains('Cat 1', $list);
        $this->assertContains('Cat 2', $list);
    }
}
