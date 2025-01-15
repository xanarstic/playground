<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple View</title>

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

        .content-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 0 auto;
            max-width: 600px;
        }

        .content-box h3 {
            margin: 0;
            margin-bottom: 10px;
            color: #333;
        }

        .content-box p {
            margin: 0;
            color: #555;
        }

        @media (max-width: 768px) {
            body {
                padding-left: 200px;
                /* Adjust for smaller sidebar */
            }

            .content-box {
                max-width: 90%;
            }
        }
    </style>
</head>

<body>
    <header>
        <h1>Transaksi</h1>
    </header>
    <main>
        <div class="content-box">
            <h3>Welcome</h3>
            <p>This is a simple view using the dashboard's styles. You can add your content here.</p>
        </div>
    </main>
</body>

</html>