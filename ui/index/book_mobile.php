<div class="type_tag">移动端</div>
<div id="book_mobile_container">
  <div style="margin-top:100px;">
    <?php include(dirname(__FILE__).'./../loading.php');?>
  </div>
</div>
<script type="text/template" id="book_mobile_tpl">
  <% _.each(books_mobile, function (item, i) { %>
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
  var books_mobile = [];
  (function () {
    $.get('/api/public/books_type.php?type=移动端', function (data) {
      if(data.status) books_mobile = data.data;
      $('#book_mobile_container').html((_.template($('#book_mobile_tpl').html(), books_mobile)()));
    });
  })();
</script>