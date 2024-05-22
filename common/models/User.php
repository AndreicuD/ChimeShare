<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * User model
 *
 * @property integer $id [int(auto increment)]
 * @property string $username [varchar(254)]
 * @property string $email [varchar(254)]
 * @property string $firstname [varchar(254)]
 * @property string $lastname [varchar(254)]
 * @property string $sex [enum('F','M')]
 * @property string $phone [varchar(32)]
 * @property string $birth_date [date]
 * @property integer $status [smallint = 10]
 * @property string $auth_key [varchar(32)]
 * @property string $password_hash [varchar(254)]
 * @property string $password_reset_token [varchar(254)]
 * @property string $verification_token [varchar(254)]
 * @property integer $created_at [datetime]
 * @property integer $updated_at [timestamp = current_timestamp()]
 *
 * @property-read string $authKey
 * @property string $password write-only password
 * @property string $full_name the full name
 * @property integer $page_size
 *
 * @property Chime[] $chimes
 * @property ChimeLike[] $chimeLikes
 * @property AuthAssignment $role
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    public $full_name = null;

    /**
     * @var \common\models\AuthAssignment
     */
    public $item_name;
    public $page_size;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['email', 'firstname', 'lastname'], 'required', 'on' => 'default'],
            [['email', 'firstname', 'lastname', 'password'], 'required', 'on' => 'create'],
            ['status', 'default', 'value' => self::STATUS_INACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            ['sex' , 'in', 'range' => ['F', 'M']],
            [['sex', 'birth_date', 'username'], 'default', 'value' => NULL],
            [['item_name'], 'default', 'value' => 'member', 'on' => 'create'],
            [['firstname', 'lastname', 'username'], 'string', 'max' => 254],
            [['phone'], 'string', 'max' => 128],
            ['email', 'email', 'on' => 'default'],
            ['email', 'email', 'on' => 'create'],
            ['email', 'unique', 'on' => 'default'],
            ['email', 'unique', 'on' => 'create'],
            ['username', 'unique', 'skipOnEmpty' => true, 'on' => 'default'],
            ['username', 'unique', 'skipOnEmpty' => true, 'on' => 'create'],
            /*['password_confirmation', 'compare', 'compareAttribute' => 'new_password', 'on' => 'create'],*/
            [['auth_key', 'password_hash', 'password_reset_token', 'verification_token', 'password', 'newsletter_subscription'], 'safe'],
            [['id', 'username', 'email', 'firstname', 'lastname', 'sex', 'phone', 'birth_date', 'item_name'], 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'firstname' => Yii::t('app', 'First name'),
            'lastname' => Yii::t('app', 'Last name'),
            'sex' => Yii::t('app', 'Sex'),
            'phone' => Yii::t('app', 'Phone'),
            'birth_date' => Yii::t('app', 'Birth date'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'item_name' => Yii::t('app', 'Access level'),
            'password' => Yii::t('app', 'Password'),
            'password_confirmation' => Yii::t('app', 'Password confirmation'),
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

    public function afterFind(): void
    {
        $this->full_name = $this->firstname . ' ' . $this->lastname;
        $this->item_name = $this->getRoleName();

        parent::afterFind();
    }

    /**
     * Relation with AuthAssignment model.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole(): \yii\db\ActiveQuery
    {
        return $this->hasOne(AuthAssignment::class, ['user_id' => 'id']);
    }

    /**
     * Returns the role name ( item_name )
     *
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->role->item_name ?? 'member';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChimes()
    {
        return $this->hasMany(Chime::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChimeLikes()
    {
        return $this->hasMany(ChimeLike::class, ['user_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id): User|IdentityInterface|null
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Returns the array of possible user roles.
     * NOTE: used in employee/index view.
     *
     * @return mixed
     */
    public static function rolesList()
    {
        $roles = [];

        foreach (AuthItem::getRoles() as $item_name) {
            $roles[$item_name->name] = $item_name->name;
        }
        if (!Yii::$app->user->can('superadmin') && isset($roles['superadmin'])) {
            unset($roles['superadmin']);
        }

        return $roles;
    }

    /**
     * @return array the possible statuses
     */
    public static function sexList(): array
    {
        return [
            'F' => Yii::t('app', 'Female'),
            'M' => Yii::t('app', 'Male'),
        ];
    }

    /**
     * @return array the possible statuses
     */
    public static function statusesList(): array
    {
        return [
            self::STATUS_DELETED => Yii::t('app', 'Deleted'),
            self::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
            self::STATUS_ACTIVE => Yii::t('app', 'Active'),
        ];
    }

    /**
     * Creates data provider instance with search query applied
     * used to create lists / grids
     *
     * @param array $params
     * @param bool $full
     * @return ActiveDataProvider
     */
    public function search(array $params, bool $full = false): ActiveDataProvider
    {
        $this->scenario = 'search';

        $query = self::find();
        $query->leftJoin('{{%auth_assignment}}', '{{%auth_assignment}}.user_id = {{%user}}.id');

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
            '{{%user}}.status' => $this->status,
            '{{%user}}.sex' => $this->sex,
            '{{%auth_assignment}}.item_name' => $this->item_name,
        ]);

        $query->andFilterWhere(['like', '{{%user}}.email', $this->email])
            ->andFilterWhere(['like', '{{%user}}.firstname', $this->firstname])
            ->andFilterWhere(['like', '{{%user}}.lastname', $this->lastname])
            ->andFilterWhere(['like', '{{%user}}.phone', $this->phone])
            ->andFilterWhere(['like', '{{%user}}.birth_date', $this->birth_date])
            ->andFilterWhere(['like', '{{%user}}.created_at', $this->created_at])
            ->andFilterWhere(['like', '{{%user}}.updated_at', $this->updated_at]);

        return $dataProvider;
    }



    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null): ?IdentityInterface
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username): null|static
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email): null|static
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token): null|static
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token): null|static
    {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token): bool
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): ?string
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): ?bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey(): void
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken(): void
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken(): void
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken(): void
    {
        $this->password_reset_token = null;
    }
}
