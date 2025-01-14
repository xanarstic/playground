<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Settings</title>

    <style>
        /* dashboard.css */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding-left: 250px;
            /* Space for the sidebar */
        }

        .dashboard header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .dashboard main {
            padding: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-container input[type="file"],
        .form-container input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            margin-bottom: 10px;
        }

        .form-container input[type="file"] {
            background-color: #f4f4f4;
        }

        .form-container button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-container button:hover {
            background-color: #555;
        }

        @media (max-width: 768px) {
            body {
                padding-left: 200px;
                /* Adjust for smaller sidebar */
            }
        }

        .form-container img {
            width: 150px;
            /* Atur lebar gambar */
            height: 150px;
            /* Atur tinggi gambar */
            object-fit: cover;
            /* Agar gambar tetap proporsional dan tidak terdistorsi */
            margin-bottom: 20px;
            border-radius: 8px;
            /* Untuk membuat gambar sedikit membulat pada pojoknya */
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <header>
            <h1>Settings</h1>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('errors') ?></div>
            <?php endif; ?>
        </header>
        <main>
            <form action="/home/updateSettings" method="POST" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="form-container">
                    <!-- Input untuk Icon Tab -->
                    <label for="website-icon">Icon Tab</label>
                    <input type="file" id="website-icon" name="website-icon" accept="image/*">
                    <img src="<?= base_url('img/' . esc($setting['icontab'] ?? 'default-icon.png')) ?>" alt="Icon Tab"
                        class="website-icon">

                    <!-- Input untuk Icon Login -->
                    <label for="sidebar-bg">Icon Login</label>
                    <input type="file" id="sidebar-bg" name="sidebar-bg" accept="image/*">
                    <img src="<?= base_url('img/' . esc($setting['iconlogin'] ?? 'default-login.png')) ?>"
                        alt="Icon Login" class="icon-login">

                    <!-- Input untuk Background Menu -->
                    <label for="background-menu">Background Menu</label>
                    <input type="file" id="background-menu" name="background-menu" accept="image/*">
                    <img src="<?= base_url('img/' . esc($setting['iconmenu'] ?? 'default-menu.png')) ?>"
                        alt="Background Menu" class="background-menu">

                    <!-- Input untuk Nama Website -->
                    <label for="website-name">Website Name</label>
                    <input type="text" id="website-name" name="website-name"
                        value="<?= esc($setting['namawebsite'] ?? '') ?>" placeholder="Enter website name">

                    <!-- Tombol Submit -->
                    <button type="submit">Save Settings</button>
                </div>
            </form>
        </main>
    </div>
</body>




<!-- Input for uploading header photo -->
<!-- <label for="header-photo">Header Photo</label>
                    <input type="file" id="header-photo" name="header-photo" accept="image/*"> -->
<!-- Input for setting app title -->




</html>