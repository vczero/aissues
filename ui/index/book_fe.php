<div class="type_tag">前端</div>
<div id="book_fe_container">
  <div style="margin-top:100px;">
    <?php include(dirname(__FILE__).'./../loading.php');?>
  </div>
</div>
<script type="text/template" id="book_fe">
  <% _.each(books_fe, function (item, i) { %>
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
  var books_fe = [];
  (function () {
    $.get('/api/public/books_type.php?type=前端', function (data) {
      if(data.status) books_fe = data.data;
      $('#book_fe_container').html((_.template($('#book_fe').html(), books_fe)()));
    });
  })();
</script>