<div class="type_tag">运维</div>
<div id="book_ops_container">
  <div style="margin-top:100px;">
    <?php include(dirname(__FILE__).'./../loading.php');?>
  </div>
</div>
<script type="text/template" id="book_ops_tpl">
  <% _.each(books_ops, function (item, i) { %>
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
  var books_ops = [];
  (function () {
    $.get('/api/public/books_type.php?type=运维', function (data) {
      if(data.status) books_ops = data.data;
      $('#book_ops_container').html((_.template($('#book_ops_tpl').html(), books_ops)()));
    });
  })();
</script>