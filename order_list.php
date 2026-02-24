<?php
// 连接数据库（同上）
$conn = mysqli_connect('数据库IP', '用户名', '密码', '数据库名');
$sql = "SELECT * FROM orders ORDER BY create_time DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>訂單管理</title>
    <style>
        table {width: 100%; border-collapse: collapse;}
        th, td {border: 1px solid #ccc; padding: 8px; text-align: center;}
    </style>
</head>
<body>
    <h2>澳門Q版定制訂單列表</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>手機號</th>
            <th>定制套餐</th>
            <th>雕刻規格</th>
            <th>總價(MOP)</th>
            <th>備註</th>
            <th>提交時間</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['product'] ?></td>
            <td><?= $row['spec'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['remark'] ?></td>
            <td><?= $row['create_time'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
