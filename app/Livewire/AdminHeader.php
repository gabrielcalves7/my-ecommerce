<?php

namespace App\Livewire;

use Livewire\Component;

class AdminHeader extends Component
{
    private function setActionsURL($menu)
    {
        foreach ($menu as &$value) {
            $actions = [];

            foreach ($value['actions'] as $key => &$action) {
                $url = strtolower($value['name'] . '.' . $action);
                $url = $this->routeExists($url);
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
                "url" => route("users.view")
            ],
            [
                "name" => "Products",
                "actions" => [
                    "view",
                    "create"
                ],
                "url" => route("products.view")
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
