@extends('layouts.client')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 flex flex-col h-[calc(100vh-100px)]">
    
    <div class="bg-white border border-gray-200 rounded-t-2xl p-4 flex justify-between items-center shadow-sm z-10">
        <div class="flex items-center">
            <a href="{{ route('client.tickets.index') }}" class="text-gray-400 hover:text-indigo-600 mr-4">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            <div>
                <h2 class="text-lg font-bold text-gray-900">{{ $ticket->subject }}</h2>
                <p class="text-xs text-gray-500">Talep No: #{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
        <div>
            @if($ticket->status == 'open')
                <span class="px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800">Açık / Bekliyor</span>
            @elseif($ticket->status == 'answered')
                <span class="px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800">Yanıtlandı</span>
            @else
                <span class="px-3 py-1 text-xs font-bold rounded-full bg-gray-100 text-gray-800">Kapatıldı</span>
            @endif
        </div>
    </div>

    <div class="flex-1 overflow-y-auto bg-gray-50 p-6 border-x border-gray-200">
        <div class="space-y-6">
            @foreach($ticket->messages as $msg)
                @if($msg->user_id == Auth::id())
                    <div class="flex justify-end">
                        <div class="bg-indigo-600 text-white rounded-2xl rounded-tr-none px-5 py-3 max-w-[80%] shadow-sm">
                            <p class="text-sm whitespace-pre-wrap">{{ $msg->message }}</p>
                            <span class="text-[10px] text-indigo-200 block text-right mt-2">{{ $msg->created_at->format('d M H:i') }}</span>
                        </div>
                    </div>
                @else
                    <div class="flex justify-start">
                        <div class="flex-shrink-0 mr-3">
                            <div class="h-8 w-8 rounded-full bg-gray-800 flex items-center justify-center text-white font-bold text-xs">
                                ADM
                            </div>
                        </div>
                        <div class="bg-white border border-gray-200 text-gray-800 rounded-2xl rounded-tl-none px-5 py-3 max-w-[80%] shadow-sm">
                            <p class="text-sm font-bold mb-1 text-gray-900">Destek Ekibi</p>
                            <p class="text-sm whitespace-pre-wrap">{{ $msg->message }}</p>
                            <span class="text-[10px] text-gray-400 block mt-2">{{ $msg->created_at->format('d M H:i') }}</span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    @if($ticket->status != 'closed')
        <div class="bg-white border border-gray-200 rounded-b-2xl p-4 shadow-sm">
            <form action="{{ route('client.tickets.reply', $ticket->id) }}" method="POST" class="flex items-end space-x-4">
                @csrf
                <div class="flex-1">
                    <textarea name="message" rows="2" required placeholder="Yanıtınızı buraya yazın..." class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-indigo-500 focus:border-indigo-500 resize-none"></textarea>
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white p-3 rounded-xl shadow-sm transition h-[50px] w-[50px] flex items-center justify-center mb-1">
                    <svg class="h-6 w-6 transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                </button>
            </form>
        </div>
    @else
        <div class="bg-gray-100 border border-gray-200 rounded-b-2xl p-4 text-center text-gray-500 text-sm font-bold">
            Bu destek talebi kapatılmıştır. Yeni bir sorununuz varsa lütfen yeni talep oluşturun.
        </div>
    @endif

</div>
@endsection