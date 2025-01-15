<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\SettingModel;
use App\Models\Wahanamodel;
use App\Models\Penyewaanmodel;
use App\Models\TransaksiModel;
use CodeIgniter\Controller;
use CodeIgniter\Session\Session;

class Home extends BaseController
{
	protected $penyewaanModel;
	protected $wahanaModel;
	protected $transaksiModel;

	public function __construct()
	{
		$this->penyewaanModel = new PenyewaanModel();
		$this->wahanaModel = new WahanaModel();
		$this->transaksiModel = new TransaksiModel();
		helper('string');
	}
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
		$transaksiModel = new TransaksiModel();

		// Fetch setting data
		$settingData = $settingModel->first(); // Assuming only one settings row

		// Fetch transaksi data
		$transaksiData = $transaksiModel->findAll(); // Atau gunakan metode lain untuk filter, misalnya getTransaksiByPenyewaan($id_penyewaan)

		$session = session();

		// Check if the user is logged in
		if (!$session->get('logged_in')) {
			return redirect()->to('/home/login');
		}

		// Send data to view
		echo view('transaksi', ['transaksi' => $transaksiData, 'setting' => $settingData]);
		echo view('menu', ['setting' => $settingData]);
	}
	
	public function penyewaan()
	{
		$settingModel = new \App\Models\SettingModel();

		$session = session();

		// Check if the user is logged in
		if (!$session->get('logged_in')) {
			return redirect()->to('/home/login');
		}

		$data = [
			'penyewaan' => $this->penyewaanModel->getAllPenyewaan(), // Ambil data penyewaan dengan join ke tabel wahana
			'wahana' => $this->wahanaModel->findAll(),
			'setting' => $settingModel->first(),
		];

		// Load views
		echo view('menu', ['setting' => $data['setting']]);
		return view('penyewaan', $data);
	}

	public function tambahSewa()
	{
		$validation = \Config\Services::validation();

		// Validasi input
		if (
			!$this->validate([
				'id_wahana' => 'required',
				'tanggal' => 'required',
				'waktu_mulai' => 'required',
				'durasi' => 'required|integer',
				'total' => 'required',
				'nama_ortu' => 'required',
				'nohp' => 'required',
				'nama_anak' => 'required'
			])
		) {
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}

		// Mengambil inputan
		$id_wahana = $this->request->getPost('id_wahana');
		$tanggal = $this->request->getPost('tanggal');
		$waktu_mulai = $this->request->getPost('waktu_mulai');
		$durasi = $this->request->getPost('durasi');
		$total = $this->request->getPost('total');
		$nama_ortu = $this->request->getPost('nama_ortu');
		$nohp = $this->request->getPost('nohp');
		$nama_anak = $this->request->getPost('nama_anak');

		// Hitung waktu selesai
		$waktuMulaiDate = new \DateTime($tanggal . ' ' . $waktu_mulai);
		$waktuMulaiDate->add(new \DateInterval('PT' . $durasi . 'H')); // Tambah durasi dalam jam

		// Format waktu selesai
		$waktu_selesai = $waktuMulaiDate->format('H:i');

		// Debug log: Periksa nilai waktu selesai
		log_message('debug', 'Waktu selesai: ' . $waktu_selesai);

		// Simpan data penyewaan
		$this->penyewaanModel->save([
			'id_wahana' => $id_wahana,
			'tanggal' => $tanggal,
			'waktu_mulai' => $waktu_mulai,
			'durasi' => $durasi,
			'total' => $total,
			'status' => 'Pending',
			'nama_ortu' => $nama_ortu,
			'nohp' => $nohp,
			'nama_anak' => $nama_anak,
			'waktu_selesai' => $waktu_selesai,
		]);

		return redirect()->to('/home/penyewaan');
	}

	public function updateSewa()
	{
		$validation = \Config\Services::validation();

		// Validasi input
		if (
			!$this->validate([
				'id_wahana' => 'required',
				'tanggal' => 'required',
				'waktu_mulai' => 'required',
				'durasi' => 'required|integer',
				'total' => 'required',
				'nama_ortu' => 'required',
				'nohp' => 'required',
				'nama_anak' => 'required'
			])
		) {
			return redirect()->back()->withInput()->with('errors', $validation->getErrors());
		}

		// Ambil data input dan update data
		$data = [
			'id_wahana' => $this->request->getPost('id_wahana'),
			'tanggal' => $this->request->getPost('tanggal'),
			'waktu_mulai' => $this->request->getPost('waktu_mulai'),
			'durasi' => $this->request->getPost('durasi'),
			'total' => $this->request->getPost('total'),
			'nama_ortu' => $this->request->getPost('nama_ortu'),
			'nohp' => $this->request->getPost('nohp'),
			'nama_anak' => $this->request->getPost('nama_anak'),
			'waktu_selesai' => $this->request->getPost('waktu_selesai')
		];

		// Update data
		$this->penyewaanModel->update($this->request->getPost('id_penyewaan'), $data);

		return redirect()->to('/home/penyewaan')->with('message', 'Data penyewaan berhasil diupdate.');
	}

	public function deleteSewa($id)
	{
		// Pastikan penyewaan dengan ID yang diberikan ada
		$penyewaan = $this->penyewaanModel->find($id);

		if (!$penyewaan) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Data penyewaan tidak ditemukan.');
		}

		// Hapus data penyewaan dari database
		$this->penyewaanModel->delete($id);

		// Redirect ke halaman penyewaan dengan pesan sukses
		return redirect()->to('/home/penyewaan')->with('message', 'Penyewaan berhasil dihapus.');
	}

	public function prosesBayar()
	{
		// Log incoming POST data
		log_message('debug', 'POST data: ' . print_r($this->request->getPost(), true));

		// Ambil nilai input
		$idPenyewaan = $this->request->getPost('id_penyewaan');
		$totalBayar = $this->request->getPost('total');
		$bayar = $this->request->getPost('bayar');
		$kembalian = $this->request->getPost('kembalian');
		$paymentMethod = $this->request->getPost('payment');

		// Debugging: Periksa apakah id_penyewaan diterima dengan benar
		log_message('debug', 'id_penyewaan: ' . $idPenyewaan);
		// Validation: Ensure bayar is not less than total
		if ($bayar < $totalBayar) {
			session()->setFlashdata('error', 'Pembayaran tidak cukup!');
			return redirect()->back();
		}

		// Generate transaction number automatically
		$nomorTransaksi = 'TRX' . strtoupper(bin2hex(random_bytes(4))); // Generates an 8-character alphanumeric string

		// Prepare transaction data
		$dataTransaksi = [
			'no_transaksi' => $nomorTransaksi,
			'id_penyewaan' => $idPenyewaan,
			'total' => $totalBayar,
			'bayar' => $bayar,
			'kembalian' => $kembalian,
			'payment' => $paymentMethod,
		];

		// Insert data into Transaksi table
		if (!$this->transaksiModel->insert($dataTransaksi)) {
			session()->setFlashdata('error', 'Terjadi kesalahan saat menyimpan transaksi!');
			log_message('error', 'Failed to insert transaksi: ' . print_r($dataTransaksi, true)); // Log failure
			return redirect()->back();
		}

		// Update Penyewaan status to "Berjalan"
		$updateData = [
			'status' => 'Berjalan',
		];

		if (!$this->penyewaanModel->update($idPenyewaan, $updateData)) {
			session()->setFlashdata('error', 'Terjadi kesalahan saat memperbarui status penyewaan!');
			log_message('error', 'Failed to update penyewaan status: ' . $idPenyewaan); // Log failure
			return redirect()->back();
		}

		// Show success message
		session()->setFlashdata('message', 'Pembayaran berhasil!');

		// Redirect to home or another page
		return redirect()->to('/home/penyewaan');
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
		$session = session();
		$wahanaModel = new \App\Models\WahanaModel();

		// Validate the form input
		$validation = \Config\Services::validation();
		$validation->setRules([
			'nama_wahana' => 'required|min_length[3]',
			'harga' => 'required|numeric',
			'kapasitas' => 'required|numeric',
			'status' => 'required|in_list[Tersedia,Tidak Tersedia]',
		]);

		if (!$this->validate($validation->getRules())) {
			// If validation fails, set the errors and redirect back to the wahana view
			return redirect()->to('/home/wahana')->withInput()->with('errors', $this->validator->getErrors());
		}

		// Prepare data for insertion
		$data = [
			'nama_wahana' => $this->request->getPost('nama_wahana'),
			'harga' => $this->request->getPost('harga'),
			'kapasitas' => $this->request->getPost('kapasitas'),
			'status' => $this->request->getPost('status'),
		];

		// Insert the new wahana into the database
		if ($wahanaModel->insert($data)) {
			// Set a success message and redirect
			$session->setFlashdata('success', 'Wahana added successfully.');
		} else {
			// Set an error message if insertion fails
			$session->setFlashdata('errors', 'Failed to add wahana.');
		}

		return redirect()->to('/home/wahana');
	}

	public function getWahana($id)
	{
		$wahanaModel = new \App\Models\WahanaModel();
		$wahana = $wahanaModel->find($id);
		return $this->response->setJSON($wahana);
	}

	public function updateWahana()
	{
		$session = session();
		$wahanaModel = new \App\Models\WahanaModel();

		// Validate the form input
		$validation = \Config\Services::validation();
		$validation->setRules([
			'nama_wahana' => 'required|min_length[3]',
			'harga' => 'required|numeric',
			'kapasitas' => 'required|numeric',
			'status' => 'required|in_list[Tersedia,Tidak Tersedia]',
		]);

		if (!$this->validate($validation->getRules())) {
			return redirect()->to('/home/wahana')->withInput()->with('errors', $this->validator->getErrors());
		}

		// Prepare data for update
		$data = [
			'id_wahana' => $this->request->getPost('wahana_id'),
			'nama_wahana' => $this->request->getPost('nama_wahana'),
			'harga' => $this->request->getPost('harga'),
			'kapasitas' => $this->request->getPost('kapasitas'),
			'status' => $this->request->getPost('status'),
		];

		// Update the wahana in the database
		if ($wahanaModel->save($data)) {
			$session->setFlashdata('success', 'Wahana updated successfully.');
		} else {
			$session->setFlashdata('errors', 'Failed to update wahana.');
		}

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
