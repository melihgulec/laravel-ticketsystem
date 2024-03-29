<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'explanation', 'link_to', 'is_read'];

    public static function findUserMessages(){
        return Message::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC');
    }

    public static function findUserMessagesPaginated(){
        return self::findUserMessages()->paginate(3);
    }

    public static function getTotalUnreadMessages(){
        return self::findUserMessages()->where('is_read', 0)->count();
    }

    public static function setReadMessage($id){
        Message::where('id', $id)->update([
            'is_read' => 1
        ]);
    }
}
