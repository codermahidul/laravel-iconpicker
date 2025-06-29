<?php
namespace Codermahidul\IconPicker;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Codermahidul\IconPicker\Components\IconPicker;

class IconPickerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'iconpicker');
        Blade::component('icon-picker', IconPicker::class);
    }
}
