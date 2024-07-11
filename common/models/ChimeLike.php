<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * This is the model class for table "{{%chime_like}}".
 *
 * @property integer $id [int(11) unsigned (auto increment)]
 * @property integer $chime_id [int(11) unsigned]
 * @property integer $user_id [int(11) unsigned]
 * @property string $created_at [datetime]
 *
 * @property Chime $chime
 * @property User $user
 *
 */
class ChimeLike extends \yii\db\ActiveRecord
{
    public $public_chime_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chime_like}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['chime_id', 'user_id'], 'required', 'on' => 'default'],
            [['chime_id', 'user_id'], 'integer'],
            [['public_chime_id'], 'safe'],
            [['id', 'chime_id', 'user_id', 'created_at', 'page_size'], 'safe', 'on' => 'search'],
            [['chime_id'], 'exist', 'skipOnError' => true, 'targetClass' => Chime::class, 'targetAttribute' => ['chime_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'chime_id' => Yii::t('app', 'Chime'),
            'user_id' => Yii::t('app', 'User'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getChime(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Chime::class, ['id' => 'chime_id']);
    }

    public function getUser(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
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

        $query = self::find();

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
            $dataProvider->pagination->pageSize = ($this->page_size !== NULL) ? $this->page_size : 20;
        }

        $id_arr = explode('-', $this->id);
        if (count($id_arr) == 2) {
            $query->andFilterWhere(['between', 'id', $id_arr[0], $id_arr[1]]);
        } else {
            $query->andFilterWhere(['id' => $this->id]);
        }

        $query->andFilterWhere([
            'chime_id' => $this->chime_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }
}
