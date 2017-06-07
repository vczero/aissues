<div id="book_recommend">
  <div style="margin-top:180px;">
    <?php include(dirname(__FILE__).'./../loading.php');?>
  </div>
</div>
<script type="text/template" id="recommend_tpl">
  <% _.each(book_objs, function (item, i) { %>
  <div class="book_item" book-id="<%=item.bookid%>" author-id="<%=item.userid%>">
    <a href="/book.php?id=<%=item.bookid%>">
      <img src="<%=item.bookimg%>"/>
    </a>
    <div class="book_item_title name_ell">
      <%=item.bookname%>
    </div>
  </div>
  <%});%>
</script>
<script type="text/javascript">
  var book_objs = [];
  (function () {
    $.get('/base/api/index_set/get.php', function (data) {
      var books = [];
      if(data.status){
        books = data.data;
        if(books.length < 1){
          //TODO：提示用户在加载数据
          return;
        }
        
        $.post('/api/public/get_book_id.php', {bookids: books}, function (data) {
          if(data.status){
           book_objs = data.data;
           $('#book_recommend').html((_.template($('#recommend_tpl').html(), book_objs)()));
          }
        });
      }
    });
  })();
</script>
