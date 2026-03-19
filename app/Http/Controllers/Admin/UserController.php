<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Tüm müşterileri, verdikleri sipariş sayısıyla birlikte getir
        $users = User::withCount('orders')->latest()->get();
        return view('admin.users.index', compact('users'));
    }
}
