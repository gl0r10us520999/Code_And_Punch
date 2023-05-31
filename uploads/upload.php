<?php
$targetDir = "uploads/";
$fileToUpload = $_FILES["fileToUpload"] ?? null;

if ($fileToUpload && $fileToUpload["error"] == UPLOAD_ERR_OK) {
    $targetFile = $targetDir . basename($fileToUpload["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (file_exists($targetFile)) {
        echo "File đã tồn tại.";
        $uploadOk = 0;
    }

    if ($fileToUpload["size"] > 500000) {
        echo "File quá lớn.";
        $uploadOk = 0;
    }

    if ($fileType != "txt") {
        echo "Chỉ được phép tải lên các tệp tin .txt.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Tệp tin không được tải lên.";
    } else {
        if (move_uploaded_file($fileToUpload["tmp_name"], $targetFile)) {
            echo "Tệp tin " . basename($fileToUpload["name"]) . " đã được tải lên thành công.";
        } else {
            echo "Có lỗi xảy ra khi tải lên tệp tin.";
        }
    }
} else {
    echo "Có lỗi xảy ra khi tải lên tệp tin.";
}
?>