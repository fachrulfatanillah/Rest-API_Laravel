<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'chat_messages';

    // Fields yang dapat diisi secara mass-assignment
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'timestamp',
        'is_read',
        'message_type',
        'attachment_url',
    ];

    // Mengatur format timestamp agar disimpan dalam bentuk yang sama seperti di migration
    public $timestamps = false;

    // Mendefinisikan relasi untuk model ini
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
