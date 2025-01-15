<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <style>
        /* dashboard.css */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding-left: 250px;
            /* Space for the sidebar */
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        main {
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
            margin-top: 20px;
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
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table-box table th {
            background-color: #f4f4f4;
            color: #333;
        }

        .table-box table td {
            background-color: #fff;
        }

        @media (max-width: 768px) {
            body {
                padding-left: 200px;
                /* Adjust for smaller sidebar */
            }

            .table-container {
                flex-direction: column;
            }

            .table-box {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Transaksi</h1>
    </header>
    <main>
        <div class="table-container">
            <div class="table-box">
                <h3>Data Transaksi</h3>
                <table>
                    <thead>
                        <tr>
                            <th>No Transaksi</th>
                            <th>ID Penyewaan</th>
                            <th>Total</th>
                            <th>Bayar</th>
                            <th>Kembalian</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transaksi)): ?>
                            <?php foreach ($transaksi as $transaksiItem): ?>
                                <tr>
                                    <td><?= $transaksiItem['no_transaksi']; ?></td>
                                    <td><?= $transaksiItem['id_penyewaan']; ?></td>
                                    <td><?= $transaksiItem['total']; ?></td>
                                    <td><?= $transaksiItem['bayar']; ?></td>
                                    <td><?= $transaksiItem['kembalian']; ?></td>
                                    <td><?= $transaksiItem['payment']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">No transaksi found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>