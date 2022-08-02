<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    use HasFactory;

    protected $fillable = [
        'nome',
        'icone',
        'link',
        'tabela',
        'submenu',
    ];

    public static function readMenus()
    {
        return Menu::orderBy('nome', 'asc')
        ->select('id', 'nome', 'icone', 'link', 'tabela', 'submenu', 'created_at', 'updated_at')
        ->get();
    }

    public static function createMenu($data)
    {
        return Menu::create([
            'nome' => $data['nome'],
            'icone' => $data['icone'],
            'link' => $data['link'],
            'tabela' => $data['tabela'],
            'submenu' => $data['submenu'],
        ]);
    }

    public static function updateMenu($data, $id)
    {
        return Menu::where('id', $id)->update($data);
    }

    public static function deleteMenu($id)
    {
        return Menu::where('id', $id)->delete();
    }

    public static function readMenu($id)
    {
        return Menu::where('id', $id)->first();
    }


}
