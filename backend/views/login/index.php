<?php

use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

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
            <p class="login-box-msg text-red"><?php echo current($model->getFirstErrors()) ?></p>
            <?php $form = ActiveForm::begin(['id' => 'loginform', 'class' => 'am-form', 'action' => Url::toRoute(['/login/index'])]); ?>
            <fieldset>
                <?=
                        $form->field($model, 'username', ["template" => '<div class="am-form-group">{input}</div>'])
                        ->textInput(["placeholder" => "帐号"]);
                ?>
                <?=
                        $form->field($model, 'password', ["template" => '<div class="am-form-group">{input}</div>'])
                        ->passwordInput(["placeholder" => "密码"]);
                ?>
                <?=
                $form->field($model, 'verifyCode')->widget(Captcha::className(), ['captchaAction' => 'login/captcha',
                    'template' => '<div class="am-form-group">{image}{input}</div>', 'imageOptions' => ['width' => '100px']
                ])
                ?>
                <p><button type="submit" class="am-btn am-btn-default">登录</button></p>
            </fieldset>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>