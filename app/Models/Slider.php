<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
	/*oprevent default insert create_at and update_at*/
	public $timestamps = false;

    protected $table = 'slider_home';

    protected $primaryKey = 'id_slider';

     protected $fillable = ['publish', 'path_photo', 'title', 'description', 'created_date', 'created_id', 'modified_date', 'modified_id'];

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
        elseif (file_exists( public_path() . '/img/slider/' . $this->path_photo)) {
            return '/img/slider/' . $this->path_photo;
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
