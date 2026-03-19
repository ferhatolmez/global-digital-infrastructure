<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Talepleri Listele
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->get();
        return view('client.tickets.index', compact('tickets'));
    }

    // Yeni Talep Oluşturma Formu
    public function create()
    {
        return view('client.tickets.create');
    }

    // Yeni Talebi Veritabanına Kaydet
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'message' => 'required|string'
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'priority' => $request->priority,
            'status' => 'open'
        ]);

        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message
        ]);

        return redirect()->route('client.tickets.index')->with('success', 'Destek talebiniz başarıyla oluşturuldu.');
    }

    // Talebin İçine Girme ve Mesajlaşma Ekranı
    public function show($id)
    {
        $ticket = Ticket::where('user_id', Auth::id())->with('messages.user')->findOrFail($id);
        return view('client.tickets.show', compact('ticket'));
    }

    // Talebe Yeni Mesaj Gönderme
    public function reply(Request $request, $id)
    {
        $request->validate(['message' => 'required|string']);
        $ticket = Ticket::where('user_id', Auth::id())->findOrFail($id);

        TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message
        ]);

        // Müşteri cevap yazdığında durumu tekrar 'open' (Açık) yapalım ki Admin'in önüne düşsün
        $ticket->update(['status' => 'open']);

        return back()->with('success', 'Mesajınız gönderildi.');
    }
}
