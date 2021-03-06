<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'social_media';

    protected $primaryKey = 'id_social_media';

    protected $fillable = ['publish', 'name', 'url', 'name_id', 'icon_class', 'created_date', 'created_id', 'modified_date', 'modified_id'];

    protected $appends = ['publish_label'];

    public function getPublishLabelAttribute() 
    {
        if ($this->publish == 1) {
            return '<span class="text-green-500"> Publish </span>';
        }elseif ($this->publish == 2) {
            return '<span class="text-red-500"> UnPublish </span>';
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
