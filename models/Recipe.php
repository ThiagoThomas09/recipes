<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

use Yii;

/**
 * This is the model class for table "recipe".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int|null $cook_time
 * @property string|null $image
 * @property string $created_at
 * @property string $updated_at
 */
class Recipe extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipe';
    }

    /**
     * @var yii\web\UploadedFile|null
     */
    public $imageFile = null;

    /**
     * Holds IDs of categories assigned to the recipe.
     * @var array
     */
    public $categoryIds = [];

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'cook_time', 'image'], 'default', 'value' => null],
            [['user_id', 'cook_time'], 'integer'],
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'slug', 'image'], 'string', 'max' => 255],
            [['slug'], 'unique'],

            [['categoryIds'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'description' => 'Description',
            'cook_time' => 'Cook Time',
            'image' => 'Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'categoryIds' => 'Categories',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            [
                'class'         => SluggableBehavior::class,
                'attribute'     => 'title',
                'slugAttribute' => 'slug',
                'ensureUnique'  => true,
                'immutable'     => true,
            ],
        ];
    }

    public function getCategories()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
                    ->viaTable('recipe_category', ['recipe_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        Yii::$app->db->createCommand()
            ->delete('recipe_category', ['recipe_id' => $this->id])
            ->execute();

        if (is_array($this->categoryIds)) {
            foreach ($this->categoryIds as $catId) {
                Yii::$app->db->createCommand()
                    ->insert('recipe_category', [
                        'recipe_id'   => $this->id,
                        'category_id' => $catId,
                    ])->execute();
            }
        }
    }
}
