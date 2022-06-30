<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters)
    {
        //dd($filters['tag']);

        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('quantity', 'like', '%' . request('search') . '%')
                ->orWhere('code', 'like', '%' . request('search') . '%')
                ->orWhere('type', 'like', '%' . request('search') . '%');
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}



// class Material
// {
   

//     public static function all()
//     {
//         return [
//             [
//                 'id' => '1',
//                 'name' => 'asdasd',
//                 'quantity' => '121',
//                 'code' => '1212',
//                 'type' => 'sada'
//             ],


//             [
//                 'id' => '2',
//                 'name' => 'sdfsg',
//                 'quantity' => '1221',
//                 'code' => '123',
//                 'type' => 'gdfg'
//             ]

//         ];
//     }

//     public static function find($id) {
//         $materials = self::all();
//         foreach ($materials as $material) {
//             if ($material['id'] == $id) {
//                 return $material;
//             }
//         }
//     }
// }
