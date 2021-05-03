<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'session'
    ];

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prepareSlug(string $name)
    {
        return strtolower( preg_replace( '/[^a-zA-Z0-9]/', '-', $name) );
    }

    public function validateSessionData(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|min:1|max:100',
            'session' => 'required|json'
        ]);
    }

    public function prepareSessionDataForDB(Request $request, int $user_id)
    {
        return array(
            'user_id' => $user_id,
            'name' => $request->input('name'),
            'slug' => $this->prepareSlug($request->input('name')),
            'session' => $request->input('session')
        );
    }
}
