<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**
 * @property int $id_about
 * @property boolean $publish
 * @property string $path_url
 * @property string $title
 * @property string $short_content
 * @property string $decription
 * @property string $created_date
 * @property int $created_id
 * @property string $modified_date
 * @property int $modified_id
 */
class About extends Model
{
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'about';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_about';

    /**
     * @var array
     */
    protected $fillable = ['publish', 'path_url', 'title', 'short_content', 'description', 'created_date', 'created_id', 'modified_date', 'modified_id'];

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
        if ($this->path_url == null) {
            return '/img/default-about.png';
        }
        elseif (file_exists( public_path() . '/uploads/images-upload-about/' . $this->path_url)) {
            return '/uploads/images-upload-about/' . $this->path_url;
        } else {
            return '/img/default-about.png';
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
