<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketReplied;

class TicketController extends Controller
{

    // Tüm destek taleplerini listele (Açık olanlar en üstte)
    public function index()
    {
        $tickets = Ticket::with('user')
            ->orderByRaw("CASE WHEN status = 'open' THEN 1 WHEN status = 'answered' THEN 2 ELSE 3 END")
            ->latest()
            ->get();
            
        return view('admin.tickets.index', compact('tickets'));
    }

    // Talebin detayını ve mesajları gör
    public function show($id)
    {
        $ticket = Ticket::with(['messages.user', 'user'])->findOrFail($id);
        return view('admin.tickets.show', compact('ticket'));
    }

    // Müşteriye cevap yaz
    public function reply(Request $request, $id)
    {
        // ... reply metodu içinde mesaj kaydedildikten sonra:
        $request->validate(['message' => 'required|string']);
        $ticket = Ticket::findOrFail($id);
        Mail::to($ticket->user->email)->send(new TicketReplied($ticket));

        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(), // Adminin ID'si
            'message' => $request->message
        ]);

        // Admin cevapladığı için durumu 'Yanıtlandı' yap
        $ticket->update(['status' => 'answered']);

        return back()->with('success', 'Müşteriye yanıt başarıyla gönderildi.');
    }

    // Talebi Kapat
    public function close($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => 'closed']);

        return back()->with('success', 'Destek talebi kapatıldı.');
    }
}