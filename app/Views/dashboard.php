<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

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

        @media (max-width: 768px) {
            body {
                padding-left: 200px;
                /* Adjust for smaller sidebar */
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
            <h1>Welcome to the Dashboard</h1>
        </header>
        <main>
            <!-- Tables Section -->
            <section>
                <div class="table-container">
                    <!-- Playing Table (left) -->
                    <div class="table-box">
                        <h3>Playing</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Placeholder for data -->
                                <tr>
                                    <td><!-- Name will go here --></td>
                                    <td><!-- Time will go here --></td>
                                </tr>
                                <!-- Add more rows as necessary -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Done Table (right) -->
                    <div class="table-box">
                        <h3>Done</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Placeholder for data -->
                                <tr>
                                    <td><!-- Name will go here --></td>
                                    <td><!-- Status will go here --></td>
                                </tr>
                                <!-- Add more rows as necessary -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>