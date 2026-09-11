<?php
require_once "config/database.php";

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
            "INSERT INTO students
            (student_name, email, mobile, course, department, academic_year, admission_date)
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "sssssss",
            $studentName,
            $email,
            $mobile,
            $course,
            $department,
            $academicYear,
            $admissionDate
        );

        try {

            $stmt->execute();

            echo "<script>alert('Student added successfully!');</script>";

        } catch (mysqli_sql_exception $e) {

            if ($e->getCode() == 1062) {
                echo "<script>alert('Email or mobile number already exists!');</script>";
            } else {
                echo "<script>alert('Unable to add student.');</script>";
            }
        }

        $stmt->close();
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Management</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <!-- Page Header -->
    <div class="text-center mb-4">

        <h1 class="fw-bold">
            Student Registration
        </h1>

        <p class="text-muted">
            Add and manage student records
        </p>

    </div>


    <!-- Registration Card -->
    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">
                Add New Student
            </h4>
        </div>

        <div class="card-body">

            <form id="studentForm" method="POST">

                <div class="row g-3">

                    <!-- Student Name -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Student Name
                        </label>

                        <input
                            type="text"
                            name="student_name"
                            class="form-control"
                            placeholder="Enter student name"
                            required
                        >

                    </div>


                    <!-- Email -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Email ID
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter email"
                            required
                        >

                    </div>


                    <!-- Mobile -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Mobile Number
                        </label>

                        <input
                            type="tel"
                            name="mobile"
                            class="form-control"
                            placeholder="Enter 10-digit mobile number"
                            pattern="[0-9]{10}"
                            maxlength="10"
                            required
                        >

                    </div>


                    <!-- Course -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Course
                        </label>

                        <input
                            type="text"
                            name="course"
                            class="form-control"
                            placeholder="Enter course"
                            required
                        >

                    </div>


                    <!-- Department -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Department
                        </label>

                        <input
                            type="text"
                            name="department"
                            class="form-control"
                            placeholder="Enter department"
                            required
                        >

                    </div>


                    <!-- Academic Year -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Academic Year
                        </label>

                        <select
                            name="academic_year"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select academic year
                            </option>

                            <option value="2026-27">
                                2026-27
                            </option>

                            <option value="2025-26">
                                2025-26
                            </option>

                            <option value="2024-25">
                                2024-25
                            </option>

                            <option value="2023-24">
                                2023-24
                            </option>

                        </select>

                    </div>


                    <!-- Admission Date -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Admission Date
                        </label>

                        <input
                            type="date"
                            name="admission_date"
                            class="form-control"
                            required
                        >

                    </div>


                    <!-- Buttons -->
                    <div class="col-12 mt-4">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Add Student
                        </button>

                        <button
                            type="reset"
                            class="btn btn-secondary"
                        >
                            Reset
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- Bootstrap JS -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


<!-- Auto-hide Alert -->
<script>

    setTimeout(function () {

        const alert = document.querySelector(".alert");

        if (alert) {
            alert.style.display = "none";
        }

    }, 3000);

</script>

</body>
</html>