<?php
if (isset($_GET['file'])) {
    $filePath = $_GET['file'];

    if (file_exists($filePath)) {
        $fileContent = file_get_contents($filePath);
        echo "<pre>" . htmlspecialchars($fileContent) . "</pre>";
    } else {
        echo "File không tồn tại.";
    }
} else {
    echo "Chọn một file để xem.";
}

// Kiểm tra xem có file được gửi lên hay không
if(isset($_FILES['uploaded_file'])) {
    $file = $_FILES['uploaded_file'];

    // Lấy thông tin về file
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_error = $file['error'];
    // Kiểm tra xem có lỗi trong quá trình upload hay không
    if($file_error === UPLOAD_ERR_OK) {
        // Di chuyển file tạm vào đường dẫn lưu trữ của bạn
        $destination = '\Code and Punch\Quân\uploads\file_' . $file_name;
        move_uploaded_file($file_tmp, $destination);

        // Lưu thông tin file vào cơ sở dữ liệu
        $db_host = 'localhost'; 
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'codeandpunch';

        // Kết nối đến cơ sở dữ liệu
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }

        // Chuẩn bị truy vấn SQL để chèn thông tin file vào cơ sở dữ liệu
        $sql = "INSERT INTO bai_tap (file_name, file_path) VALUES ('$file_name', '$destination')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Upload file thành công và lưu thông tin vào cơ sở dữ liệu.";
        } else {
            echo "Lỗi: " . $conn->error;
        }

        // Đóng kết nối đến cơ sở dữ liệu
        $conn->close();
    } else {
        echo "Lỗi trong quá trình upload file.";
    }
}
?>  
