<!--<link type="text/css" rel="stylesheet" href="/js/swiper.min.css"/>-->
<!--<script type="text/javascript" src="/js/swiper.min.js"></script>-->
<style type="text/css">
  .banner_view{
    height:285px;
    width:1150px;
    margin-top:5px;
    background-color: #fff;
  }
  .swiper-container{
    height:285px;
  }
  .swiper-slide img{
    height:285px;
    width:825px;
    border-radius:4px;
  }
  .banner{
    width:825px;
    height:285px;
    border-radius:4px;
  }
  .ads_top{
    /*border:1px solid #E9E9E9;*/
    width:320px;
    background-color:#fff;
    height:285px;
  }
  .ads_top a{
    display:block;
    height:145px;
  }
  .ads_top span{
    position: relative;
    top: -85px;
    font-size:14px;
    color: #fff;
    text-align: center;
    display: block;
  }
  .ads_top img{
    width:320px;
    height:140px;
    border-radius:4px;
  }
  #banner_img{
    width:825px;
    height:285px;
    border-radius:4px;
  }
</style>
<div class="banner_view">
  <div class="banner fl">
    <a id="banner_img_a" href="http://aissues.com/news.php?id=45C17BFE-3E4D-44A8-A994-7D00BCC9956D">
      <img id="banner_img"/>
    </a>
<!--    <div class="swiper-container">-->
<!--      <div class="swiper-wrapper"></div>-->
<!--      <script type="text/template" id="banner_tpl">-->
<!--        <a class="swiper-slide" href="<%=banners[0].link%>">-->
<!--          <img src="<%=banners[0].imgurl%>"/>-->
<!--        </a>-->
<!--        <a class="swiper-slide" href="<%=banners[1].link%>">-->
<!--          <img src="<%=banners[1].imgurl%>"/>-->
<!--        </a>-->
<!--        <a class="swiper-slide" href="<%=banners[2].link%>">-->
<!--          <img src="<%=banners[2].imgurl%>"/>-->
<!--        </a>-->
<!--      </script>-->
<!--      <div class="swiper-pagination"></div>-->
<!--    </div>-->
  </div>
  <div class="ads_top fr">
    <a href="http://aissues.com/">
      <img src="/images/site/page_1.png"/>
      <span>除iPhone耳机孔苹果还想“干掉”这些东西</span>
    </a>

    <a href="http://aissues.com/">
      <img src="/images/site/page_2.png"/>
      <span>傅盛：最重要的事，只有一件</span>
    </a>
  </div>
</div>
<script>
  var banners = [];
  (function () {
    $.get('/api/public/banner.php?num=1', function (data) {
      if(data.status){
        banners = data.data;
        if(banners.length < 1)return;
        $('#banner_img')[0].src = banners[0].imgurl;
        $('#banner_img_a')[0].href = banners[0].link;
        //轮播图形式，如需，将注释代码放开即可
//        $('.banner_view').css('display', 'block');
//        $('.swiper-wrapper').html((_.template($('#banner_tpl').html(), banners)()));
//        var swiper = new Swiper('.swiper-container', {
//          autoplay: 2000,
//          pagination: '.swiper-pagination',
//          paginationClickable: true
//        });
      }
    });
  })();
</script>