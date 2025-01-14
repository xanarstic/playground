<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        /* Style yang sama seperti pada contoh sebelumnya */
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

        /* Button Styles */
        .edit-btn,
        .delete-btn,
        .add-btn {
            padding: 6px 12px;
            border: none;
            background-color: #333;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
            margin: 0 5px;
        }

        .edit-btn:hover,
        .delete-btn:hover,
        .add-btn:hover {
            background-color: #575757;
        }

        /* Style for Popup Modal */
        .popup-modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .popup-content {
            position: relative;
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 8px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .popup-content h3 {
            background-color: #333;
            color: #fff;
            margin: 0;
            padding: 10px;
            text-align: center;
        }

        .popup-content input,
        .popup-content select,
        .popup-content button {
            width: 50%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .popup-content button {
            background-color: #333;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
            border: none;
        }

        .popup-content button:hover {
            background-color: #575757;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 30px;
            color: #aaa;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }

        .popup-content div {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .popup-content label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .popup-content input,
        .popup-content select,
        .popup-content button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        /* Add this for the select element to ensure consistent width */
        .popup-content select {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <header>
            <h1>Users</h1>
        </header>
        <main>
            <section>
                <div class="table-container">
                    <div class="table-box">
                        <h3>User Data</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users)) : ?>
                                    <?php foreach ($users as $user) : ?>
                                        <tr>
                                            <td><?= esc($user['id_user']) ?></td>
                                            <td><?= esc($user['username']) ?></td>
                                            <td><?= esc($user['level']) ?></td>
                                            <td>
                                                <!-- Edit Button -->
                                                <button class="edit-btn" onclick="openEditPopup(<?= esc($user['id_user']) ?>, '<?= esc($user['username']) ?>', '<?= esc($user['level']) ?>')">Edit</button>

                                                <!-- Delete Button -->
                                                <form method="POST" action="<?= base_url('home/delete_user/' . esc($user['id_user'])) ?>" style="display:inline;">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center;">No data available</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Button to open the popup form (for adding a user) -->
                <button class="add-btn" onclick="openPopup()">Add New User</button>
            </section>
        </main>
    </div>

    <!-- Popup Modal for Adding a User -->
    <div id="addUserPopup" class="popup-modal">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <form id="addUserForm" method="POST" action="<?= base_url('home/add_user') ?>">
                <?= csrf_field() ?>
                <div>
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div>
                    <label for="level">Level</label>
                    <select id="level" name="level" required>
                        <option value="admin">Admin</option>
                        <option value="Petugas">Petugas</option>
                    </select>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Add User</button>
            </form>
        </div>
    </div>

    <!-- Popup Modal for Editing a User -->
    <div id="editUserPopup" class="popup-modal">
        <div class="popup-content">
            <span class="close" onclick="closeEditPopup()">&times;</span>
            <form id="editUserForm" method="POST" action="<?= base_url('home/edit_user') ?>">
                <?= csrf_field() ?>
                <input type="hidden" id="edit_user_id" name="user_id" value="">
                <div>
                    <label for="edit_username">Username</label>
                    <input type="text" id="edit_username" name="username" required>
                </div>
                <div>
                    <label for="edit_level">Level</label>
                    <select id="edit_level" name="level" required>
                        <option value="admin">Admin</option>
                        <option value="Petugas">Petugas</option>
                    </select>
                </div>
                <div>
                    <label for="edit_password">Password (Optional)</label>
                    <input type="password" id="edit_password" name="password">
                </div>
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        // Function to open the popup for adding a user
        function openPopup() {
            document.getElementById('addUserPopup').style.display = 'block';
        }

        // Function to close the add user popup
        function closePopup() {
            document.getElementById('addUserPopup').style.display = 'none';
        }

        // Function to open the popup for editing a user
        function openEditPopup(id, username, level) {
            document.getElementById('editUserPopup').style.display = 'block';
            document.getElementById('edit_user_id').value = id;
            document.getElementById('edit_username').value = username;
            document.getElementById('edit_level').value = level;
        }

        // Function to close the edit user popup
        function closeEditPopup() {
            document.getElementById('editUserPopup').style.display = 'none';
        }
    </script>
</body>

</html>