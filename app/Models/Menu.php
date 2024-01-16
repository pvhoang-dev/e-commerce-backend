<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'position',
        'url',
        'class_name',
        'id_name',
    ];

    public static function getRules($id = null)
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'parent_id' => [
                'required',
            ],
            'position' => [
                'required',
            ],
        ];
    }

    public function subMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id');
    }

    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
}
