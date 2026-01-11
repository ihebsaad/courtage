<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientDocumentData extends Model
{
    protected $table = 'client_document_data';
    
    protected $fillable = [
        'client_id',
        'template_key',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}