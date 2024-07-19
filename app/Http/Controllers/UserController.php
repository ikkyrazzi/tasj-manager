<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all users from the database
        $users = User::all();
        
        // Pass users data to the view
        return view('users.index', compact('users'));
    }
}
