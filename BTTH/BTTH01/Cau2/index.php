<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Bài tập trắc nghiệm</h1>
        <?php
        $filename = "questions.txt";
        if (!file_exists($filename)) {
            echo "<div class='alert alert-danger text-center'>Tệp câu hỏi không tồn tại!</div>";
            exit;
        }

        $questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $quiz = [];
        $current_question = [];

        // Phân tích nội dung tệp
        foreach ($questions as $line) {
            if (strpos($line, "Câu") === 0) {
                if (!empty($current_question)) {
                    $quiz[] = $current_question;
                }
                $current_question = [];
            }
            $current_question[] = $line;
        }
        if (!empty($current_question)) {
            $quiz[] = $current_question;
        }

        // Xử lý bài nộp
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $answers = [];
            foreach ($questions as $line) {
                if (strpos($line, "ANSWER") !== false) {
                    $answers[] = trim(substr($line, strpos($line, ":") + 1));
                }
            }

            $score = 0;
            foreach ($_POST as $key => $userAnswer) {
                $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
                if (isset($answers[$questionNumber - 1]) && $answers[$questionNumber - 1] === $userAnswer) {
                    $score++;
                }
            }

            // Hiển thị kết quả
            echo "<div class='alert alert-success text-center'>";
            echo "Bạn trả lời đúng <strong>$score</strong>/" . count($answers) . " câu.";
            echo "</div>";
            echo '<a href="index.php" class="btn btn-primary d-block mx-auto w-25 text-center">Làm lại</a>';
            exit;
        }
        ?>

        <!-- Form trắc nghiệm -->
        <form action="" method="POST">
            <?php foreach ($quiz as $number => $question): ?>
                <div class="card mb-4">
                    <div class="card-header"><strong><?php echo $question[0]; ?></strong></div>
                    <div class="card-body">
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                            <?php 
                                $answer = substr($question[$i], 0, 1); // Lấy ký tự đầu (A, B, C, D)
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question<?php echo $number + 1; ?>" 
                                       value="<?php echo $answer; ?>" id="question<?php echo $number + 1 . $answer; ?>" required>
                                <label class="form-check-label" for="question<?php echo $number + 1 . $answer; ?>">
                                    <?php echo $question[$i]; ?>
                                </label>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Nút nộp bài -->
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
