<div id="loginbox">            
    <form id="loginform" class="form-vertical" action="index.html">
        <div class="control-group normal_text"><h3>内容管理系统</h3></div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on"><i class="icon-user"></i></span><input type="text" placeholder="帐号" />
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on"><i class="icon-lock"></i></span><input type="password" placeholder="密码" />
                </div>
            </div>
        </div>
        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-warning" id="to-recover">忘记密码?</a></span>
            <span class="pull-right"><input type="submit" class="btn btn-success" value="登录" /></span>
        </div>
    </form>
    <form id="recoverform" action="#" class="form-vertical">
        <p class="normal_text">请输入你的邮箱以发送验证码。 <br/><font color="#FF6633">如何找回密码</font></p>

        <div class="controls">
            <div class="main_input_box">
                <span class="add-on"><i class="icon-envelope"></i></span><input type="text" placeholder="邮箱地址" />
            </div>
        </div>

        <div class="form-actions">
            <span class="pull-left"><a href="#" class="flip-link btn btn-warning" id="to-login">&laquo; 返回</a></span>
            <span class="pull-right"><input type="submit" class="btn btn-info" value="发送" /></span>
        </div>
    </form>
</div>