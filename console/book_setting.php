<?php
session_start();
//没有登录直接重定向
if(!$_SESSION['_userid']){
  header('Location: /');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include('../ui/meta.php') ?>
  <title>控制台</title>
  <style type="text/css" rel="stylesheet">
    .main_view{
      width:100%;
      position: absolute;
      top:55px;
      left:0;
      right:0;
      bottom: 0;
      font-size:13px;
      color: #FFFFFF;
    }
    .main_right{
      background-color:#fff;
      position: absolute;
      left:175px;
      right:0;
      top:1px;
      bottom:0;
      color:#000;
      overflow-y: scroll;
    }

  </style>
</head>
<body>
<?php require_once('../ui/console/header.php');?>
<div class="main_view">
  <?php require_once('../ui/console/menu.php')?>
  <div class="main_right">
    <?php require_once('../ui/console/book_setting.php')?>
  </div>
</div>
<script type="text/javascript">

</script>
<?php include_once('../ui/cnzz.php');?>
</body>
</html>
