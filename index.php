<?php
require 'db.php';

$sql = "SELECT * FROM produk";
$stmt = $pdo->query($sql);
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPEKA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Navbar transparent style */
        .navbar {
            transition: background-color 0.3s ease;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .navbar.scrolled {
            background-color: rgba(0, 0, 0, 0.85);
        }

        /* Center menu items */
        .navbar-nav {
            margin: auto;
        }
        .navbar {
            z-index: 1000;
        }

        /* Carousel image settings */
        .carousel-item img {
            object-fit: cover;
            height: 600px;
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SIPEKA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Informasi Kelurahan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Informasi Warga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">UMKM</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel" style="margin-top: 56px;">
        <div class="carousel-inner">
            <?php foreach ($items as $index => $item): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <img src="uploads/<?= $item['photo'] ?>" class="d-block w-100" alt="<?= $item['name'] ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?= $item['name'] ?></h5>
                    <p><?= $item['description'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Cards -->
    <div class="container mt-5">
        <h2 class="text-center" data-aos="fade-up">Data Produk</h2>
        <a href="create.php" class="btn btn-primary mb-3">Tambah Data</a>
        <div class="row">
            <?php foreach ($items as $item): ?>
            <div class="col-md-4" data-aos="zoom-in"  >
                <div class="card mb-4">
                    <img src="uploads/<?= $item['photo'] ?>" class="card-img-top" alt="<?= $item['name'] ?>"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['name'] ?></h5>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#descriptionModal<?= $item['id'] ?>">
                            <i class="fas fa-info-circle"></i>
                        </button>
                        <a href="edit.php?id=<?= $item['id'] ?>" class="btn btn-white">
                        <i class="fas fa-edit"></i>
                        </a>
                        <a href="delete.php?id=<?= $item['id'] ?>" class="btn btn-white"
                            onclick="return confirm('Apakah Anda yakin?')"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
            </div>
            

            <!-- Modal -->
            <div class="modal fade" id="descriptionModal<?= $item['id'] ?>" tabindex="-1"
    aria-labelledby="descriptionModalLabel<?= $item['id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Tambahkan kelas modal-lg atau modal-xl di sini -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel<?= $item['id'] ?>">Deskripsi Produk: <?= $item['name'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="uploads/<?= $item['photo'] ?>" class="card-img-top" alt="<?= $item['name'] ?>"
                    style="height: 400px; object-fit: cover;"> <!-- Ukuran gambar diperbesar -->
                <p><?= $item['description'] ?></p> <!-- Penambahan paragraf untuk deskripsi -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
    <script>
        window.addEventListener('scroll', function () {
            var navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>
