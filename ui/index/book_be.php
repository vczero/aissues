<div class="type_tag">后端</div>
<div id="book_be_container">
  <div style="margin-top:100px;">
    <?php include(dirname(__FILE__).'./../loading.php');?>
  </div>
</div>
<script type="text/template" id="book_be_tpl">
  <% _.each(books_be, function (item, i) { %>
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
  var books_be = [];
  (function () {
    $.get('/api/public/books_type.php?type=后端', function (data) {
      if(data.status) {
        books_be = data.data;
        $('.books_be').display('block');
      }
      $('#book_be_container').html((_.template($('#book_be_tpl').html(), books_be)()));
    });
  })();
</script>