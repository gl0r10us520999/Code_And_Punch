<?php
    global $conn;
    //Connect to DB
    function connectDB() {
        global $conn;
        $conn = mysqli_connect("localhost", "root", "", "CodeAndPunch");

        if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
        }
    }
    //Disconnect DB
    function disconnectDB() {
        global $conn;
        if ($conn) {
            mysqli_close($conn);
        }
    }
    //Edit student informations
    function Edit_Student($student_id, $student_name, $student_email, $student_phone) {
        $conn = connectDB();
        $stmt = $conn->prepare("UPDATE students SET name=?, email=?, phone=? WHERE id=?");
        $stmt->bind_param("sssi", $student_name, $student_email, $student_phone, $student_id);
        
        if ($stmt->execute()) {
            echo "Student information has been successfully updated!";
        } else {
            echo "An error occurred while updating student information!";
        }
    
        $stmt->close();
        $conn->close();
    }
    //Delete student
    function Delete_Student($student_id) {
        $conn = connectDB();
        $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
        $stmt->bind_param("i", $student_id);
        
        if ($stmt->execute()) {
            echo "Student has been deleted!";
        } else {
            echo "An error occurred while deleting the student!";
        }
    
        $stmt->close();
        $conn->close();
    }
    // Add student
    function Add_Student($conn, $username, $password, $name, $email, $phone_number) {
        // Check if username exist or not
        $checkQuery = "SELECT * FROM student WHERE username = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            echo "Username already exists!";
            return;
        }
    
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Thêm sinh viên vào cơ sở dữ liệu
        $insertQuery = "INSERT INTO student (username, password, name, email, phone_number) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("sssss", $username, $hashed_password, $name, $email, $phone_number);
    
        if ($stmt->execute()) {
            echo "Student information has been successfully updated!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
?>