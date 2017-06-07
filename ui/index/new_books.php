<style type="text/css" rel="stylesheet">
  .new_books_item{
    margin-top:10px;
    height:25px;
    display: block;
    cursor: pointer;
    border-bottom: 1px dashed #F2F2F2;
    margin-left:5px;
    margin-right:5px;
  }
  .new_books_title{
    margin-top:10px;
    padding-left:10px;
    height:25px;
    border-bottom:1px solid #ddd;
    color: #333333;
  }
  .new_books_item_title{
    width:180px;
    color: #5F5F5F;
    line-height:20px;
    font-size:13px;
  }
  .new_books_item_time{
    margin-right:10px;
    font-size:12px;
    color: #8F8F8F;
    line-height:20px;
  }
  .new_books_title img{
    width:23px;
    vertical-align: middle;
  }
</style>
<div>
  <div class="new_books_title">
    <img src="/images/site/new.png"/>
    最新小书
  </div>
  <div id="new_book_container">
    <div style="margin-top:180px;">
      <?php include(dirname(__FILE__).'./../loading.php');?>
    </div>
  </div>
</div>
<script type="text/template" id="new_books_tpl">
  <% _.each(new_books, function (item, i) { %>
  <a class="new_books_item" href="/book.php?id=<%=item.bookid%>">
    <div class="name_ell new_books_item_title fl"><%=item.bookname%></div>
    <div class="name_ell new_books_item_time fr"><%=item.time%></div>
  </a>
  <%})%>
</script>
<script type="text/javascript">
  var new_books = [];
  (function () {
    $.get('/api/public/get_new_books.php', function (data) {
      if(data.status) new_books = data.data;
      $('#new_book_container').html((_.template($('#new_books_tpl').html(), new_books)()));
    });
  })();
</script>