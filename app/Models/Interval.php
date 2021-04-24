<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

class Interval extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'work_period',
        'rest_period',
        'repeat'
    ];

    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prepareIntervalSlug(string $name)
    {
        return strtolower( preg_replace( '/[^a-zA-Z0-9]/', '-', $name) );
    }

    public function validateNewInterval(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|min:1|max:50',
            'work_period' => 'required|numeric|min:1',
            'rest_period' => 'required|numeric|min:0',
            'repeat' => 'required|numeric|min:0'
        ]);
    }

    public function prepareNewInterval(Request $request, int $user_id)
    {
        return array(
            'user_id' => $user_id,
            'name' => $request->input('name'),
            'slug' => $this->prepareIntervalSlug($request->input('name')),
            'work_period' => $request->input('work_period'),
            'rest_period' => $request->input('rest_period'),
            'repeat' => $request->input('repeat')
        );
    }

}
