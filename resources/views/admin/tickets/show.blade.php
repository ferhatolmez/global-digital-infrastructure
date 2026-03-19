@extends('layouts.admin')

@section('content')
<div class="flex flex-col h-[calc(100vh-120px)] max-w-5xl mx-auto">
    
    <div class="bg-white border border-slate-200 rounded-t-xl p-4 flex justify-between items-center shadow-sm z-10">
        <div class="flex items-center">
            <a href="{{ route('admin.tickets.index') }}" class="text-slate-400 hover:text-emerald-600 mr-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            <div>
                <h2 class="text-lg font-bold text-slate-800">{{ $ticket->subject }}</h2>
                <p class="text-xs text-slate-500">Müşteri: {{ $ticket->user->name }} | Talep No: #{{ $ticket->id }}</p>
            </div>
        </div>
        <div>
            @if($ticket->status != 'closed')
                <form action="{{ route('admin.tickets.close', $ticket->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 font-bold py-2 px-4 rounded-lg text-sm transition border border-red-200">
                        Talebi Kapat
                    </button>
                </form>
            @else
                <span class="px-4 py-2 text-sm font-bold rounded-lg bg-slate-100 text-slate-600 border border-slate-200">Bu Talep Kapatıldı</span>
            @endif
        </div>
    </div>

    <div class="flex-1 overflow-y-auto bg-slate-50 p-6 border-x border-slate-200">
        <div class="space-y-6">
            @foreach($ticket->messages as $msg)
                @if($msg->user_id == $ticket->user_id)
                    <div class="flex justify-start">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs border border-indigo-200">
                                {{ substr($msg->user->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="bg-white border border-slate-200 text-slate-800 rounded-2xl rounded-tl-none px-5 py-3 max-w-[80%] shadow-sm">
                            <p class="text-sm font-bold mb-1 text-indigo-700">{{ $msg->user->name }} (Müşteri)</p>
                            <p class="text-sm whitespace-pre-wrap">{{ $msg->message }}</p>
                            <span class="text-[10px] text-slate-400 block mt-2">{{ $msg->created_at->format('d M H:i') }}</span>
                        </div>
                    </div>
                @else
                    <div class="flex justify-end">
                        <div class="bg-emerald-600 text-white rounded-2xl rounded-tr-none px-5 py-3 max-w-[80%] shadow-sm">
                            <p class="text-sm font-bold mb-1 text-emerald-100">Sen (Admin)</p>
                            <p class="text-sm whitespace-pre-wrap">{{ $msg->message }}</p>
                            <span class="text-[10px] text-emerald-200 block text-right mt-2">{{ $msg->created_at->format('d M H:i') }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    @if($ticket->status != 'closed')
        <div class="bg-white border border-slate-200 rounded-b-xl p-4 shadow-sm">
            <form action="{{ route('admin.tickets.reply', $ticket->id) }}" method="POST">
                @csrf
                <textarea name="message" rows="3" required placeholder="Müşteriye yanıtınızı buraya yazın..." class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-emerald-500 focus:border-emerald-500 resize-none mb-3"></textarea>
                <div class="flex justify-between items-center">
                    <span class="text-xs text-slate-500">Müşteri yanıtınızı e-posta olarak da alacaktır. (Yakında)</span>
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2 px-8 rounded-lg shadow-sm transition">
                        Yanıtı Gönder
                    </button>
                </div>
            </form>
        </div>
    @endif
</div>
@endsection