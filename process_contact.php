<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once "config.php";

    // Basic sanitization
    $name    = trim($_POST["name"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $message === "") {
        // Missing fields
        header("Location: index.php?status=error");
        exit();
    }

    // Prepared statement (safe from SQL injection)
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $message);
        $exec = mysqli_stmt_execute($stmt);

        if ($exec) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: index.php?status=success");
            exit();
        } else {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: index.php?status=error");
            exit();
        }
    } else {
        mysqli_close($conn);
        header("Location: index.php?status=error");
        exit();
    }
} else {
    // Disallow direct access
    header("Location: index.php");
    exit();
}
?>
