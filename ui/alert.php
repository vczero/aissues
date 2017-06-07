<style type="text/css" rel="stylesheet">
  .__ui_alert_mask{
    position: fixed;
    left:0;
    right:0;
    bottom:0;
    top:0;
    z-index:1000000000000;
    background-color: #000;
    opacity: 0.6;
    display: none;
  }
  .__ui_alert_info{
    width:300px;
    height:150px;
    display: none;
    position: fixed;
    left:50%;
    margin-left: -150px;
    top:50%;
    margin-top:-150px;
    background-color:#fff;
    border-radius:3px;
    border:1px solid #ddd;
    z-index: 10100000000000;
  }
  #__ui_alert_info_title{
    font-size:15px;
    font-weight: bold;
    text-align: center;
    margin-top:20px;
    color: #E7505A;
  }
  #__ui_alert_info_message{
    height:70px;
    width:100%;
    padding-left:5px;
    padding-right:5px;
    text-align: center;
    font-size:13px;
  }
</style>
<div class="__ui_alert_mask"></div>
<div class="__ui_alert_info">
  <div id="__ui_alert_info_title"></div>
  <div id="__ui_alert_info_message"></div>
  <div id="__ui_alert_close" style="border-top:1px solid #ddd;text-align: center;cursor: pointer;color: #008CEE;height:30px;line-height:30px;">知道了</div>
</div>
<script type="text/javascript">
  (function (window) {
    var callback = function(){};
    var close_btn =  $('#__ui_alert_close');
    window.Alert = function (title, message, cbk, second) {
      this.title = title;
      this.message = message;
      callback = cbk || callback;
      this.second = second || 0;
      this.alert_mask = $('.__ui_alert_mask');
      this.alert_info = $('.__ui_alert_info');
      this.title_view = $('#__ui_alert_info_title');
      this.message_view = $('#__ui_alert_info_message');
    };

    Alert.prototype.show = function () {
      this.alert_mask.css('display', 'block');
      this.alert_info.css('display', 'block');
      this.title_view.text(this.title);
      this.message_view.text(this.message);

      //即时隐藏
      if(this.second){
        close_btn.text(this.second/1000 + '秒后自动关闭');
        setTimeout(function () {
          hideView();
        }, this.second);
      }
    };

    close_btn.on('click', function () {
      hideView();
      if(callback){
        callback();
      }
    });

    function hideView() {
      $('.__ui_alert_mask').css('display', 'none');
      $('.__ui_alert_info').css('display', 'none');
    }
  })(window);
</script>