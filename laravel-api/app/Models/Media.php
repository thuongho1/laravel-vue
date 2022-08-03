<?php
//
//namespace App\Models;
//
//use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//
//class Media extends Model
//{
//    use HasFactory;
//
//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array
//     */
//    protected $fillable = [
//        'title', 'description', 'filesize', 'file_id', 'media_type_id', 'status'
//    ];
//    /**
//     * The model's default values for attributes.
//     *
//     * @var array
//     */
//    protected $attributes = [
//        'status' => 1,
//    ];
//
//    /**
//     * Get the user that owns the post.
//     */
//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }
//    /**
//     * Get all of the videos that are assigned this tag.
//     */
//    public function posts()
//    {
//        return $this->morphedByMany(Post::class, 'mediaable');
//    }
//}
