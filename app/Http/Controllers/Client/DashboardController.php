<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserSite;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // İstatistikler için verileri çekelim
        $data = [
            'active_sites'   => UserSite::where('user_id', $user->id)->count(),
            'total_orders'   => Order::where('user_id', $user->id)->count(),
            'open_tickets'   => Ticket::where('user_id', $user->id)->where('status', 'open')->count(),
            // Son 5 siparişi tabloda göstermek için çekiyoruz
            'recent_orders'  => Order::where('user_id', $user->id)->latest()->take(5)->get(),
        ];

        return view('client.dashboard', compact('data'));
    }
}