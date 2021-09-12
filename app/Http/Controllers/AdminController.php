<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Author;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
      $this->middleware(['role:admin']);
    }

    public function AdminDashboard()
    {
        return view('admin');
    }
}
