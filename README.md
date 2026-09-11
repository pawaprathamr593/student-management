# Student Registration & Management Module

A responsive Student Registration & Management Module developed using PHP, MySQL, HTML5, CSS3, JavaScript, and Bootstrap 5.

The application allows users to create, view, search, edit, and delete student records with frontend and backend validation.

## Features

* Add new student records
* View registered students
* Search students by name, email, mobile, course, or department
* Edit existing student records
* Delete student records with confirmation
* Frontend and backend validation
* Duplicate email and mobile prevention
* Prepared SQL statements
* Responsive Bootstrap-based interface
* Success and error alerts
* MySQL database integration

## Technology Stack

| Technology   | Purpose                             |
| ------------ | ----------------------------------- |
| PHP          | Backend processing                  |
| MySQL        | Database                            |
| HTML5        | Page structure                      |
| CSS3         | Custom styling                      |
| JavaScript   | Alerts and client-side interactions |
| Bootstrap 5  | Responsive UI                       |
| XAMPP        | Local development                   |
| Git & GitHub | Version control                     |

## Project Structure

```text
student-management/
│
├── config/
│   └── database.php
│
├── css/
│   └── style.css
│
├── index.php
├── students.php
├── edit.php
├── delete.php
└── README.md
```

## Database

Database name:

```text
student_management
```

Table:

```text
students
```

### Students Table

| Field          | Data Type    | Constraints                 |
| -------------- | ------------ | --------------------------- |
| id             | INT          | Primary Key, Auto Increment |
| student_name   | VARCHAR(100) | NOT NULL                    |
| email          | VARCHAR(150) | NOT NULL, UNIQUE            |
| mobile         | VARCHAR(15)  | NOT NULL, UNIQUE            |
| course         | VARCHAR(100) | NOT NULL                    |
| department     | VARCHAR(100) | NOT NULL                    |
| academic_year  | VARCHAR(20)  | NOT NULL                    |
| admission_date | DATE         | NOT NULL                    |
| created_at     | TIMESTAMP    | Automatically generated     |
| updated_at     | TIMESTAMP    | Automatically updated       |

## CRUD Flow

### Create Student

```text
Registration Form
        ↓
Frontend Validation
        ↓
Backend Validation
        ↓
Prepared SQL Statement
        ↓
MySQL INSERT
        ↓
Success / Error Alert
```

### View Students

```text
students.php
      ↓
MySQL SELECT
      ↓
Display Student Records
```

### Edit Student

```text
Edit
 ↓
Load Existing Student
 ↓
Modify Details
 ↓
Validate
 ↓
MySQL UPDATE
 ↓
Success Alert
```

### Delete Student

```text
Delete
 ↓
Confirmation
 ↓
Validate Student ID
 ↓
MySQL DELETE
 ↓
Success Alert
```

### Search Student

Students can be searched using:

* Student name
* Email
* Mobile number
* Course
* Department

## Validation & Security

The application implements validation on both the frontend and backend.

### Frontend Validation

* Required fields
* Email format validation
* 10-digit mobile validation
* Input type validation
* Date input validation

### Backend Validation

* Required field checks
* Email validation using `filter_var()`
* Mobile validation using `preg_match()`
* ID validation using integer conversion
* Duplicate email/mobile handling
* Prepared SQL statements
* Output escaping using `htmlspecialchars()`

## Local Setup

### Prerequisites

Install:

* XAMPP
* MySQL
* Git
* A web browser

### Installation

1. Clone or place the project inside the XAMPP `htdocs` directory:

```text
/Applications/XAMPP/xamppfiles/htdocs/
```

2. The project folder should be:

```text
/Applications/XAMPP/xamppfiles/htdocs/student-management/
```

3. Start Apache and MySQL.

4. Create the database:

```sql
CREATE DATABASE student_management;
```

5. Select the database:

```sql
USE student_management;
```

6. Create the `students` table using the required schema.

7. Update the MySQL credentials in:

```text
config/database.php
```

## Run the Application

Open:

```text
http://localhost/student-management/
```

The registration page allows new student records to be added.

The student management page can be accessed through:

```text
http://localhost/student-management/students.php
```

## Testing

The application was tested for:

* Successful student registration
* Empty fields
* Invalid email
* Invalid mobile number
* Duplicate email
* Duplicate mobile number
* Viewing student records
* Searching existing students
* Searching with no results
* Editing student records
* Deleting student records
* Delete confirmation
* Invalid student IDs
* Database connection errors
* Responsive layout

## Test Data

Only dummy/test student data is used during development and testing.

No real client, institutional, or sensitive student information is used.

## Version Control

Git and GitHub are used for version control with feature-wise commits, including:

```text
Initial project setup
Implement create student functionality
Add student delete functionality
Add student edit and update functionality
Add student search functionality
Improve responsive design
Add project documentation
```

## Author

Developed as a Web Development learning/company assignment project.
