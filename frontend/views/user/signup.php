<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var SignupForm $model */

use frontend\models\SignupForm;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1 class="text-center" class="page_title"><?= Html::encode($this->title) ?></h1>

    <p class="text-center">Please fill out the following fields to signup:</p>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'layout' => 'floating']); ?>

                <?= $form->field($model, 'email')->label(Yii::t('app', 'Email')) ?>
                <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password')) ?>

                <hr>

                <?= $form->field($model, 'firstname')->label(Yii::t('app', 'Firstname')) ?>
                <?= $form->field($model, 'lastname')->label(Yii::t('app', 'Lastname')) ?>
                <?= $form->field($model, 'sex')->dropDownList(\common\models\User::sexList(), ['prompt' => Yii::t('app', 'Select the sex ...')]); ?>
                <?= $form->field($model, 'birth_date', ['inputOptions' => ['type' => 'date']])->label(Yii::t('app', 'Birth date')); ?>

                <hr>

                <?= $form->field($model, 'phone')->textInput()->label(Yii::t('app', 'Phone')); ?>

                <hr>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
