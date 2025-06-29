<?php

namespace Codermahidul\IconPicker\Components;

use Illuminate\View\Component;

class IconPicker extends Component
{
    public string $name;
    public ?string $value;

    public function __construct(string $name = 'icon', ?string $value = null)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('iconpicker::components.icon-picker');
    }
}
