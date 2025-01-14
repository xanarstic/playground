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
    </style>
</head>

<body>
    <div class="dashboard">
        <header>
            <h1>Settings</h1>
        </header>
        <main>
            <form action="/home/updateSettings" method="POST" enctype="multipart/form-data">
                <div class="form-container">
                    <!-- Input for uploading website icon -->
                    <label for="website-icon">Website Icon</label>
                    <input type="file" id="website-icon" name="website-icon" accept="image/*">

                    <!-- Input for uploading sidebar background -->
                    <label for="sidebar-bg">Sidebar Background</label>
                    <input type="file" id="sidebar-bg" name="sidebar-bg" accept="image/*">

                    <!-- Input for setting app title -->
                    <label for="app-title">App Title</label>
                    <input type="file" id="app-title" name="app-title" value="<?= esc($setting['icontab']) ?>" placeholder="Enter app title">

                    <!-- Input for setting website name -->
                    <label for="website-name">Website Name</label>
                    <input type="text" id="website-name" name="website-name" value="<?= esc($setting['namawebsite']) ?>" placeholder="Enter website name">

                    <!-- Submit button -->
                    <button type="submit">Save Settings</button>
                </div>
            </form>


            <!-- Input for uploading header photo -->
            <!-- <label for="header-photo">Header Photo</label>
                    <input type="file" id="header-photo" name="header-photo" accept="image/*"> -->
            <!-- Input for setting app title -->


            tes
        </main>
    </div>
</body>

</html>