<?php
require_once "config/database.php";

if (isset($_GET["id"])) {

    $id = (int) $_GET["id"];

    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);

    try {
        $stmt->execute();

        echo "<script>
                alert('Student deleted successfully!');
                window.location.href = 'students.php';
              </script>";

    } catch (mysqli_sql_exception $e) {

        echo "<script>
                alert('Unable to delete student.');
                window.location.href = 'students.php';
              </script>";
    }

    $stmt->close();

} else {

    header("Location: students.php");
    exit;
}
?>