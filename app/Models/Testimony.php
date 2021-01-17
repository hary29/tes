<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'testimony';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_testimony';

    /**
     * @var array
     */
    protected $fillable = ['publish', 'url_photo', 'name', 'position', 'location', 'content_testimony', 'created_date', 'created_id', 'modified_date', 'modified_id'];

    protected $appends = ['publish_label'];

    public function getPublishLabelAttribute() 
    {
        if ($this->publish == 1) {
            return '<span class="text-green-500"> Publish </span>';
        }elseif ($this->publish == 2) {
            return '<span class="text-red-500"> UnPublish </span>';
        }
    }

    public function getPhoto()
    {
        if ($this->url_photo == null) {
            return '/img/default-empty-profile.png';
        }
        elseif (file_exists( public_path() . '/uploads/testimony/' . $this->url_photo)) {
            return '/uploads/testimony/' . $this->url_photo;
        } else {
            return '/img/default-empty-profile.png';
        }     
    }

    /**
     * Get the user that was create/modified about.
     */
    public function userCreated()
    {
        return $this->belongsTo(User::class, 'created_id', 'id');
    }

    public function userModified()
    {
        return $this->belongsTo(User::class, 'modified_id', 'id');
    }
}
