<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    public const ADMIN_ID = 1;
    public const ANALYTIC_ID = 2;
    public const MANAGER_ID = 3;
    static string $position = "";


    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id', 'id');
    }
    
    public static function getPosition($position_id): string
    {
        if ($position_id == 1) {
            self::$position = 'admin';
        }
        if ($position_id == 3) {
            self::$position = 'manager';
        }
        return self::$position;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position_id',
        'api_token',
        'task_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
