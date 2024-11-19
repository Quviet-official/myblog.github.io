<?php
// Kết nối đến cơ sở dữ liệu MySQL
$host = 'localhost'; // Thay bằng thông tin của bạn
$dbname = 'love_journey';
$username = 'root';
$password = ''; // Thay bằng mật khẩu của bạn

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Tính toán số ngày yêu
$start_date = '2024-10-01'; // Ngày bắt đầu yêu, thay bằng ngày bạn muốn
$start_timestamp = strtotime($start_date);
$current_timestamp = time();
$days_together = floor(($current_timestamp - $start_timestamp) / (60 * 60 * 24));

// Lấy dữ liệu ảnh và mô tả từ cơ sở dữ liệu
$query = $pdo->query("SELECT * FROM journey_images ORDER BY date_uploaded DESC");
$images = $query->fetchAll(PDO::FETCH_ASSOC);

// Lấy câu chuyện từ bảng love_story
$story_query = $pdo->query("SELECT * FROM love_story ORDER BY date_added DESC LIMIT 1");
$story = $story_query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hành Trình Yêu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f9f9f9;
            color: #333;
        }
        .countdown {
            font-size: 2em;
            margin-top: 20px;
            padding: 20px;
            background-color: #ffcccb;
            border-radius: 5px;
        }
        .images-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .image-card {
            margin: 10px;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            width: 200px;
        }
        .image-card img {
            max-width: 100%;
            border-radius: 5px;
        }
        .story {
            margin-top: 40px;
            padding: 20px;
            background-color: #e0f7fa;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>

    <h1>Chào mừng đến với Hành Trình Yêu Của Chúng Tôi</h1>

    <!-- Hiển thị số ngày yêu -->
    <div class="countdown">
        <p>Chúng tôi đã yêu nhau được: <strong><?php echo $days_together; ?> ngày</strong></p>
    </div>

    <!-- Hiển thị ảnh và mô tả hành trình -->
    <div class="images-gallery">
        <?php foreach ($images as $image): ?>
            <div class="image-card">
                <img src="<?php echo $image['image_path']; ?>" alt="Journey Image">
                <p><?php echo $image['description']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Hiển thị câu chuyện -->
    <div class="story">
        <h2>Câu chuyện tình yêu</h2>
        <p><?php echo $story['content']; ?></p>
    </div>

</body>
</html>