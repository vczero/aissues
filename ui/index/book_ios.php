<div class="type_tag">iOS</div>
<div id="book_ios_container">
  <div style="margin-top:100px;">
    <?php include(dirname(__FILE__).'./../loading.php');?>
  </div>
</div>
<script type="text/template" id="book_ios_tpl">
  <% _.each(books_ios, function (item, i) { %>
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
  var books_ios = [];
  (function () {
    $.get('/api/public/books_type.php?type=iOS', function (data) {
      if(data.status) {
        books_ios = data.data;
        $('.books_ios').display('block');
      }
      $('#book_ios_container').html((_.template($('#book_ios_tpl').html(), books_ios)()));
    });
  })();
</script>