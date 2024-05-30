<?php

namespace App\Livewire;

use Livewire\Component;

class Footer extends Component
{
    private $options = [
        [
            "title" => "Shop",
            "content" => [
                "Hot Deals",
                "Categories",
                "Brands",
                "Rebates",
                "Weekly deals",
            ]
        ],
        [
            "title" => "Need Help?",
            "content" => [
                "Contact",
                "Order tracking",
                "FAQs",
                "Return policy",
                "Privacy policy",
            ]
        ],
        [
            "title" => "Contact",
            "content" => [
                "123 Fifth Avenue, New York, NY",
                "10160",
                "contact@info.com",
                "929-242-6868",
            ]
        ],
    ];

    public function render()
    {
        return view('livewire.footer', ['options' => $this->options]);
    }
}
