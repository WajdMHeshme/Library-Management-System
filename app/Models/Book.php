<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Borrowing;
use App\Models\User;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'price',
        'stock',
        'category_id',
        'cover_image',
        'language',
        'published_year',
        'pages',
        'availability',
    ];

    /**
     *  Book belongs to Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     *  Borrowings for this book (1 to many)
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     *  Users who borrowed this book (many to many)
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'borrowings')
            ->withPivot([
                'status',
                'borrowed_at',
                'due_date',
                'returned_at'
            ])
            ->withTimestamps();
    }

    public function reviews ()
    {
        return $this->hasMany(Review::class);
    }
}
