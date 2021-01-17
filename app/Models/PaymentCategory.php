<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCategory extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'payment_category';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_payment_category';

    /**
     * @var array
     */
    protected $fillable = ['publish', 'path_photo', 'title', 'path_logo', 'description', 'created_date', 'created_id', 'modified_date', 'modified_id'];

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
        if ($this->path_photo == null) {
            return '/img/default-about.png';
        }
        elseif (file_exists( public_path() . '/uploads/images-upload-about/' . $this->path_photo)) {
            return '/uploads/images-upload-about/' . $this->path_photo;
        } else {
            return '/img/default-about.png';
        }     
    }

    public function getLogoPayment()
    {
        if ($this->path_photo == null) {
            return '/img/default-about.png';
        }
        elseif (file_exists( public_path() . '/payment-logo/' . $this->path_photo)) {
            return '/payment-logo/' . $this->path_photo;
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
