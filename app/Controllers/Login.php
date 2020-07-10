<?php namespace App\Controllers;
use App\Models\M_user;

class Login extends BaseController  
{
	public function index()
	{
		return view('user_form');  
	}

    public function login_action()
    {
        $masuk = new M_user();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $cek = $masuk->get_data($username, $password);

        if (($cek['id_username'] == $username) && ($cek['id_password'] == $password))
        {
            session()->set('id_username', $cek['id_username']);
            session()->set('user_nama', $cek['user_nama']);
            session()->set('user_id', $cek['user_id']);
            return redirect()->to(base_url('user'));
        } else {
            session()->setFlashdata('gagal', 'Username / Password salah');
            return redirect()->to(base_url('login'));
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

	//--------------------------------------------------------------------

}
