<style type="text/css" rel="stylesheet">
  .news_view{
    width:1200px;
    height:453px;
    margin-top:10px;
  }
  .news_item{
    margin-left:10px;
    width:498px;
    border:1px solid #fff;
    height:35px;
    margin-top:2px;
  }
  .news_item>div{
    line-height:35px;
  }
  .news_id{
    width:30px;
    height:30px;
    border:1px solid #ddd;
    text-align: center;
    color:#5F5F5F;
  }
  .news_title{
    width:300px;
    margin-left:5px;
  }
  .news_time{
    margin-right:20px;
    color: #676767;
  }
  #news_container{
    padding-bottom:10px;
  }
  .news_view_left{
    height:453px;width:510px;
    border:1px solid #ddd;
    border-radius:4px;
    box-shadow: 2px 2px 2px #ddd;
  }
  .news_view_right{
    /*border:1px solid #ddd;*/
    width:680px;
    height:453px;
  }
  .news_types{
    height:200px;
  }
  .news_types>a{
    width:200px;
    margin-left:10px;
    float: left;
    text-align: center;
    margin-top:-15px;
    display: inline-block;
  }
  .news_types img{
    width:200px;
    border-radius:4px;
  }
  .news_types span{
    position: relative;
    top:-50px;
    color: #fff;
    font-size:16px;
  }

</style>
<div class="news_view">
  <div class="fl news_view_left">
    <div style="height:40px;color: #333333;margin-left:10px;padding-top:10px;font-size:14px;">
      <img src="/images/site/icon_news.png" style="width:15px;"/>
      新闻头条
    </div>
    <div id="news_container">
      <div style="margin-top:180px;">
        <?php include(dirname(__FILE__).'./../loading.php');?>
      </div>
    </div>
  </div>
  <div class="fr news_view_right">
    <div style="height:40px;color: #333333;margin-left:10px;padding-top:10px;font-size:14px;">
      <img src="/images/site/icon_news.png" style="width:15px;"/>
      分类新闻
    </div>
    <div class="news_types">
      <a href="/news_list.php?type=科技">
        <img src="/images/site/type1.png"/><span>科技</span>
      </a>
      <a href="/news_list.php?type=管理">
        <img src="/images/site/type2.png"/><span>管理</span>
      </a>
      <a href="/news_list.php?type=生活">
        <img src="/images/site/type3.png"/><span>生活</span>
      </a>
      <a href="/news_list.php?type=电影">
        <img src="/images/site/type4.png"/><span>电影</span>
      </a>
      <a href="/news_list.php?type=WEEX">
        <img src="/images/site/type5.png"/><span>WEEX</span>
      </a>
      <a href="/news_list.php?type=微信小程序">
        <img src="/images/site/type6.png"/><span>微信小程序</span>
      </a>
    </div>
    <div style="height:75px;text-align: left;width:620px;margin-left:10px;margin-top:-15px;color:#5F5F5F;">
      Aissues.com 不仅提供小书服务，将碎片化知识更加系统化，将书本读薄；同时，提供一些新闻资讯以供阅读。
      而这些资讯都是编辑精心阅读过的，并且手工重新整理编辑的。没有用爬虫，更多的希望提供比较更有【人】的东西。
      因为，人挑选出来的东西更加具有情感，也希望表达些目前所有看到的，所愿意分享的。
    </div>
    <div style="width:100%;height:140px;">
      <img src="/images/site/kp.png" style="border-radius:4px;"/>
      <span style="display: block;margin-top: -75px;position: relative;color: #ddd;margin-left: 20px;font-size:14px;font-family:'helvetica neue',arial,sans-serif;">
        当 vczero 告诉我他希望做"把书读薄"这件事的时候，我觉得他能做好，因为他一直在探索这个
      </span>
    </div>
  </div>
</div>

<script type="text/template" id="news_tpl">
  <% _.each(news, function (item, i) { %>
  <div class="news_item">
    <div class="fl news_id"><%=parseInt(i)+1%></div>
    <div class="fl news_title name_ell">
      <a href="/news.php?id=<%=item.newsid%>"><%=item.title%></a>
    </div>
    <div class="fr news_time"><%=item.time%></div>
  </div>
  <%});%>
</script>
<script type="text/javascript">
  var news = [];
  (function () {
    $.get('/api/public/get_news.php', function (data) {
      if(data.status){
        news = data.data;
      }else{
        $('.news').css('display', 'none');
      }
      $('#news_container').html((_.template($('#news_tpl').html(), news)()));
    });
  })();
</script>