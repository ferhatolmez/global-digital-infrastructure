<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $site->domain_name }} - Site Editörü</title>
    
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        body, html { margin: 0; padding: 0; height: 100%; overflow: hidden; background-color: #444; }
        #gjs { border: none; }
        
        /* Özel üst bar stili */
        .editor-top-bar {
            background-color: #2b2b2b; color: #fff; padding: 10px 20px;
            display: flex; justify-content: space-between; align-items: center;
            font-family: Arial, sans-serif; height: 50px;
        }
        .btn-back { color: #aaa; text-decoration: none; font-size: 14px; }
        .btn-back:hover { color: #fff; }
        .btn-save {
            background-color: #4f46e5; color: white; border: none;
            padding: 8px 16px; border-radius: 4px; cursor: pointer; font-weight: bold;
        }
        .btn-save:hover { background-color: #4338ca; }
    </style>
</head>
<body>

    <div class="editor-top-bar">
        <div>
            <a href="{{ route('client.builder.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Panele Dön</a>
            <span style="margin-left: 20px; font-weight: bold;">{{ $site->domain_name }}</span>
        </div>
        <button id="save-button" class="btn-save"><i class="fas fa-save"></i> Değişiklikleri Kaydet</button>
    </div>

    <div id="gjs">
        {!! $site->html_content !!}
        <style>
            {!! $site->css_content !!}
        </style>
    </div>

    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-blocks-basic"></script>

    <script>
        // GrapesJS Başlatılıyor
        const editor = grapesjs.init({
            container: '#gjs',
            fromElement: true,
            height: 'calc(100vh - 50px)',
            width: '100%',
            storageManager: false, // Kendi AJAX kaydetme sistemimizi kullanıyoruz
            plugins: ['gjs-blocks-basic'], // Sadece temel blokları yüklüyoruz
            pluginsOpts: {
                'gjs-blocks-basic': { 
                    flexGrid: true,
                    blocks: ['column1', 'column2', 'column3', 'column3-7', 'text', 'link', 'image', 'video']
                }
            }
        });

        // Editör yüklendiğinde otomatik olarak Bloklar sekmesini aç
        editor.on('load', () => {
            const openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
            if (openBlocksBtn) openBlocksBtn.set('active', 1);
        });

        // Kaydetme İşlemi (AJAX)
        document.getElementById('save-button').addEventListener('click', function() {
            const btn = this;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Kaydediliyor...';
            btn.disabled = true;

            fetch('{{ route("client.builder.save", $site->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    html: editor.getHtml(),
                    css: editor.getCss()
                })
            })
            .then(response => response.json())
            .then(data => {
                btn.innerHTML = '<i class="fas fa-check"></i> Kaydedildi!';
                btn.style.backgroundColor = '#10b981';
                
                setTimeout(() => {
                    btn.innerHTML = '<i class="fas fa-save"></i> Değişiklikleri Kaydet';
                    btn.style.backgroundColor = '#4f46e5';
                    btn.disabled = false;
                }, 3000);
            })
            .catch((error) => {
                alert('Kaydetme başarısız!');
                btn.innerHTML = '<i class="fas fa-save"></i> Değişiklikleri Kaydet';
                btn.disabled = false;
            });
        });
    </script>
</body>
</html>