<?php

namespace App\Controllers;

use App\Models\User;
use Config\Validation;

class FormController extends BaseController
{
    private $db;
    public function  __construct()
    {
        $this->db = db_connect();
    }
    public function index()
    {
        return view('form');
    }

    public function validateForm()
    {
        $isValid = $this->validate([
            "username"  =>  "required|min_length[3]",
            "email"     =>  "required|valid_email",
            "password"  =>  "required|min_length[8]",
            "confirm_password" => "required|matches[password]",
        ]);

        if(!$isValid)
        {
            return view("form", ["validator" => $this->validator]);
        }

        $data = array(
            "name"      =>  $this->request->getPost("username"),
            "email"     =>  $this->request->getPost("email"),
            "password"  =>  $this->request->getPost("password"),
        );

        if(!$this->saveUser($data))
        {
            return view("form", ["error" => "Something went wrong"]);
        }
        $message = "Form has been submitted successfully";
        return view("success", compact("message"));

    }

    protected function saveUser($data = [])
    {
        if(!is_array($data) || empty($data))
        {
            return false;
        }

        $this->db->transBegin();
        try
        {
            $user = new User();
            $data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);
            $user->save($data);
            $this->db->transCommit();
            return true;
        }
        catch (\Exception $e)
        {
            $this->db->transRollback();
            return false;
        }
    }
}
