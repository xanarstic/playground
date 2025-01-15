<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding-left: 250px;
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

        .table-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .table-box {
            flex: 1;
            min-width: 300px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .table-box h3 {
            background-color: #333;
            color: #fff;
            margin: 0;
            padding: 10px;
            text-align: center;
        }

        .table-box table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-box table th,
        .table-box table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table-box table th {
            background-color: #f4f4f4;
        }

        .btn-add {
            margin-bottom: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-add:hover {
            background-color: #0056b3;
        }

        /* Pop-up styles */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .popup-content h3 {
            margin-top: 0;
        }

        .popup-content label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .popup-content input,
        .popup-content select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .popup-content button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup-content button:hover {
            background-color: #218838;
        }

        .close-btn {
            background-color: #dc3545;
            margin-left: 10px;
        }

        .close-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <header>
            <h1>Penyewaan</h1>
        </header>
        <main>
            <button class="btn-add" id="btnAdd">Tambah Sewa</button>
            <section>
                <div class="table-container">
                    <div class="table-box">
                        <h3>Daftar Penyewaan</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Wahana</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Mulai</th>
                                    <th>Durasi</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Nama Orang Tua</th>
                                    <th>No HP</th>
                                    <th>Nama Anak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($penyewaan)): ?>
                                    <?php foreach ($penyewaan as $row): ?>
                                        <tr>
                                            <td><?= esc($row['id_penyewaan']) ?></td>
                                            <td><?= esc($row['id_wahana']) ?></td>
                                            <td><?= esc($row['tanggal']) ?></td>
                                            <td><?= esc($row['waktu_mulai']) ?></td>
                                            <td><?= esc($row['durasi']) ?></td>
                                            <td><?= esc($row['total']) ?></td>
                                            <td><?= esc($row['status']) ?></td>
                                            <td><?= esc($row['nama_ortu']) ?></td>
                                            <td><?= esc($row['nohp']) ?></td>
                                            <td><?= esc($row['nama_anak']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="10">No data available</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Pop-up Form -->
    <div class="popup" id="popupForm">
        <div class="popup-content">
            <h3>Tambah Sewa</h3>
            <form action="/home/tambahsewa" method="POST">
                <label for="id_wahana">Wahana</label>
                <select name="id_wahana" id="id_wahana" onchange="updateTotal()">
                    <?php foreach ($wahana as $w): ?>
                        <option value="<?= esc($w['id_wahana']) ?>" data-harga="<?= esc($w['harga']) ?>"><?= esc($w['nama_wahana']) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" required readonly>

                <label for="waktu_mulai">Waktu Mulai</label>
                <input type="text" name="waktu_mulai" id="waktu_mulai" value="" required readonly>

                <label for="durasi">Durasi (Jam)</label>
                <input type="number" name="durasi" id="durasi" required min="1" onchange="updateTotal()">

                <label for="total">Total</label>
                <input type="text" name="total" id="total" value="" readonly>

                <label for="nama_ortu">Nama Orang Tua</label>
                <input type="text" name="nama_ortu" id="nama_ortu" required>

                <label for="nohp">Nomor HP</label>
                <input type="text" name="nohp" id="nohp" required>

                <label for="nama_anak">Nama Anak</label>
                <input type="text" name="nama_anak" id="nama_anak" required>

                <button type="submit">Simpan</button>
                <button type="button" class="close-btn" id="btnClose">Batal</button>
            </form>
        </div>
    </div>

    <script>
        const btnAdd = document.getElementById('btnAdd');
        const popupForm = document.getElementById('popupForm');
        const btnClose = document.getElementById('btnClose');

        btnAdd.addEventListener('click', () => {
            popupForm.style.display = 'flex';
        });

        btnClose.addEventListener('click', () => {
            popupForm.style.display = 'none';
        });
        // Set current time for waktu_mulai input
        document.getElementById('waktu_mulai').value = new Date().toISOString().slice(0, 16);

        function updateTotal() {
            const wahanaSelect = document.getElementById('id_wahana');
            const selectedOption = wahanaSelect.options[wahanaSelect.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            const durasi = document.getElementById('durasi').value;

            if (durasi) {
                document.getElementById('total').value = harga * durasi;
            }
        }
    </script>
</body>


</html>