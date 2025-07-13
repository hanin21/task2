<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "task2_db";

$conn = mysqli_connect($host, $user, $password, $db);
if (!$conn) {
  die("فشل الاتصال: " . mysqli_connect_error());
}

// حذف صف
if (isset($_POST['delete_id'])) {
  $id = $_POST['delete_id'];
  mysqli_query($conn, "DELETE FROM users WHERE id = $id");
}

// تبديل الحالة
if (isset($_POST['toggle_id'])) {
  $id = $_POST['toggle_id'];
  $result = mysqli_query($conn, "SELECT status FROM users WHERE id = $id");
  $row = mysqli_fetch_assoc($result);
  $newStatus = $row['status'] == 1 ? 0 : 1;
  mysqli_query($conn, "UPDATE users SET status = $newStatus WHERE id = $id");
}

// إدخال بيانات جديدة
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['age'])) {
  $name = $_POST["name"];
  $age = $_POST["age"];
  if (!empty($name) && !empty($age)) {
    $sql = "INSERT INTO users (name, age, status) VALUES ('$name', '$age', 0)";
    mysqli_query($conn, $sql);
  }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>التاسك الثاني</title>
  <style>
    body { font-family: Tahoma; background: #f4f4f4; text-align: center; padding: 30px; }
    form { background: white; padding: 20px; display: inline-block; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
    input, button { padding: 10px; margin: 10px; border-radius: 5px; border: 1px solid #ccc; }
    button { background-color: #3a86ff; color: white; border: none; cursor: pointer; }
    table { margin: auto; margin-top: 30px; width: 80%; border-collapse: collapse; background: white; box-shadow: 0 0 10px #ccc; }
    th, td { padding: 10px; border: 1px solid #ccc; }
    .delete-btn { background-color: red; color: white; }
  </style>
</head>
<body>

<h1>نموذج بيانات</h1>

<form method="POST">
  <input type="text" name="name" placeholder="الاسم" required>
  <input type="number" name="age" placeholder="العمر" required>
  <button type="submit">إرسال</button>
</form>

<table>
  <tr>
    <th>الرقم</th>
    <th>الاسم</th>
    <th>العمر</th>
    <th>الحالة</th>
    <th>تعديل</th>
  </tr>

  <?php
  $result = mysqli_query($conn, "SELECT * FROM users");
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['age'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>
      <form method='POST' style='display:inline'>
        <input type='hidden' name='toggle_id' value='" . $row['id'] . "'>
        <button type='submit'>Toggle</button>
      </form>
      <form method='POST' style='display:inline'>
        <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
        <button type='submit' class='delete-btn'>Delete</button>
      </form>
    </td>";
    echo "</tr>";
  }
  ?>
</table>

</body>
</html>