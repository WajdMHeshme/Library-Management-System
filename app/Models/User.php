<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Borrowing;
use App\Models\Book;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];




    public function isAdmin()
    {
        return $this->role === 'admin';
    }


   

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     *  Books borrowed by user (many to many through borrowings)
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrowings')
            ->withPivot([
                'status',
                'borrowed_at',
                'due_date',
                'returned_at'
            ])
            ->withTimestamps();
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
