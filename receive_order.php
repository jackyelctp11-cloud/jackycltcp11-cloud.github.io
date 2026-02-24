<?php
// 允许跨域请求（当前网站和目标网站域名不同时需加）
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");

// 1. 获取前端提交的订单数据
$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$product = $_POST['product'] ?? '';
$spec = $_POST['spec'] ?? '';
$price = $_POST['price'] ?? '';
$remark = $_POST['remark'] ?? '';

// 2. 验证数据（和前端一致）
if (empty($name) || empty($phone) || !preg_match('/^[689]\d{7}$/', $phone)) {
    echo json_encode(['code' => 0, 'msg' => '數據驗證失敗']);
    exit;
}

// 3. 连接数据库（替换为你的数据库信息）
$conn = mysqli_connect('数据库IP', '用户名', '密码', '数据库名');
if (!$conn) {
    echo json_encode(['code' => 0, 'msg' => '數據庫連接失敗']);
    exit;
}

// 4. 插入订单到数据库
$sql = "INSERT INTO orders (name, phone, product, spec, price, remark, create_time) 
        VALUES ('$name', '$phone', '$product', '$spec', '$price', '$remark', NOW())";
if (mysqli_query($conn, $sql)) {
    echo json_encode(['code' => 1, 'msg' => '訂單提交成功']);
} else {
    echo json_encode(['code' => 0, 'msg' => '訂單存儲失敗']);
}
mysqli_close($conn);
?>
