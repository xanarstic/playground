<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SettingModel;
use App\Models\Wahanamodel;
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

		$wahanaModel = new \App\Models\WahanaModel();
		$wahanas = $wahanaModel->findAll();

		// Check if the user is logged in
		if (!$session->get('logged_in')) {
			return redirect()->to('/home/login');
		}

		echo view('wahana', ['wahanas' => $wahanas]);
		echo view('menu', ['setting' => $settingData]);
	}
	public function addWahana()
	{
		// Validasi data input
		$validation = \Config\Services::validation();

		// Ambil data dari form
		$data = [
			'nama_wahana' => $this->request->getPost('nama_wahana'),
			'harga' => $this->request->getPost('harga'),
			'kapasitas' => $this->request->getPost('kapasitas'),
			'status' => $this->request->getPost('status')
		];

		// Validasi input menggunakan grup 'wahana'
		if (!$validation->run($data, 'wahana')) {
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}

		// Simpan data ke database
		$wahanaModel = new WahanaModel();
		$wahanaModel->addWahana($data);

		// Set flash message dan redirect
		session()->setFlashdata('success', 'Wahana berhasil ditambahkan!');
		return redirect()->to('/home/wahana');
	}


	public function setting()
	{
		$session = session();
		$settingModel = new \App\Models\SettingModel();

		// Periksa apakah pengguna sudah login
		if (!$session->get('logged_in')) {
			return redirect()->to('/home/login');
		}

		// Ambil data pengaturan dari database
		$settingData = $settingModel->first(); // Ambil baris pertama dari tabel setting

		// Kirim data ke view
		echo view('header', ['setting' => $settingData]);
		echo view('setting', ['setting' => $settingData]);
		echo view('menu', ['setting' => $settingData]);
	}

	public function updateSettings()
	{
		$settingModel = new \App\Models\SettingModel();

		// Ambil data dari form
		$data = [
			'namawebsite' => $this->request->getPost('website-name'),
		];

		// Proses upload file
		$iconTab = $this->request->getFile('website-icon');
		if ($iconTab->isValid() && !$iconTab->hasMoved()) {
			// Cek apakah ada gambar lama dan hapus
			$oldIconTab = $settingModel->first()['icontab']; // Mengambil nama file lama
			if ($oldIconTab && file_exists(FCPATH . 'img/' . $oldIconTab)) {
				unlink(FCPATH . 'img/' . $oldIconTab); // Menghapus file lama
			}

			// Gunakan nama file yang sama jika file sudah ada
			$iconTabName = $iconTab->getName(); // Menggunakan nama file yang sama

			// Pindahkan file ke folder img
			$iconTab->move(FCPATH . 'img', $iconTabName);
			$data['icontab'] = $iconTabName;
		}

		$iconLogin = $this->request->getFile('sidebar-bg');
		if ($iconLogin->isValid() && !$iconLogin->hasMoved()) {
			// Cek apakah ada gambar lama dan hapus
			$oldIconLogin = $settingModel->first()['iconlogin'];
			if ($oldIconLogin && file_exists(FCPATH . 'img/' . $oldIconLogin)) {
				unlink(FCPATH . 'img/' . $oldIconLogin); // Menghapus file lama
			}

			// Gunakan nama file yang sama jika file sudah ada
			$iconLoginName = $iconLogin->getName(); // Menggunakan nama file yang sama

			// Pindahkan file ke folder img
			$iconLogin->move(FCPATH . 'img', $iconLoginName);
			$data['iconlogin'] = $iconLoginName;
		}

		$iconMenu = $this->request->getFile('background-menu');
		if ($iconMenu->isValid() && !$iconMenu->hasMoved()) {
			// Cek apakah ada gambar lama dan hapus
			$oldIconMenu = $settingModel->first()['iconmenu'];
			if ($oldIconMenu && file_exists(FCPATH . 'img/' . $oldIconMenu)) {
				unlink(FCPATH . 'img/' . $oldIconMenu); // Menghapus file lama
			}

			// Gunakan nama file yang sama jika file sudah ada
			$iconMenuName = $iconMenu->getName(); // Menggunakan nama file yang sama

			// Pindahkan file ke folder img
			$iconMenu->move(FCPATH . 'img', $iconMenuName);
			$data['iconmenu'] = $iconMenuName;
		}

		// Debugging: Periksa data yang akan diupdate
		var_dump($data);

		// ID yang digunakan untuk update
		$idSetting = 1; // Pastikan hanya ada satu baris data
		$result = $settingModel->updateSettings($data, $idSetting);

		// Debugging: Cek apakah update berhasil
		if (!$result) {
			echo "Update failed!";
		} else {
			echo "Update successful!";
		}

		// Verifikasi apakah data di database terubah
		$updatedSetting = $settingModel->find($idSetting);
		var_dump($updatedSetting); // Debug: Menampilkan data yang telah diupdate

		// Redirect dengan pesan sukses
		return redirect()->to('/home/setting')->with('success', 'Settings updated successfully.');
	}



	// Upload header photo if available
	// if ($files['header-photo'] && $files['header-photo']->isValid()) {
	// 	$data['iconlogin'] = $files['header-photo']->store('img/'); // Save to img folder
	// }

	public function test()
	{
		$settingModel = new SettingModel();

		// Fetch setting data
		$settingData = $settingModel->first(); // Fetch the first row, assuming only one settings row

		echo view('test', ['setting' => $settingData]);
	}
}
