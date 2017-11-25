<?php

use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = Yii::$app->params['webname'];
?>
<div id="logo" style="height:150px;">
</div>
<div id="loginbox">
    <p class="login-box-msg text-red"><?php echo current($model->getFirstErrors()) ?></p>
    <?php $form = ActiveForm::begin(['id' => 'loginform', 'class' => 'form-horizontal', 'action' => Url::toRoute(['/login/index'])]); ?>
    <div class="control-group normal_text"><h3><?= Yii::$app->params['webname'] ?></h3></div>
    <?=
            $form->field($model, 'username', ["template" => '<div class="control-group"><div class="controls"><div class="main_input_box"><span class="add-on"><i class="icon-user"></i></span>{input}</div></div></div>'])
            ->textInput(["placeholder" => "帐号"]);
    ?>
    <?=
            $form->field($model, 'password', ["template" => '<div class="control-group"><div class="controls"><div class="main_input_box"><span class="add-on"><i class="icon-lock"></i></span>{input}</div></div></div>'])
            ->passwordInput(["placeholder" => "密码"]);
    ?>
    <div class="control-group" style="padding-left:60px;">
        <?=
        $form->field($model, 'verifyCode')->widget(Captcha::className(), ['captchaAction' => 'login/captcha',
            'template' => '<div class="controls">{image}{input}</div>', 'imageOptions' => ['width' => '100px','style'=>'margin-left: -20px;margin-top:-8px;margin-right:10px;']
        ])
        ?>
    </div>
    <p style="color:red;"><?php echo current($model->getFirstErrors()) ?></p>
    <div class="form-actions">
        <span class="pull-right"><input type="submit" class="btn btn-success" value="登录" /></span>
    </div>
    <?php ActiveForm::end(); ?>
</div>