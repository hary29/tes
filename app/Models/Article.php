<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	public $timestamps = false;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'article';

    protected $primaryKey = 'id_article';

    protected $fillable = ['publish', 'path_photo', 'title', 'short_description', 'description', 'created_date', 'created_id', 'modified_date', 'modified_id'];

    protected $appends = ['publish_label, photo'];

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
        if ($this->path_photo == null) {
            return '/img/default-about.png';
        }
        elseif (file_exists( public_path() . '/uploads/images-upload-article/' . $this->path_photo)) {
            return '/uploads/images-upload-article/' . $this->path_photo;
        } else {
            return '/img/default-about.png';
        }     
    }

    public function userCreated()
    {
        return $this->belongsTo(User::class, 'created_id', 'id');
    }

    public function userModified()
    {
        return $this->belongsTo(User::class, 'modified_id', 'id');
    }
}
