<?php
/*
* 获取分类图书的最新推荐7本小书
*
* */
session_start();
header('Content-Type: application/json; charset=utf8');
header('Access-Control-Allow-Origin: *');
require_once('./../utils.php');

$pdo = null;
try {
    $pdo = DBHelp::getInstance()->connect();
} catch (PDOException $e) {
    Utils::json(0, '数据连接异常', 'db link error');
}

$typeQuery = $pdo->prepare("SELECT type from books group by type");
$typeOk = $typeQuery->execute();
if (!$typeOk) {
    $typeQuery = null;
    Utils::json(0, '查询分类失败', 'query error');
}

$typeList = $typeQuery->fetchAll(PDO::FETCH_OBJ);
$typeQuery = null;
$typeList = Utils::object_array($typeList);

$query = "";
$num = count($typeList);
foreach ($typeList as $i => $type) {
    if ($i == $num - 1) {
        $query .= "(SELECT bookname, bookid, bookimg ,type from books WHERE type='$type[type]' AND isrecommend=1 order by time desc limit 0, 7)";
    } else {
        $query .= "(SELECT bookname, bookid, bookimg ,type from books WHERE type='$type[type]' AND isrecommend=1 order by time desc limit 0, 7) UNION ";
    }
}

$stmt = $pdo->prepare($query);
$is_ok = $stmt->execute();

if (!$is_ok) {
    $stmt = null;
    Utils::json(0, '查询图书失败', 'query error');
}

$rows = $stmt->fetchAll(PDO::FETCH_OBJ);
if (!$rows) {
    $stmt = null;
    Utils::json(0, '还没有图书', 'query error');
}
$stmt = null;

$newArray = [];
foreach ($rows as $item) {
    if (isset($newArray[$item->type])) {
        $newArray[$item->type]['data'][] = [
            'bookname' => $item->bookname,
            'bookid' => $item->bookid,
            'bookimg' => $item->bookimg,
        ];
    } else {
        $newArray[$item->type] = [
            'type' => $item->type,
            'data' => [
                [
                    'bookname' => $item->bookname,
                    'bookid' => $item->bookid,
                    'bookimg' => $item->bookimg,
                ]
            ]
        ];
    }
}
$newArray = array_values($newArray);

try {
    $json_string = file_get_contents('../../base/api/index_set/books.json');
    $hot_book_id = json_decode($json_string, true);
} catch (Exception $e) {
    Utils::json(0, '读取推荐小书服务异常', 'exception');
}


$bookQuery = 'SELECT bookname,bookid,bookimg from books WHERE';
foreach ($hot_book_id as $i => $value) {
    if ($i + 1 == count($hot_book_id)) {
        $bookQuery .= " bookid='" . $value . "'";
    } else {
        $bookQuery .= " bookid='" . $value . "' or";
    }
}

$stmt = $pdo->prepare($bookQuery);
$is_ok = $stmt->execute();
if (!$is_ok) {
    $stmt = null;
    Utils::json(0, '查询图书失败', 'query error');
}

$rows = $stmt->fetchAll(PDO::FETCH_OBJ);
if (!$rows && !$stmt->rowCount()) {
    $stmt = null;
    Utils::json(0, '没有查询到该图书', 'query error');
}
$stmt = null;
$rows = Utils::object_array($rows);
$hotbook = [];
$hotbook['type'] = 'hot';
$hotbook['data'] = $rows;
array_push($newArray, $hotbook);

Utils::json(1, '查询成功', $newArray);
?>