<div style="font-family: sans-serif; padding: 20px; color: #333;">
    <h2 style="color: #4f46e5;">Destek Talebiniz Yanıtlandı!</h2>
    <p>Merhaba,</p>
    <p><strong>#{{ $ticket->id }}</strong> numaralı "<strong>{{ $ticket->subject }}</strong>" konulu destek talebinize yeni bir yanıt geldi.</p>
    <div style="margin: 20px 0; padding: 15px; background: #f3f4f6; border-radius: 10px;">
        <em>Panelinize giriş yaparak yanıtın detaylarını görebilir ve görüşmeye devam edebilirsiniz.</em>
    </div>
    <a href="{{ route('client.tickets.show', $ticket->id) }}" style="background: #4f46e5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Talebi Görüntüle</a>
    <p style="margin-top: 30px; font-size: 12px; color: #9ca3af;">Global Dijital Altyapı Otomasyon Sistemi</p>
</div>