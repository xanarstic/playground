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
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>
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
                                    <th>Waktu Selesai</th>
                                    <th>Countdown</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Nama Orang Tua</th>
                                    <th>No HP</th>
                                    <th>Nama Anak</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($penyewaan)): ?>
                                    <?php foreach ($penyewaan as $row): ?>
                                        <tr>
                                            <td><?= esc($row['id_penyewaan']) ?></td>
                                            <td><?= esc($row['nama_wahana']) ?></td>
                                            <td><?= esc($row['tanggal']) ?></td>
                                            <td><?= esc($row['waktu_mulai']) ?></td>
                                            <td><?= esc($row['durasi']) ?> Jam</td>
                                            <td><?= esc($row['waktu_selesai']) ?></td>
                                            <td id="countdown-<?= esc($row['id_penyewaan']) ?>"></td>
                                            <td>Rp <?= esc(number_format($row['total'], 0, ',', '.')) ?></td>
                                            <td id="status-<?= esc($row['id_penyewaan']) ?>"><?= esc($row['status']) ?></td>
                                            <td><?= esc($row['nama_ortu']) ?></td>
                                            <td><?= esc($row['nohp']) ?></td>
                                            <td><?= esc($row['nama_anak']) ?></td>
                                            <td>
                                                <?php if ($row['status'] == 'Pending'): ?>
                                                    <button class="btn-bayar"
                                                        onclick="bayarPenyewaan(<?= esc($row['id_penyewaan']) ?>, <?= esc($row['total']) ?>)">Bayar</button>
                                                <?php endif; ?>
                                                <button class="btn-edit" data-id="<?= esc($row['id_penyewaan']) ?>"
                                                    onclick="editPenyewaan(this)">Edit</button>
                                                <form action="/home/deleteSewa/<?= esc($row['id_penyewaan']) ?>" method="POST"
                                                    style="display:inline;">
                                                    <button type="submit"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus penyewaan ini?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <script>
                                            startCountdown(<?= esc($row['id_penyewaan']) ?>,
                                                '<?= date('c', strtotime($row['waktu_mulai'])) ?>',
                                                '<?= date('c', strtotime($row['waktu_selesai'])) ?>',
                                                '<?= esc($row['status']) ?>');
                                        </script>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="13">No data available</td>
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
                <select name="id_wahana" id="id_wahana" onchange="updateTotal()" required>
                    <?php foreach ($wahana as $w): ?>
                        <option value="<?= esc($w['id_wahana']) ?>" data-harga="<?= esc($w['harga']) ?>">
                            <?= esc($w['nama_wahana']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" required>

                <label for="waktu_mulai">Waktu Mulai</label>
                <input type="time" name="waktu_mulai" id="waktu_mulai" required>

                <label for="durasi">Durasi (Jam)</label>
                <input type="number" name="durasi" id="durasi" required min="1" step="1" onchange="updateTotal()">

                <label for="waktu_selesai">Waktu Selesai</label>
                <input type="time" name="waktu_selesai" id="waktu_selesai" readonly required>

                <label for="total">Total</label>
                <input type="number" name="total" id="total" value="" readonly required>

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

    <!-- Pop-up Form -->
    <div class="popup" id="popupForm">
        <div class="popup-content">
            <h3>Tambah/Edit Sewa</h3>
            <form action="/home/tambahsewa" method="POST" id="formSewa">
                <input type="hidden" name="id_penyewaan" id="id_penyewaan">

                <label for="id_wahana">Wahana</label>
                <select name="id_wahana" id="id_wahana" onchange="updateTotal()" required>
                    <?php foreach ($wahana as $w): ?>
                        <option value="<?= esc($w['id_wahana']) ?>" data-harga="<?= esc($w['harga']) ?>">
                            <?= esc($w['nama_wahana']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" required>

                <label for="waktu_mulai">Waktu Mulai</label>
                <input type="time" name="waktu_mulai" id="waktu_mulai" required>

                <label for="durasi">Durasi (Jam)</label>
                <input type="number" name="durasi" id="durasi" required min="1" step="1" onchange="updateTotal()">

                <label for="waktu_selesai">Waktu Selesai</label>
                <input type="time" name="waktu_selesai" id="waktu_selesai" readonly required>

                <label for="total">Total</label>
                <input type="number" name="total" id="total" value="" readonly required>

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

    <!-- Pop-up Bayar -->
    <div class="popup" id="popupBayarForm">
        <div class="popup-content">
            <h3>Pembayaran Penyewaan</h3>
            <form action="/home/prosesBayar" method="POST" id="bayarForm">
                <input type="hidden" name="id_penyewaan" value="<?= $idpenyewaan ?>">

                <label for="total">Total</label>
                <input type="number" name="total" id="total_bayar" readonly required>

                <label for="bayar">Bayar</label>
                <input type="number" name="bayar" id="bayar" required oninput="updateKembalian()">

                <label for="kembalian">Kembalian</label>
                <input type="number" name="kembalian" id="kembalian" readonly required>

                <label for="payment">Metode Pembayaran</label>
                <select name="payment" id="payment" required>
                    <option value="cash">Cash</option>
                    <option value="transfer">Transfer</option>
                </select>

                <button type="submit">Proses Pembayaran</button>
                <button type="button" class="close-btn" id="btnCloseBayar">Batal</button>
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
            const harga = selectedOption.getAttribute('data-harga'); // Harga wahana
            const durasi = parseInt(document.getElementById('durasi').value); // Durasi dalam bilangan bulat

            if (durasi && harga) {
                document.getElementById('total').value = harga * durasi; // Hitung total harga
            }
        }

        function updateWaktuSelesai() {
            const waktuMulaiInput = document.getElementById('waktu_mulai');
            const durasiInput = document.getElementById('durasi');

            // Pastikan waktu mulai dan durasi sudah terisi
            if (waktuMulaiInput.value && durasiInput.value) {
                const waktuMulai = new Date(`1970-01-01T${waktuMulaiInput.value}:00`); // Konversi waktu mulai ke objek Date
                waktuMulai.setHours(waktuMulai.getHours() + parseInt(durasiInput.value)); // Tambah durasi jam ke waktu mulai

                // Format waktu selesai
                const waktuSelesai = new Date(waktuMulai);
                const hours = String(waktuSelesai.getHours()).padStart(2, '0');
                const minutes = String(waktuSelesai.getMinutes()).padStart(2, '0');
                const waktuSelesaiFormatted = `${hours}:${minutes}`;

                // Set waktu selesai ke input
                document.getElementById('waktu_selesai').value = waktuSelesaiFormatted;
            }
        }

        // Panggil fungsi updateWaktuSelesai setiap kali durasi atau waktu mulai berubah
        document.getElementById('waktu_mulai').addEventListener('change', updateWaktuSelesai);
        document.getElementById('durasi').addEventListener('change', updateWaktuSelesai);
        document.querySelector('form').addEventListener('submit', function() {
            // Set waktu_selesai sebelum form disubmit
            updateWaktuSelesai();
        });

        function editPenyewaan(button) {
            const idPenyewaan = button.getAttribute('data-id');
            const idWahana = button.getAttribute('data-wahana');
            const tanggal = button.getAttribute('data-tanggal');
            const waktuMulai = button.getAttribute('data-waktu_mulai');
            const durasi = button.getAttribute('data-durasi');
            const total = button.getAttribute('data-total');
            const namaOrtu = button.getAttribute('data-nama_ortu');
            const nohp = button.getAttribute('data-nohp');
            const namaAnak = button.getAttribute('data-nama_anak');

            // Set values in the form
            document.getElementById('id_penyewaan').value = idPenyewaan;
            document.getElementById('id_wahana').value = idWahana;
            document.getElementById('tanggal').value = tanggal;
            document.getElementById('waktu_mulai').value = waktuMulai;
            document.getElementById('durasi').value = durasi;
            document.getElementById('total').value = total;
            document.getElementById('nama_ortu').value = namaOrtu;
            document.getElementById('nohp').value = nohp;
            document.getElementById('nama_anak').value = namaAnak;

            // Show the popup
            document.getElementById('popupForm').style.display = 'flex';
        }

        // Close the pop-up form
        document.getElementById('btnClose').addEventListener('click', () => {
            document.getElementById('popupForm').style.display = 'none';
        });

        // Fungsi untuk membuka form bayar
        function bayarPenyewaan(id, total) {
            document.getElementById('id_penyewaan').value = id;
            document.getElementById('total_bayar').value = total;
            console.log("ID Penyewaan (JS): " + id); // Log ID here to check
            document.getElementById('popupBayarForm').style.display = 'flex'; // Tampilkan pop-up
        }

        // Fungsi untuk menghitung kembalian
        function updateKembalian() {
            const bayar = parseFloat(document.getElementById('bayar').value);
            const total = parseFloat(document.getElementById('total_bayar').value);
            if (bayar >= total) {
                document.getElementById('kembalian').value = bayar - total;
            } else {
                document.getElementById('kembalian').value = 0;
            }
        }

        // Function to set the id_penyewaan dynamically
        function setIdPenyewaan(id) {
            document.getElementById('id_penyewaan').value = id;
        }

        function bayarPenyewaan(id, total) {
            document.getElementById('id_penyewaan').value = id;
            document.getElementById('total_bayar').value = total;

            // Debugging: Cek apakah id_penyewaan sudah di-set dengan benar
            console.log("ID Penyewaan yang dikirim: " + id);

            document.getElementById('popupBayarForm').style.display = 'flex'; // Tampilkan pop-up
        }

        // Open popup and set id_penyewaan
        document.getElementById('openBayarPopupButton').onclick = function() {
            setIdPenyewaan(123); // Replace 123 with the actual id
            document.getElementById('popupBayarForm').style.display = 'block';
        };

        // Close the popup when clicking the close button
        document.getElementById('btnCloseBayar').onclick = function() {
            document.getElementById('popupBayarForm').style.display = 'none';
        };

        // Close the popup if clicking outside the content
        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('popupBayarForm')) {
                document.getElementById('popupBayarForm').style.display = 'none';
            }
        });

        document.getElementById('bayarForm').onsubmit = function() {
            const idPenyewaan = document.getElementById('id_penyewaan').value;
            console.log("Form akan disubmit dengan id_penyewaan: " + idPenyewaan);
        };

        function startCountdown(id, waktuMulai, waktuSelesai, statusAwal) {
            // Mengatur timezone ke Asia/Jakarta
            const timezoneOffset = 7 * 60 * 60 * 1000; // Offset 7 jam dari UTC
            const waktuMulaiTimestamp = new Date(waktuMulai).getTime() + timezoneOffset;
            const waktuSelesaiTimestamp = new Date(waktuSelesai).getTime() + timezoneOffset;

            // Mendapatkan waktu sekarang
            const waktuSekarang = new Date().getTime();

            // Jika waktu selesai sudah tercapai
            if (waktuSelesaiTimestamp <= waktuSekarang) {
                if (statusAwal !== "Selesai") {
                    // Update status di UI
                    document.getElementById('countdown-' + id).innerText = "Waktu Habis";
                    document.getElementById('status-' + id).innerText = "Selesai";

                    // Kirim request untuk update status di server
                    updateStatusPenyewaan(id, 'Selesai');
                }
                return; // Hentikan countdown
            }

            // Menghitung sisa waktu
            const sisaWaktu = waktuSelesaiTimestamp - waktuSekarang;
            const hours = Math.floor((sisaWaktu / (1000 * 60 * 60)) % 24);
            const minutes = Math.floor((sisaWaktu / (1000 * 60)) % 60);
            const seconds = Math.floor((sisaWaktu / 1000) % 60);

            // Update countdown di UI
            document.getElementById('countdown-' + id).innerText = `${hours} Jam ${minutes} Menit ${seconds} Detik`;

            // Perbarui countdown setiap detik
            setTimeout(function() {
                startCountdown(id, waktuMulai, waktuSelesai, statusAwal);
            }, 1000);
        }

        // Fungsi untuk mengupdate status di server
        function updateStatusPenyewaan(id, status) {
            fetch(`/home/updateStatusPenyewaan/${id}`, {
                    method: 'POST',
                    body: JSON.stringify({
                        status: status
                    }),
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(`Status Penyewaan ID ${id} berhasil diperbarui menjadi ${status}`);
                        location.reload(); // Refresh otomatis setelah update
                    } else {
                        console.error('Error updating status');
                    }
                })
                .catch(error => console.error('Error updating status:', error));
        }

        function updateStatusToSelesai(id) {
            console.log("Updating status for ID: " + id); // Debugging log
            fetch(`/penyewaan/updateStatus/${id}`, {
                    method: 'POST',
                }).then(response => response.json())
                .then(data => {
                    console.log('Status updated to Selesai', data);
                }).catch(error => {
                    console.error("Error updating status: ", error);
                });
        }
    </script>
</body>

</html>