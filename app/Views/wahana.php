<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wahana</title>

    <style>
        /* dashboard.css */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            padding-left: 250px;
            color: #333;
        }

        .dashboard header {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .dashboard main {
            padding: 30px;
        }

        .table-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .table-box {
            flex: 1;
            min-width: 300px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .table-box:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .table-box h3 {
            background-color: #333;
            color: white;
            margin: 0;
            padding: 15px;
            text-align: center;
            font-size: 1.2em;
        }

        .table-box table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-box table th,
        .table-box table td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table-box table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .table-box table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table-box table tr:hover {
            background-color: #d1ecf1;
        }

        .popup-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-form .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            width: 500px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(30px);
            animation: fadeIn 0.5s ease-out;
        }

        .popup-form .form-container h3 {
            text-align: center;
            font-size: 1.5em;
            color: #333;
            margin-bottom: 20px;
        }

        .popup-form input,
        .popup-form select,
        .popup-form button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }

        .popup-form input:focus,
        .popup-form select:focus {
            border-color: #333;
            outline: none;
        }

        .add-wahana-btn {
            background-color: #333;
            color: white;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1em;
            border: none;
            transition: background-color 0.3s;
        }

        .add-wahana-btn:hover {
            background-color: rgb(49, 49, 49);
        }

        .close-popup-btn {
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            width: auto;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .close-popup-btn:hover {
            background-color: #c82333;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <header>
            <h1>Wahana</h1>
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php elseif (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('errors') ?></div>
            <?php endif; ?>
        </header>
        <main>
            <button class="add-wahana-btn" onclick="showPopup()">Add Wahana</button>

            <section>
                <div class="table-container">
                    <div class="table-box">
                        <h3>Wahana List</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama Wahana</th>
                                    <th>Harga</th>
                                    <th>Kapasitas</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($wahanas as $wahana): ?>
                                    <tr>
                                        <td><?= esc($wahana['nama_wahana']) ?></td>
                                        <td><?= esc($wahana['harga']) ?></td>
                                        <td><?= esc($wahana['kapasitas']) ?></td>
                                        <td><?= esc($wahana['status']) ?></td>
                                        <td><?= esc($wahana['created_at']) ?></td>
                                        <td><?= esc($wahana['updated_at']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <div id="popup-form" class="popup-form">
                <div class="form-container">
                    <h3>Add New Wahana</h3>
                    <!-- Form untuk menambah wahana -->
                    <form action="/home/addWahana" method="POST">
                        <?= csrf_field() ?>

                        <label for="nama_wahana">Nama Wahana</label>
                        <input type="text" id="nama_wahana" name="nama_wahana" required
                            value="<?= old('nama_wahana') ?>">
                        <?php if (isset($errors['nama_wahana'])): ?>
                            <div class="error"><?= esc($errors['nama_wahana']) ?></div>
                        <?php endif; ?>

                        <label for="harga">Harga</label>
                        <input type="text" id="harga" name="harga" required value="<?= old('harga') ?>">
                        <?php if (isset($errors['harga'])): ?>
                            <div class="error"><?= esc($errors['harga']) ?></div>
                        <?php endif; ?>

                        <label for="kapasitas">Kapasitas</label>
                        <input type="text" id="kapasitas" name="kapasitas" required value="<?= old('kapasitas') ?>">
                        <?php if (isset($errors['kapasitas'])): ?>
                            <div class="error"><?= esc($errors['kapasitas']) ?></div>
                        <?php endif; ?>

                        <label for="status">Status</label>
                        <select id="status" name="status" required>
                            <option value="Tersedia" <?= old('status') == 'Tersedia' ? 'selected' : '' ?>>Tersedia</option>
                            <option value="Tidak Tersedia" <?= old('status') == 'Tidak Tersedia' ? 'selected' : '' ?>>Tidak
                                Tersedia</option>
                        </select>
                        <?php if (isset($errors['status'])): ?>
                            <div class="error"><?= esc($errors['status']) ?></div>
                        <?php endif; ?>

                        <button type="submit">Save Wahana</button>
                        <button type="button" class="close-popup-btn" onclick="closePopup()">Cancel</button>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <script>
        function showPopup() {
            document.getElementById('popup-form').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('popup-form').style.display = 'none';
        }
    </script>
</body>

</html>