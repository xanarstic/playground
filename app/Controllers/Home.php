<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SettingModel;
use CodeIgniter\Controller;
use CodeIgniter\Session\Session;

class Home extends BaseController
{
	public function dashboard()
	{
		$settingModel = new SettingModel();

		// Fetch setting data
		$settingData = $settingModel->first(); // Fetch the first row, assuming only one settings row


		$session = session();

		// Check if the user is logged in
		if (!$session->get('logged_in')) {
			return redirect()->to('/home/login');
		}

		echo view('dashboard');
		echo view('menu', ['setting' => $settingData]);
	}

	public function login()
	{
		$settingModel = new SettingModel();

		// Fetch setting data
		$settingData = $settingModel->first(); // Fetch the first row, assuming only one settings row

		// Pass data to the 'login' view
		echo view('login', ['setting' => $settingData]);
	}

	public function aksi_login()
	{
		$session = session();
		$userModel = new UserModel();

		// Get the username and password from the form
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		// Find the user by username
		$user = $userModel->where('username', $username)->first();

		// Check if the user exists and the password matches (MD5)
		if ($user && md5($password) === $user['password']) {
			// Setelah sesi diset
			$session->set([
				'id_user' => $user['id_user'],
				'username' => $user['username'],
				'level' => $user['level'],
				'logged_in' => true
			]);

			// Debugging untuk memastikan level diset dengan benar
			var_dump(session()->get('level')); // Ini harus menampilkan 'admin' jika pengguna adalah admin


			// Redirect to the dashboard or home page
			return redirect()->to('home/dashboard');
		} else {
			// Set an error message if login fails
			$session->setFlashdata('error', 'Invalid username or password.');
			return redirect()->to('/home/login');
		}
	}



	public function logout()
	{
		$session = session();
		$session->destroy(); // Destroy the session

		return redirect()->to('/home/login'); // Redirect back to login page
	}

	public function user()
	{
		$settingModel = new SettingModel();

		// Fetch setting data
		$settingData = $settingModel->first(); // Fetch the first row, assuming only one settings row

		$session = session();

		// Check if the user is logged in
		if (!$session->get('logged_in')) {
			return redirect()->to('/home/login');
		}

		$userModel = new UserModel();

		// Ambil semua data pengguna
		$data['users'] = $userModel->findAll();

		// Kirim data ke view
		echo view('user', $data);
		echo view('menu', ['setting' => $settingData]);
	}

	public function add_user()
	{
		$userModel = new UserModel();

		// Get the form data
		$username = $this->request->getPost('username');
		$level = $this->request->getPost('level');
		$password = md5($this->request->getPost('password')); // MD5 hash of the password

		// Insert the new user into the database
		$userModel->save([
			'username' => $username,
			'password' => $password,
			'level' => $level,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);

		// Redirect back to the user page
		return redirect()->to('/home/user');
	}
	public function edit_user()
	{
		$userModel = new UserModel();

		// Get form data
		$userId = $this->request->getPost('user_id');
		$username = $this->request->getPost('username');
		$level = $this->request->getPost('level');
		$password = $this->request->getPost('password');

		// Prepare the data to update
		$data = [
			'username' => $username,
			'level' => $level,
			'updated_at' => date('Y-m-d H:i:s')
		];

		// If password is provided, add it to the data
		if (!empty($password)) {
			$data['password'] = md5($password); // MD5 hash for password
		}

		// Update the user in the database
		$userModel->update($userId, $data);

		// Redirect back to the user page
		return redirect()->to('/home/user');
	}

	// Method to handle user deletion
	public function delete_user($id)
	{
		$userModel = new UserModel();

		// Attempt to delete the user by their ID
		$userModel->delete($id);

		// Redirect back to the user page with a success message
		return redirect()->to('/home/user')->with('message', 'User deleted successfully!');
	}

	public function transaksi()
	{
		$settingModel = new SettingModel();

		// Fetch setting data
		$settingData = $settingModel->first(); // Fetch the first row, assuming only one settings row


		$session = session();

		// Check if the user is logged in
		if (!$session->get('logged_in')) {
			return redirect()->to('/home/login');
		}

		echo view('transaksi');
		echo view('menu', ['setting' => $settingData]);
	}

	public function wahana()
	{
		$settingModel = new SettingModel();

		// Fetch setting data
		$settingData = $settingModel->first(); // Fetch the first row, assuming only one settings row


		$session = session();

		// Check if the user is logged in
		if (!$session->get('logged_in')) {
			return redirect()->to('/home/login');
		}

		echo view('wahana');
		echo view('menu', ['setting' => $settingData]);
	}

	public function setting()
	{
		$session = session();
		$settingModel = new SettingModel();

		// Fetch setting data
		$settingData = $settingModel->first(); // Fetch the first row, assuming only one settings row

		// Check if the user is logged in
		if (!$session->get('logged_in')) {
			return redirect()->to('/home/login');
		}

		// Send data to the 'setting' view
		echo view('setting', ['setting' => $settingData]);
		echo view('menu', ['setting' => $settingData]);
	}

	public function updateSettings()
	{
		$session = session();
		$settingModel = new SettingModel();

		// Check if the user is logged in
		if (!$session->get('logged_in')) {
			return redirect()->to('/home/login');
		}

		// Handle form submission
		if ($this->request->getMethod() == 'post') {
			$validation = \Config\Services::validation();

			// Validate form data
			$validation->setRules([
				'website-name' => 'required|min_length[3]',
				'app-title' => 'required|min_length[3]',
				'website-icon' => 'is_image[website-icon]',
				'sidebar-bg' => 'is_image[sidebar-bg]',
				'header-photo' => 'is_image[header-photo]',
			]);

			if ($validation->withRequest($this->request)->run()) {
				// Prepare data to be updated
				$data = [
					'namawebsite' => $this->request->getPost('website-name'),
					'icontab' => $this->request->getPost('app-title'),
				];

				// Handle file uploads
				$files = $this->request->getFiles();

				// Upload website icon if available
				if ($files['website-icon'] && $files['website-icon']->isValid()) {
					$data['iconlogin'] = $files['website-icon']->store('img/'); // Save to img folder
				}

				// Upload sidebar background if available
				if ($files['sidebar-bg'] && $files['sidebar-bg']->isValid()) {
					$data['iconmenu'] = $files['sidebar-bg']->store('img/'); // Save to img folder
				}

				// Upload header photo if available
				if ($files['header-photo'] && $files['header-photo']->isValid()) {
					$data['iconlogin'] = $files['header-photo']->store('img/'); // Save to img folder
				}

				// Update settings in the database (Assuming id_setting = 1 for settings)
				$settingModel->update(1, $data);

				// Redirect back to settings page with a success message
				return redirect()->to('/settings')->with('success', 'Settings updated successfully!');
			} else {
				// If validation fails, return back with errors
				return redirect()->back()->withInput()->with('errors', $validation->getErrors());
			}
		}
	}
}
