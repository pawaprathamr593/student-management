<?php
require_once "config/database.php";

$search = trim($_GET["search"] ?? "");

if ($search !== "") {

    $searchTerm = "%" . $search . "%";

    $stmt = $conn->prepare(
        "SELECT * FROM students
         WHERE student_name LIKE ?
         OR email LIKE ?
         OR mobile LIKE ?
         OR course LIKE ?
         OR department LIKE ?
         ORDER BY id DESC"
    );

    $stmt->bind_param(
        "sssss",
        $searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm,
        $searchTerm
    );

    $stmt->execute();

    $result = $stmt->get_result();

} else {

    $result = $conn->query(
        "SELECT * FROM students ORDER BY id DESC"
    );
}
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


            <div class="table-responsive">
                <form method="GET" class="mb-4">
                     <div class="input-group">

                         <input
                            type="text"
                            name="search"                                class="form-control"
                            placeholder="Search by name, email, mobile, course or department"
                            value="<?php echo htmlspecialchars($search); ?>"
                        >

                        <button type="submit" class="btn btn-primary">
                            Search
                        </button>

                        <a href="students.php" class="btn btn-secondary">
                            Clear
                        </a>
                    </div>

                </form>
                <?php if ($result->num_rows > 0): ?>
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