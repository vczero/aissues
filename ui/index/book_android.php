<div class="type_tag">Android</div>
<div id="book_android_container">
  <div style="margin-top:100px;">
    <?php include(dirname(__FILE__).'./../loading.php');?>
  </div>
</div>
<script type="text/template" id="book_android_tpl">
  <% _.each(books_android, function (item, i) { %>
  <div class="book_item" book-id="<%=item.bookid%>">
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
  var books_android = [];
  (function () {
    $.get('/api/public/books_type.php?type=Android', function (data) {
      if(data.status) books_android = data.data;
      $('#book_android_container').html((_.template($('#book_android_tpl').html(), books_android)()));
    });
  })();
</script>