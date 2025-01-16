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

        .table-box .table-wrapper {
            overflow-x: auto;
            overflow-y: hidden;
            max-width: 100%;
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

        @media (max-width: 768px) {
            body {
                padding-left: 200px;
            }

            .table-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <header>
            <h1>Dashboard</h1>
            <h2 class="welcome-message">Welcome, <span class="username"><?= session()->get('username') ?></span> (<span class="level"><?= session()->get('level') ?></span>)</h2>
        </header>
        <main>
            <section>
                <div class="table-container">
                    <!-- Playing Table (left) -->
                    <div class="table-box">
                        <h3>Playing (Pending & Berjalan)</h3>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Wahana</th>
                                        <th>Tanggal</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Durasi</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Nama Orang Tua</th>
                                        <th>No. HP</th>
                                        <th>Nama Anak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pendingAndBerjalan as $row): ?>
                                        <tr>
                                            <td><?= esc($row['id_penyewaan']) ?></td>
                                            <td><?= esc($row['id_wahana']) ?></td>
                                            <td><?= esc($row['tanggal']) ?></td>
                                            <td><?= esc($row['waktu_mulai']) ?></td>
                                            <td><?= esc($row['waktu_selesai']) ?></td>
                                            <td><?= esc($row['durasi']) ?></td>
                                            <td><?= esc($row['total']) ?></td>
                                            <td><?= esc($row['status']) ?></td>
                                            <td><?= esc($row['nama_ortu']) ?></td>
                                            <td><?= esc($row['nohp']) ?></td>
                                            <td><?= esc($row['nama_anak']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Done Table (right) -->
                    <div class="table-box">
                        <h3>Done (Selesai)</h3>
                        <div class="table-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Wahana</th>
                                        <th>Tanggal</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Durasi</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Nama Orang Tua</th>
                                        <th>No. HP</th>
                                        <th>Nama Anak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($selesai as $row): ?>
                                        <tr>
                                            <td><?= esc($row['id_penyewaan']) ?></td>
                                            <td><?= esc($row['id_wahana']) ?></td>
                                            <td><?= esc($row['tanggal']) ?></td>
                                            <td><?= esc($row['waktu_mulai']) ?></td>
                                            <td><?= esc($row['waktu_selesai']) ?></td>
                                            <td><?= esc($row['durasi']) ?></td>
                                            <td><?= esc($row['total']) ?></td>
                                            <td><?= esc($row['status']) ?></td>
                                            <td><?= esc($row['nama_ortu']) ?></td>
                                            <td><?= esc($row['nohp']) ?></td>
                                            <td><?= esc($row['nama_anak']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </section>
        </main>
    </div>
</body>

<script>
    // Enable horizontal scrolling with mouse wheel
    document.querySelectorAll('.table-wrapper').forEach(wrapper => {
        wrapper.addEventListener('wheel', (e) => {
            if (e.deltaY !== 0) {
                e.preventDefault();
                wrapper.scrollLeft += e.deltaY;
            }
        });
    });
</script>

</html>