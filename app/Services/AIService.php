<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class AIService
{
    /**
     * Get premium domain suggestions based on a keyword using OpenAI.
     * Falls back to deterministic heuristic-based generation if no API key is provided.
     */
    public function suggestDomains(string $keyword): array
    {
        // Gerçek API Anahtarı tanımlandıysa OpenAI kullan
        if (!empty(config('openai.api_key'))) {
            try {
                $response = OpenAI::chat()->create([
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        ['role' => 'system', 'content' => 'Sen alanında uzman bir Premium Domain (Alan adı) bulucu ve pazarlamacısısın. Kullanıcının verdiği kelimeye/sektöre dayalı, global pazarda akılda kalıcı, marka değeri yüksek, çok satan uzantılara (.com, .io, .ai vb.) sahip 3 adet harika alan adı ÖNERİSİ üret. LÜTFEN SADECE JSON DİZİSİ OLARAK CEVAP VER. Başka hiçbir açıklama yazma. Örnek: ["ornek1.com", "ornek2.io", "ornek3.ai"]'],
                        ['role' => 'user', 'content' => "Kelime/Sektör: {$keyword}"],
                    ],
                ]);

                $content = $response['choices'][0]['message']['content'];
                $cleanContent = str_replace(['```json', '```'], '', $content);
                $suggestions = json_decode(trim($cleanContent), true);
                
                if (is_array($suggestions) && count($suggestions) > 0) {
                    return $this->formatSuggestions(array_slice($suggestions, 0, 3));
                }
            } catch (\Exception $e) {
                Log::error('OpenAI Error: ' . $e->getMessage());
            }
        }

        // API anahtarı yoksa veya hata alınırsa mantıksal simülasyon (Fallback)
        $suffixes = ['hq', 'app', 'global', 'hub', 'pro', 'tech', 'ai', 'io'];
        $tlds = ['.com', '.io', '.co', '.ai'];
        
        $predictions = [];
        $cleanKeyword = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($keyword));
        
        if (empty($cleanKeyword)) {
            $cleanKeyword = 'idea';
        }
        
        for ($i = 0; $i < 3; $i++) {
            $suffix = $suffixes[array_rand($suffixes)];
            $tld = $tlds[array_rand($tlds)];
            
            // Eğer kelime çok uzunsa suffix eklemeyip sadece ilginç TLD ekle
            $domainStr = (strlen($cleanKeyword) > 8 && rand(0,1)) 
                ? $cleanKeyword . $tld 
                : $cleanKeyword . $suffix . $tld;
                
            $predictions[] = $domainStr;
        }

        return $this->formatSuggestions($predictions);
    }

    private function formatSuggestions(array $domains): array
    {
        return array_map(function($domain) {
            return (object)[
                'full_domain' => strtolower($domain),
                'price' => rand(29, 149) . '.99',
                'is_premium' => true,
                'is_available' => true,
                // Varsayılan olarak sepete eklenmesi için .com ext_id'si varsayımı
                'ext_id' => 1 
            ];
        }, $domains);
    }
}
