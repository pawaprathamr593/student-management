<?php
require_once "config/database.php";
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

    <div class="text-center mb-4">
        <h1 class="fw-bold">Student Registration</h1>
        <p class="text-muted">Add and manage student records</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Add New Student</h4>
        </div>

        <div class="card-body">

            <form id="studentForm" method="POST">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Student Name</label>
                        <input
                            type="text"
                            name="student_name"
                            class="form-control"
                            placeholder="Enter student name"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email ID</label>
                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Enter email"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input
                            type="tel"
                            name="mobile"
                            class="form-control"
                            placeholder="Enter mobile number"
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
                            placeholder="Enter course"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <input
                            type="text"
                            name="department"
                            class="form-control"
                            placeholder="Enter department"
                            required
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Academic Year</label>
                        <select name="academic_year" class="form-select" required>
                            <option value="">Select academic year</option>
                            <option value="2026-27">2026-27</option>
                            <option value="2025-26">2025-26</option>
                            <option value="2024-25">2024-25</option>
                            <option value="2023-24">2023-24</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Admission Date</label>
                        <input
                            type="date"
                            name="admission_date"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">
                            Add Student
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Reset
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>