<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use Illuminate\Support\Facades\View;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Lista todos os menus com submenu = C
        $menuCadastros = Menu::where('submenu', 'C')->get();
        $menuProcessos = Menu::where('submenu', 'P')->get();
        $menuRelatorios = Menu::where('submenu', 'R')->get();

        View::share('menuCadastros', $menuCadastros);
        View::share('menuProcessos', $menuProcessos);
        View::share('menuRelatorios', $menuRelatorios);
    }
}
