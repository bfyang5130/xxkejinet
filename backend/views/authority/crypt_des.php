<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm ;
use yii\helpers\Url ;
use yii\helpers\Html ;
$this->params['breadcrumbs'][] = "模块管理";
$this->params['display_name'] = "3DES加密解密" ;
$this->title = '3DES加密解密-' . Yii::$app->params['webname'];
//$inputData = Yii::$app->request->get("inputData","");
//$outData = Yii::$app->request->get("outData","");
?>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <?= $this->render("common_bar")?>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="box box-success">
                        <div class="box-header with-border text-center">
                          <h3 class="box-title">3DES加密解密</h3>
                        </div><!-- /.box-header -->
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'form',
                            'options'=>["class"=>"form-horizontal"],
                        ])
                        ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label  class="col-sm-3 control-label">待加密、解密的文本：</label>
                                <?= Html::textarea("inputData",$inputData,['class'=>'col-sm-6','rows'=>8])?>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">3DES加密、解密转换结果(base64了)：</label>
                                <?= Html::textarea("out",$outData,['class'=>'col-sm-6','rows'=>8])?>
                            </div>
                            <?= Html::hiddenInput("type","encrypt",["id"=>"crypt_type"])?>
                        </div><!-- /.box-body -->
                        <div class="box-footer text-center">
                            <button type="button" class="btn btn-primary encrypt_class" style="width: 10%;">3DES加密</button>
                            <button type="button" class="btn btn-primary decrypt_class" style="width: 10%;">3DES解密</button>
                        </div><!-- /.box-footer -->
                        <?php ActiveForm::end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!--/span-->
<script>
    $(function(){
        $(".encrypt_class").click(function(){
            var inputData = $("textarea[name='inputData']").val() ;
            if(inputData==''){
                alert("请输入待加密、解密的文本");
                return ;
            }
            $("#crypt_type").val("encrypt") ;
            $("#form").submit() ;
        });
        $(".decrypt_class").click(function(){
            var inputData = $("textarea[name='inputData']").val() ;
            if(inputData==''){
                alert("请输入待加密、解密的文本");
                return ;
            }
            $("#crypt_type").val("decrypt") ;
            $("#form").submit() ;
        });
    });
</script>