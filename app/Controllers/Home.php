<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function adminPanel()
	{
		return view('master/home-master');
	}
}
