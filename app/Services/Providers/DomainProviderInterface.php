<?php

namespace App\Services\Providers;

interface DomainProviderInterface
{
    /**
     * Belirtilen uzantıların güncel fiyat listesini API'den çeker.
     * * @param array $extensions (Örn: ['.com', '.net'])
     * @return array (Örn: ['.com' => ['register' => 9.99, 'renew' => 10.99, 'transfer' => 8.99]])
     */
    public function getPrices(array $extensions): array;
}