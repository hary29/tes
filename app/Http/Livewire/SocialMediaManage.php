<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\SocialMedia as SocialMediaModel;

class SocialMediaManage extends Component
{
    use WithFileUploads;
    use WithPagination;
	public $id_social_media, $publish, $name, $url, $name_id, $icon_class, $created_id, $modified_id, $publish_label, $created, $modified, $created_date, $modified_date, $createBy, $modifiedBy;
	public $isModal = 0;
    public $isDetail = 0;

    public function render()
    {
        return view('livewire.socialMediaManage.manage', ['content' => SocialMediaModel::orderBy('created_date', 'DESC')->paginate(2)]);
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
        $this->icon_class = '';
        $this->name_id = '';
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
            'name_id' => 'required|string',
            'url' => 'required|url',
            'icon_class' => 'required|string',
            //'photo' => 'image|max:1024', // 1MB Max
            // 'email' => 'required|email|unique:members,email,' . $this->member_id,
            // 'phone_number' => 'required|numeric',
            // 'status' => 'required'
        ]);

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        SocialMediaModel::updateOrCreate(['id_social_media' => $this->id_social_media], [
            'publish' => $this->publish,
            'name' => $this->name,
            'name_id' => $this->name_id,
            'url' => $this->url,
            'icon_class' => $this->icon_class,
            'created_id' => $this->created_id,
            'modified_id' => $this->modified_id,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('success-message', $this->id_social_media ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

     public function edit($id)
    {

        $socialMedia = SocialMediaModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_social_media = $id;
        $this->publish = $socialMedia->publish;
        $this->name = $socialMedia->name;
        $this->name_id = $socialMedia->name_id;
        $this->url = $socialMedia->url;
        $this->icon_class = $socialMedia->icon_class;
        $this->created_id = $socialMedia->created_id;
        $this->modified_id = request()->user()->id;

        $this->openModal(); //LALU BUKA MODAL
    }

    public function delete($id)
    {
        $socialMedia = SocialMediaModel::find($id);
         //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //LALU HAPUS DATA
        $socialMedia->publish = 2;
        $socialMedia->modified_id = request()->user()->id;
        $socialMedia->save();
        $changes = $socialMedia->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data pada ' .$socialMedia->name);
        }else{
	        session()->flash('success-message', $socialMedia->name . ' berhasil dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function switchPublish($id)
    {
        $socialMedia = SocialMediaModel::find($id);
        $socialMediaPublish = 0;
        if ($socialMedia->publish == 1) {
            $socialMedia->publish = 2;
        }elseif ($socialMedia->publish == 2) {
            $socialMedia->publish = 1;
        }
        $socialMedia->modified_id = request()->user()->id;

        $socialMedia->save();
        $changes = $socialMedia->getChanges();
        if (empty($changes)) {
            session()->flash('error-message', 'tidak ada perubahan data pada ' .$socialMedia->name);
        }else{
            session()->flash('success-message', $socialMedia->name . ' berhasil diubah'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function detail($id){
        $socialMedia = SocialMediaModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_social_media = $id;
        $this->publish = $socialMedia->getPublishLabelAttribute();
        $this->name = $socialMedia->name;
        $this->name_id = $socialMedia->name_id;
        $this->url = $socialMedia->url;
        $this->icon_class = $socialMedia->icon_class;
        $this->created_id = $socialMedia->created_id;
        $this->modified_id = request()->user()->id;

        
        if ($socialMedia->created_id) {
            $this->createBy = $socialMedia->userCreated->name;
        }
        if ($socialMedia->modified_id) {
            $this->modifiedBy = $socialMedia->userModified->name;
        }
        if ($socialMedia->created_date) {
            $this->created_date = date('d-m-Y h:i:s', strtotime($socialMedia->created_date));
        }
        if ($socialMedia->modified_date) {
            $this->modified_date = date('d-m-Y h:i:s', strtotime($socialMedia->modified_date));
        }
        $this->isDetail = true;

        //$this->openModal();
    }

    public function closeModalDetail()
    {
        $this->isDetail = false;
    }
}
