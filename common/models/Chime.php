<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%chime}}".
 *
 * @property integer $id [int(11) unsigned (auto increment)]
 * @property string $public_id [varchar(36) = uuid()]
 * @property integer $user_id [int(11) unsigned]
 * @property boolean $active [tinyint(1) unsigned = 1]
 * @property boolean $public [tinyint(1) unsigned = 0]
 * @property integer $likes_count [int(11) unsigned = 0]
 * @property string $title [varchar(254)]
 * @property string $content [mediumtext]
 * @property integer $created_at [datetime]
 * @property integer $updated_at [timestamp = current_timestamp()]
 *
 * @property integer $page_size
 *
 * @property User $user
 * @property ChimeLike[] $chimeLikes
 */
class Chime extends \yii\db\ActiveRecord
{
    public $page_size;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chime}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'content'], 'required', 'on' => 'default'],
            [['user_id', 'likes_count'], 'integer'],
            [['public_id'], 'string', 'max' => 32],
            [['title'], 'string', 'max' => 254],
            [['public_id'], 'unique', 'on' => 'default'],
            [['active', 'public'], 'boolean', 'trueValue' => 1, 'falseValue' => 0],
            [['active'], 'default', 'value' => 1, 'on'=>'default'],
            [['likes_count', 'public'], 'default', 'value' => 0, 'on'=>'default'],
            [['id', 'public_id', 'user_id', 'active', 'public', 'likes_count', 'title', 'created_at', 'updated_at', 'page_size'], 'safe', 'on' => 'search'],
            [['content'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'public_id' => Yii::t('app', 'Public ID'),
            'user_id' => Yii::t('app', 'User'),
            'active' => Yii::t('app', 'Is active'),
            'public' => Yii::t('app', 'Is public'),
            'likes_count' => Yii::t('app', 'Likes count'),
            'title' => Yii::t('app', 'Title'),
            'content' => Yii::t('app', 'Content'),
            'page_size' => Yii::t('app', 'Page size'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChimeLikes()
    {
        return $this->hasMany(ChimeLike::class, ['chime_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $full = false)
    {
        $this->scenario = 'search';

        $query = Chime::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> [
                'defaultOrder' => ['id'=>SORT_DESC],
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($full) {
            $dataProvider->setPagination(false);
        } else {
            $dataProvider->pagination->pageSize = ($this->page_size !== NULL) ? $this->page_size : 50;
        }

        $id_arr = explode('-', $this->id);
        if (count($id_arr) == 2) {
            $query->andFilterWhere(['between', 'id', $id_arr[0], $id_arr[1]]);
        } else {
            $query->andFilterWhere(['id' => $this->id]);
        }

        $query->andFilterWhere(['public_id' => $this->public_id]);
        $query->andFilterWhere(['user_id' => $this->user_id]);
        $query->andFilterWhere(['active' => $this->active]);
        $query->andFilterWhere(['public' => $this->public]);
        $query->andFilterWhere(['likes_count' => $this->likes_count]);

        $query->andFilterWhere(['like', 'title', $this->title]);
        $query->andFilterWhere(['like', 'content', $this->content]);
        $query->andFilterWhere(['like', 'created_at', $this->created_at]);
        $query->andFilterWhere(['like', 'updated_at', $this->updated_at]);

        return $dataProvider;
    }
}
