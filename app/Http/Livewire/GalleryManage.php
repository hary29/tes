<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Gallery as GalleryModel;

class GalleryManage extends Component
{
    use WithFileUploads;
    use WithPagination;
	public $id_gallery, $publish, $name, $url, $description, $event_time, $created_id, $modified_id, $publish_label, $created, $modified, $created_date, $modified_date, $createBy, $modifiedBy;
	public $isModal = 0;
    public $isDetail = 0;
    
    public $searchNameTerm;

    public function render()
    {
    	$searchTerm = '%'.$this->searchNameTerm.'%';
    	$content = GalleryModel::where('name','like', $searchTerm)->orderBy('created_date', 'DESC')->paginate(2);
        return view('livewire.galleryManage.manage',['content' => $content]);
    }

    public function create()
    {
        //KEMUDIAN DI DALAMNYA KITA MENJALANKAN FUNGSI UNTUK MENGOSONGKAN FIELD
        $this->resetFields();
        $this->created_id = request()->user()->id;
        //DAN MEMBUKA MODAL
        $this->openModal();
    }

     //FUNGSI INI DIGUNAKAN UNTUK MEMBUKA MODAL
    public function openModal()
    {
        $this->isModal = true;
    }

    //FUNGSI INI UNTUK ME-RESET FIELD/KOLOM, SESUAIKAN FIELD APA SAJA YANG KAMU MILIKI
    public function resetFields()
    {
        $this->publish = '';
        $this->name = '';
        $this->url = '';
        $this->event_time = '';
        $this->description = '';
    }

    public function closeModal()
    {
        $this->isModal = false;
        $this->resetValidation();
    }

    public function store()
    {
    	
        //MEMBUAT VALIDASI
        $this->validate([
            //'path_photo' => 'required|string',
            'name' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|url',
            'event_time' => 'required|date',
            //'photo' => 'image|max:1024', // 1MB Max
            // 'email' => 'required|email|unique:members,email,' . $this->member_id,
            // 'phone_number' => 'required|numeric',
            // 'status' => 'required'
        ]);

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        GalleryModel::updateOrCreate(['id_gallery' => $this->id_gallery], [
            'publish' => $this->publish,
            'name' => $this->name,
            'description' => $this->description,
            'url' => $this->url,
            'event_time' => $this->event_time,
            'created_id' => $this->created_id,
            'modified_id' => $this->modified_id,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('success-message', $this->id_gallery ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

     public function edit($id)
    {

        $gallery = GalleryModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_gallery = $id;
        $this->publish = $gallery->publish;
        $this->name = $gallery->name;
        $this->description = $gallery->description;
        $this->url = $gallery->url;
        $this->event_time = $gallery->event_time;
        $this->created_id = $gallery->created_id;
        $this->publish_label = $gallery->getPublishLabelAttribute();
        $this->modified_id = request()->user()->id;

        $this->openModal(); //LALU BUKA MODAL
    }

    public function delete($id)
    {
        $gallery = GalleryModel::find($id);
         //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //LALU HAPUS DATA
        $gallery->publish = 2;
        $gallery->modified_id = request()->user()->id;
        $gallery->save();
        $changes = $gallery->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data pada ' .$gallery->name);
        }else{
	        session()->flash('success-message', $gallery->name . ' berhasil dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function switchPublish($id)
    {
        $gallery = GalleryModel::find($id);
        $galleryPublish = 0;
        if ($gallery->publish == 1) {
            $gallery->publish = 2;
        }elseif ($gallery->publish == 2) {
            $gallery->publish = 1;
        }
        $gallery->modified_id = request()->user()->id;

        $gallery->save();
        $changes = $gallery->getChanges();
        if (empty($changes)) {
            session()->flash('error-message', 'tidak ada perubahan data pada ' .$gallery->name);
        }else{
            session()->flash('success-message', $gallery->name . ' berhasil diubah'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function detail($id){
        $gallery = GalleryModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_gallery = $id;
        $this->publish = $gallery->getPublishLabelAttribute();
        $this->name = $gallery->name;
        $this->description = $gallery->description;
        $this->url = $gallery->url;
        $this->event_time = $gallery->event_time;
        $this->created_id = $gallery->created_id;
        $this->modified_id = request()->user()->id;

        
        if ($gallery->created_id) {
            $this->createBy = $gallery->userCreated->name;
        }
        if ($gallery->modified_id) {
            $this->modifiedBy = $gallery->userModified->name;
        }
        if ($gallery->created_date) {
            $this->created_date = date('d-m-Y h:i:s', strtotime($gallery->created_date));
        }
        if ($gallery->modified_date) {
            $this->modified_date = date('d-m-Y h:i:s', strtotime($gallery->modified_date));
        }
        $this->isDetail = true;

        //$this->openModal();
    }

    public function closeModalDetail()
    {
        $this->isDetail = false;
    }
}
