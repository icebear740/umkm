<?php
require 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM produk WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    if ($_FILES['photo']['name']) {
        // Upload Foto Baru
        $photo = $_FILES['photo']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($photo);

        move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);

        $sql = "UPDATE produk SET name = ?, description = ?, photo = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $photo, $id]);
    } else {
        $sql = "UPDATE produk SET name = ?, description = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $description, $id]);
    }

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Produk</h2>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $item['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="5" required><?= $item['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Foto Produk</label>
            <input type="file" class="form-control" id="photo" name="photo">
            <div class="mt-2">
                <img src="uploads/<?= $item['photo'] ?>" width="150" class="img-thumbnail">
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Update Produk</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
