<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends BaseController
{
    // Load Homepage
    public function index()
    {
        return view('user/homepage');
    }

    // Load the signup form
    public function signup()
    {
        return view('user/signup');
    }

    public function processSignup()
    {
        $model = new UserModel();
        
        // Validate the form, including confirm_password validation
        $validationRules = [
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'confirm_password' => 'required|matches[password]' // Add this line to match passwords
        ];

        // Apply custom validation rules for confirm_password
        if (!$this->validate($validationRules)) {
            // Set the error messages to the session
            return redirect()->to('/signup')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Collect the data from the form
        $data = [
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // Save the user data to the database
        if ($model->save($data)) {
            // Flash a success message to the session
            session()->setFlashdata('success', 'Account created successfully! Please log in.');
            return redirect()->to('/login');
        } else {
            // Flash an error message if there's an issue
            session()->setFlashdata('error', 'There was an issue saving your account.');
            return redirect()->to('/signup');
        }
    }


    // Load the login form
    public function login()
    {
        return view('user/login');
    }

    // Process the login
    public function processLogin()
    {
        $model = new UserModel();
        
        // Get the user from the database based on the email
        $user = $model->where('email', $this->request->getPost('email'))->first();

        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            // Set session data (for example, store the user's ID and email)
            session()->set([
                'user_id' => $user['id'],
                'email' => $user['email'],
                'logged_in' => true
            ]);

            return redirect()->to('/home');
        } else {
            // Flash an error message if login fails
            session()->setFlashdata('error', 'Invalid email or password');
            return redirect()->to('/login');
        }
    }

    // Home page (for logged-in users)
    public function home()
    {
        // Check if user is logged in
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('user/home');
    }
}
