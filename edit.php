<?php
require_once "config/database.php";

if (!isset($_GET["id"])) {
    header("Location: students.php");
    exit;
}

$id = (int) $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $studentName = trim($_POST["student_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $mobile = trim($_POST["mobile"] ?? "");
    $course = trim($_POST["course"] ?? "");
    $department = trim($_POST["department"] ?? "");
    $academicYear = trim($_POST["academic_year"] ?? "");
    $admissionDate = trim($_POST["admission_date"] ?? "");

    if (
        empty($studentName) ||
        empty($email) ||
        empty($mobile) ||
        empty($course) ||
        empty($department) ||
        empty($academicYear) ||
        empty($admissionDate)
    ) {

        echo "<script>alert('All fields are required.');</script>";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        echo "<script>alert('Please enter a valid email address.');</script>";

    } elseif (!preg_match("/^[0-9]{10}$/", $mobile)) {

        echo "<script>alert('Mobile number must contain exactly 10 digits.');</script>";

    } else {

        $stmt = $conn->prepare(
            "UPDATE students
             SET student_name = ?,
                 email = ?,
                 mobile = ?,
                 course = ?,
                 department = ?,
                 academic_year = ?,
                 admission_date = ?
             WHERE id = ?"
        );

        $stmt->bind_param(
            "sssssssi",
            $studentName,
            $email,
            $mobile,
            $course,
            $department,
            $academicYear,
            $admissionDate,
            $id
        );

        try {

            $stmt->execute();

            echo "<script>
                    alert('Student updated successfully!');
                    window.location.href = 'students.php';
                  </script>";

            $stmt->close();
            exit;

        } catch (mysqli_sql_exception $e) {

            if ($e->getCode() == 1062) {
                echo "<script>alert('Email or mobile number already exists!');</script>";
            } else {
                echo "<script>alert('Unable to update student.');</script>";
            }
        }

        $stmt->close();
    }
}

$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$student = $result->fetch_assoc();

$stmt->close();

if (!$student) {
    echo "<script>
            alert('Student not found.');
            window.location.href = 'students.php';
          </script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Student</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="text-center mb-4">
        <h1 class="fw-bold">Edit Student</h1>
        <p class="text-muted">Update student information</p>
    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">Update Student Details</h4>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Student Name</label>
                        <input
                            type="text"
                            name="student_name"
                            class="form-control"
                            value="<?php echo htmlspecialchars($student['student_name']); ?>"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email ID</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="<?php echo htmlspecialchars($student['email']); ?>"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input
                            type="tel"
                            name="mobile"
                            class="form-control"
                            value="<?php echo htmlspecialchars($student['mobile']); ?>"
                            pattern="[0-9]{10}"
                            maxlength="10"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Course</label>
                        <input
                            type="text"
                            name="course"
                            class="form-control"
                            value="<?php echo htmlspecialchars($student['course']); ?>"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <input
                            type="text"
                            name="department"
                            class="form-control"
                            value="<?php echo htmlspecialchars($student['department']); ?>"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Academic Year</label>

                        <select
                            name="academic_year"
                            class="form-select"
                            required
                        >
                            <option value="">Select academic year</option>

                            <option value="2026-27"
                                <?php if ($student['academic_year'] === '2026-27') echo 'selected'; ?>>
                                2026-27
                            </option>

                            <option value="2025-26"
                                <?php if ($student['academic_year'] === '2025-26') echo 'selected'; ?>>
                                2025-26
                            </option>

                            <option value="2024-25"
                                <?php if ($student['academic_year'] === '2024-25') echo 'selected'; ?>>
                                2024-25
                            </option>

                            <option value="2023-24"
                                <?php if ($student['academic_year'] === '2023-24') echo 'selected'; ?>>
                                2023-24
                            </option>

                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Admission Date</label>

                        <input
                            type="date"
                            name="admission_date"
                            class="form-control"
                            value="<?php echo htmlspecialchars($student['admission_date']); ?>"
                            required
                        >
                    </div>

                    <div class="col-12 mt-4">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Update Student
                        </button>

                        <a
                            href="students.php"
                            class="btn btn-secondary"
                        >
                            Cancel
                        </a>

                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>