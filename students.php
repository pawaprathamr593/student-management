<?php
require_once "config/database.php";

$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student List</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold">Student Management</h1>
            <p class="text-muted mb-0">View registered students</p>
        </div>

        <a href="index.php" class="btn btn-primary">
            Add Student
        </a>
    </div>

    <div class="card shadow-sm">

        <div class="card-header">
            <h4 class="mb-0">Registered Students</h4>
        </div>

        <div class="card-body">

            <?php if ($result->num_rows > 0): ?>

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Course</th>
                                <th>Department</th>
                                <th>Academic Year</th>
                                <th>Admission Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        <?php while ($student = $result->fetch_assoc()): ?>

                            <tr>
                                <td>
                                    <?php echo htmlspecialchars($student["id"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["student_name"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["email"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["mobile"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["course"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["department"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["academic_year"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($student["admission_date"]); ?>
                                </td>
                                <td>
                                    <a
                                        href="edit.php?id=<?php echo $student['id']; ?>"
                                        class="btn btn-warning btn-sm"
                                    >
                                        Edit
                                    </a>
                                    <a
                                        href="delete.php?id=<?php echo $student['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this student?');"
                                    >
                                        Delete
                                    </a>
                                </td>
                            </tr>

                        <?php endwhile; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <div class="alert alert-info mb-0">
                    No students found.
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>

</body>
</html>