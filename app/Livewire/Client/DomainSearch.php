<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\DomainExtension;

class DomainSearch extends Component
{
    public $query = '';
    public $results = null;
    public $aiSuggestions = null;

    protected $queryString = ['query'];

    public function search()
    {
        $this->validate([
            'query' => 'required|string|min:3'
        ]);

        // Simulating artificial delay for skeleton loading demo
        sleep(1); 

        $domainName = explode('.', $this->query)[0];
        $extensions = DomainExtension::where('is_active', true)->get();
        $this->results = [];

        foreach ($extensions as $ext) {
            $isAvailable = rand(1, 10) > 3; 

            $this->results[] = (object)[
                'full_domain'  => $domainName . $ext->extension,
                'extension'    => $ext->extension,
                'is_available' => $isAvailable,
                'price'        => $ext->register_price,
                'ext_id'       => $ext->id
            ];
        }

        // Fetch AI generated premium alternatives
        $this->aiSuggestions = app(\App\Services\AIService::class)->suggestDomains($domainName);
    }

    public function render()
    {
        return view('livewire.client.domain-search');
    }
}
