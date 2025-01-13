<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function dashboard()
	{
		echo view('dashboard');
		echo view('menu');
	}

	public function login()
	{
		echo view('login');
	}
	public function user()
	{
		echo view('user');
		echo view('menu');
	}
	public function transaksi()
	{
		echo view('transaksi');
		echo view('menu');
	}
	public function wahana()
	{
		echo view('wahana');
		echo view('menu');
	}
	public function setting()
	{
		echo view('setting');
		echo view('menu');
	}
}
