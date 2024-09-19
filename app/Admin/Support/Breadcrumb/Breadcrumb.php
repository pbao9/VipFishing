<?php

namespace App\Admin\Support\Breadcrumb;

class Breadcrumb
{

    public array $breadcrumbs = [];

    public function getBreadcrumbs(): array
    {
        return $this->breadcrumbs;
    }

    public function add(string $label, string $url = ''): static
    {
        $this->breadcrumbs[] = [
            'label' => $label,
            'url' => $url
        ];
        return $this;
    }
}
