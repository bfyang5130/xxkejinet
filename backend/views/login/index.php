<?php

use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$this->title = Yii::$app->params['webname'];
?>
<div class="am-g myapp-login">
    <div class="myapp-login-logo-block  tpl-login-max">
        <div class="myapp-login-logo-text">
            <div class="myapp-login-logo-text">
                管理
            </div>
        </div>
        <div class="am-u-sm-10 login-am-center">

            <?php $form = ActiveForm::begin([
                'id' => 'loginform', 
                'options' => ['class' => 'am-form']
                ]); 
            ?>
            <fieldset>
                <?=
                        $form->field($model, 'username', ['options' => ['class' => 'am-form-group'], "template" => '{input}'])
                        ->textInput(["placeholder" => "帐号"]);
                ?>
                <?=
                        $form->field($model, 'password', ['options' => ['class' => 'am-form-group'], "template" => '{input}'])
                        ->passwordInput(["placeholder" => "密码", 'style' => 'border-radius: 0px 0px 0px 0px;']);
                ?>
                <?=
                        $form->field($model, 'verifyCode', ['options' => ['class' => 'am-form-group'], 'template' => Captcha::widget(
                                    [
                                        'model' => $model,
                                        'attribute' => 'verifyCode',
                                        'captchaAction' => 'login/captcha',
                                        'template' => '{image}',
                                        'imageOptions' =>
                                        [
                                            'alt' => '点击换图',
                                            'title' => '点击换图',
                                            'style' => 'border-radius: 0px 0px 0px 6px;margin-top: 0px;float: left;height: 30px;cursor:pointer;width:25%;']
                                    ]
                            ) . '{input}'])
                        ->textInput(['placeholder' => '验证码', 'style' => 'border-radius: 0px 0px 6px 0px;width: 75%;'])
                ?>
                <p>
                    <?= Html::submitButton('登录', ['class' => 'am-btn am-btn-default', 'name' => 'submit-button']) ?>
                </p>
            </fieldset>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>