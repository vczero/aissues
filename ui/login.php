<style type="text/css">
    .login{
      width:800px;
      height:500px;
      border:1px solid #fff;
      margin-left:-400px;
      left:50%;
      position:absolute;
      top:50%;
      margin-top:-300px;
      background-color:#FFFFFF;
      border-radius:3px;
      z-index:10000;
      display:none;
    }
    .login_mask{
      position:fixed;
      left:0;
      right:0;
      top:0;
      bottom:0;
      background-color:#181818;
      opacity:0.5;
      display:none;
      z-index:100;
    }
    .login_title{
      font-size:16px;
      font-weight:bold;
      padding-left:20px;
      height:35px;
      line-height:35px;
      background-color:#F3F3F3;
      border-bottom:1px solid #ddd;
    }
    .login_view{
      height:400px;
      margin-top:30px;
      width:100%;
    }
    .login_view>div{
      width:398px;
      height:400px;
    }
    .login_br{
      border-right:1px solid #ddd;
    }
    .login_s_title{
      font-size:15px;
      height:30px;
      color: #777777;
    }
    .login_form>div{
      margin-left:30px;
    }
    .login_form input{
      width:300px;
      height:30px;
      border:1px solid #CCCCCC;
      margin-top:8px;
      padding-left:10px;
      font-size:14px;
      border-radius:2px;
    }
    .login_form_text{
      margin-top:15px;
    }
    .login_f_pass{
      font-size:14px;
      color:#2990EC;
      cursor:pointer;
      display:inline-block;
      margin-right:58px;
    }

    .login_fw{
      font-size:14px;
      color:#2990EC;
      cursor:pointer;
      display:inline-block;
      margin-right:58px;
      margin-top:20px;
    }
    .login_btn, .register_btn{
      margin-right:58px;
      height:35px;
      width:70px;
      background-color:#0166FF;
      color:#fff;
      text-align:center;
      line-height:35px;
      margin-top:15px;
      cursor:pointer;
      border-radius:2px;
    }

    .login_close{
      color:#959595;
      font-size:16px;
      cursor:pointer;
      margin-right:5px;
      width:40px;
      height:35px;
      line-height:35px;
      text-align:center;
    }
    .login_fw_view, .login_fw{
      font-size:12px;
    }
    .login_f_pass{
      font-size:12px;
    }
  </style>
  <div class="login">
    <div class="login_title">
      <div class="fl am-post-title">登录 | 注册</div>
      <div class="fr login_close">x</div>
    </div>
    <div class="login_view">
      <div class="fl login_br login_form">
        <div class="login_s_title">注册新账号</div>
        <div class="login_form_text">邮箱</div>
        <div>
          <input id="register_email" placeholder="Email地址"/>
        </div>
        <div class="login_form_text">密码<span style="font-size:10px;">（最少6位）</span></div>
        <div>
          <input id="register_password" placeholder="密码" type="password"/>
        </div>
        <div class="login_form_text">验证码</div>
        <div>
          <img src="/api/user/captcha4register.php" onclick="this.src='/api/user/captcha4register.php?' + Math.random();"/>
        </div>
        <div>
          <input id="code" placeholder="邀请码"/>
        </div>
        <div>
          <div class="fl login_fw_view">
            同意并接受<a class="login_fw">《服务条款》</a>
          </div>
          <div class="fr register_btn">
            注册
          </div>
        </div>
      </div>
      <div class="fr login_form">
        <div class="login_s_title">用户登录</div>
        <div class="login_form_text">邮箱</div>
        <div>
          <input id="login_email" placeholder="Email地址"/>
        </div>
        <div class="login_form_text">
          <span>密码</span>
          <a class="login_f_pass fr">忘记密码</a>
        </div>
        <div>
          <input id="login_pass" placeholder="密码" type="password"/>
        </div>
        <div class="login_form_text">
          <span>验证码</span>
        </div>
        <div>
          <img src="/api/user/captcha.php" onclick="this.src='/api/user/captcha.php?' + Math.random();"/>
        </div>
        <div>
          <input id="login_code" placeholder="请入验证码"/>
        </div>
        <div>
          <div class="fl"></div>
          <div class="fr login_btn">
            登录
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="login_mask"></div>
  <script type="text/javascript">
    //关闭登录窗
    $('.login_close').on('click', function(){
      $('.login').css('display', 'none');
      $('.login_mask').css('display', 'none');
    });

    var reg =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    //注册会员
    var emailInput = $('#register_email');
    var passInput = $('#register_password');
    var codeInput = $('#code');

    function inputError(elem){
      elem.css('border', '1px solid red');
    }
    function inputFocus(elem){
      elem.css('border', '1px solid #1D83F6');
    }
    function inputGrey(elem){
      elem.css('border', '1px solid #ccc');
    }
    $('.login_form input').on('focus', function(){
      inputFocus($(this));
    });
    $('.login_form input').on('blur', function(){
      inputGrey($(this));
    });

    $('.register_btn').on('click', function(){
      var email = emailInput.val();
      var password = passInput.val();
      var code = codeInput.val();
      //校验邮箱
      if(!email || !reg.test(email)){
        return inputError(emailInput);
      }
      //校验密码
      if(!password || password.length < 6){
        return inputError(passInput);
      }
      //校验邀请码
      if(!code){
        return inputError(codeInput);
      }

      var obj = {
        email: email || '',
        password: password || '',
        code: code || ''
      };
      $.post('/api/user/register.php', obj, function(data){
        if(data.status){
          location.href = '/';
        }else{
          var infoWindow = new Alert('提示', data.info);
          infoWindow.show();
        }
      }, 'json');
    });

    //登录
    var login_email = $('#login_email');
    var login_pass = $('#login_pass');
    var login_code = $('#login_code');

    $('.login_btn').on('click', function(){
      var email = login_email.val();
      var password = login_pass.val();
      var code = login_code.val();
      //校验邮箱
      if(!email || !reg.test(email)){
        return inputError(login_email);
      }
      //校验密码
      if(!password){
        return inputError(login_pass);
      }
      if(!code){
        return inputError(login_code);
      }
      var obj = {
        email: email || '',
        password: password || '',
        code: code || ''
      };

      $.post('/api/user/login.php', obj, function (data){
        if(data.status){
          location.href = '/';
        }else{
          var infoWindow = new Alert('提示', data.info);
          infoWindow.show();
        }
      });
    });
  </script>