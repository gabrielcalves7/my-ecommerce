<?php

namespace App\Livewire;

use App\Helpers\Helper;
use Livewire\Component;

class AdminHeader extends Component
{
    private function setActionsURL($menu)
    {
        foreach ($menu as &$value) {
            $actions = [];

            foreach ($value['actions'] as $key => &$action) {
                $url = strtolower(Helper::singularize($value['name']) . '.' . $action);
                $url = $this->routeExists(Helper::singularize($url));
                $actions[] = ["name" => $action, "url" => $url];
            }
            $value['actions'] = $actions;
        }
        return $menu;
    }

    private function menu()
    {
        $options = [
            [
                "name" => "Home",
                "actions" => [],
                "url" => route("admin")
            ],
            [
                "name" => "Users",
                "actions" => [
                    "view",
                    "create"
                ],
                "url" => route("user.view")
            ],
            [
                "name" => "Products",
                "actions" => [
                    "view",
                    "create"
                ],
                "url" => route("product.view")
            ],
            [
                "name" => "Categories",
                "actions" => [
                    "view",
                    "create"
                ],
                "url" => route("category.view")
            ]
        ];
        return $this->setActionsURL($options);
    }

    public function routeExists($name)
    {
        try {
            return route($name);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function render()
    {
        return view('components.admin.header', ['menu' => $this->menu()]);
    }
}
