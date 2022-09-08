<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
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
    public function boot()
    {
        $configDatatable = [
            'language' => [
                'emptyTable' => 'Nenhum registro encontrado',
                'info' => 'Mostrando de _START_ até _END_ de _TOTAL_ registros',
                'infoEmpty' => 'Mostrando 0 até 0 de 0 registros',
                'infoFiltered' => '(Filtrados de _MAX_ registros)',
                'infoThousands' => '.',
                'loadingRecords' => 'Carregando...',
                'processing' => 'Processando...',
                'zeroRecords' => 'Nenhum registro encontrado',
                'search' => 'Pesquisar',
                'paginate' => [
                    'next' => 'Próximo',
                    'previous' => 'Anterior',
                    'first' => 'Primeiro',
                    'last' => 'Último',
                ],
                'buttons' => [
                    'pageLength' => [
                        '-1' => 'Mostrar todos os registros',
                        '_' => 'Mostrar %d registros',
                    ],
                ],
            ],
        ];

        View::share('configDatatable', $configDatatable);
    }
}
