<?php

namespace App\Controllers;

use Config\Validation;

class FormController extends BaseController
{
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

        $message = "Form has been submitted successfully";
        return view("success", compact("message"));
    }
}
