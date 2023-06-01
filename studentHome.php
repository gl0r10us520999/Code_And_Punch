<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Home</title>
</head>

<body>
    <?php
    session_start();
    
    
    // Kiểm tra nếu câu trả lời đúng
    $isCorrectAnswer = isset($_SESSION['answer']) ? $_SESSION['answer'] : false;

    ?>

    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <h1>Your challenge</h1>
    <h2><?php echo $_SESSION['challenge_name']; ?></h2>

    <h2 name="deadline">Deadline:</h2>
    <?php echo isset($_SESSION['deadline']) ? $_SESSION['deadline'] : 'nothing in hhere'; ?>

    <h2 name="description">Description:</h2>
    <?php echo isset($_SESSION['description']) ? $_SESSION['description'] : 'nothing in here'; ?>

    <h2>Write your answer:</h2>
    <form action="student_upload.php" method="post">
        <textarea name="answer" rows="4" cols="50" placeholder="Enter your answer"></textarea>
        <button type="submit" name="submit_answer">Submit Answer</button>
    </form>

    <?php
    if ($isCorrectAnswer) {
        echo '<h2>Answer file:</h2>';
        echo '<iframe src="' . $_SESSION['file_path'] . '" width="100%" height="500px"></iframe>';
    } else {
        echo 'wrong';
    }
    ?>

    <!-- Logout link -->
    <a href="logout.php">Logout</a>
</body>

</html>
