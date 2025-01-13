<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Sidebar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    /* sidebar.css */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
    }

    .sidebar {
        width: 250px;
        height: 100vh;
        background-color: #fff;
        color: #fff;
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 20px;
    }

    .sidebar-header .website-icon {
        width: 100px;
        border-radius: 50%;
        margin-bottom: 20px;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        width: 100%;
    }

    .sidebar ul li {
        width: 100%;
    }

    .sidebar ul li a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: black;
        padding: 15px;
        transition: background 0.3s;
    }

    .sidebar ul li a:hover {
        background-color: #575757;
    }

    .sidebar ul li a i {
        margin-right: 10px;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 200px;
        }

        .sidebar ul li a {
            font-size: 14px;
        }
    }
</style>

<body>
    <div class="sidebar">
        <!-- Website Icon -->
        <div class="sidebar-header">
            <img src="<?= base_url('img/ph.png') ?>" alt="Website Icon" class="website-icon">
        </div>

        <!-- Navigation Links -->
        <ul>
            <li>
                <a href="<?= base_url('/home/dashboard') ?>">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('/home/user') ?>">
                    <i class="fas fa-users"></i>
                    <span>User</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('/home/transaksi') ?>">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>Transaksi</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('/home/wahana') ?>">
                    <i class="fas fa-cogs"></i>
                    <span>Wahana</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('/home/setting') ?>">
                    <i class="fas fa-cogs"></i>
                    <span>Setting</span>
                </a>
            </li>
        </ul>

    </div>
</body>


</html>