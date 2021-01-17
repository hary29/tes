<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Testimony as TestimonyModel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TestimonyManage extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $publish, $url_photo, $name, $position, $location, $content_testimony, $id_testimony, $created_id, $modified_id, $publish_label, $created, $modified, $created_date, $modified_date, $createBy, $modifiedBy;
    //public $testimony;
    public $isModal = 0;
    public $isDetail = 0;


    public $photo;


  	//FUNGSI INI UNTUK ME-LOAD VIEW YANG AKAN MENJADI TAMPILAN HALAMAN MEMBER
    public function render()
    {
    	//dd(request()->user()->currentTeam->id);
        //$this->testimony = TestimonyModel::where('publish', 1)->orderBy('created_date', 'DESC')->paginate(2);
        //MEMBUAT QUERY UNTUK MENGAMBIL DATA
        return view('livewire.testimonyManage.manage', ['data' => TestimonyModel::orderBy('created_date', 'DESC')->paginate(2)]); //LOAD VIEW MEMBERS.BLADE.PHP YG ADA DI DALAM FOLDER /RESOURSCES/VIEWS/LIVEWIRE
    }

    //FUNGSI INI AKAN DIPANGGIL KETIKA TOMBOL TAMBAH ANGGOTA DITEKAN
    public function create()
    {
        //KEMUDIAN DI DALAMNYA KITA MENJALANKAN FUNGSI UNTUK MENGOSONGKAN FIELD
        $this->resetFields();
        $this->created_id = request()->user()->id;
        //DAN MEMBUKA MODAL
        $this->openModal();
    }

    //FUNGSI INI UNTUK MENUTUP MODAL DIMANA VARIABLE ISMODAL KITA SET JADI FALSE
    public function closeModal()
    {
        $this->isModal = false;
        $this->resetValidation();
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
        $this->url_photo = '';
        $this->name = '';
        $this->position = '';
        $this->location = '';
        $this->content_testimony = '';
        $this->photo = '';
    }

    //METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA
    public function store()
    {
    	
        //MEMBUAT VALIDASI
        $this->validate([
            //'url_photo' => 'required|string',
            'name' => 'required|string',
            'position' => 'required|string',
            'content_testimony' => 'required|string',
            //'photo' => 'image|max:1024', // 1MB Max
            // 'email' => 'required|email|unique:members,email,' . $this->member_id,
            // 'phone_number' => 'required|numeric',
            // 'status' => 'required'
        ]);

        /* Store $imageName name in DATABASE from HERE */
        if ($this->photo !== null && $this->photo !== '') {

        	$this->validate([
            	'photo' => 'image|max:1024', // 1MB Max
        	]);

	        $imageName = time().'.'.$this->photo->extension();  
	     	//$this->photo->move(public_path('images-upload'), $imageName);
	        $this->photo->storeAs('images-upload-testimony', $imageName, 'public_uploads');

	        $this->url_photo = $imageName;

		}

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        TestimonyModel::updateOrCreate(['id_testimony' => $this->id_testimony], [
            'url_photo' => $this->url_photo,
            'publish' => $this->publish,
            'name' => $this->name,
            'position' => $this->position,
            'location' => $this->location,
            'content_testimony' => $this->content_testimony,
            'created_id' => $this->created_id,
            'modified_id' => $this->modified_id,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('success-message', $this->id_testimony ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    //FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID MEMBER
    public function edit($id)
    {

        $testimony = TestimonyModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_testimony = $id;
        $this->publish = $testimony->publish;
        $this->url_photo = $testimony->url_photo;
        $this->name = $testimony->name;
        $this->position = $testimony->position;
        $this->location = $testimony->location;
        $this->content_testimony = $testimony->content_testimony;
        $this->created_id = $testimony->created_id;
        $this->modified_id = request()->user()->id;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $testimony = TestimonyModel::find($id);
         //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //LALU HAPUS DATA
        $testimony->publish = 2;
        $testimony->modified_id = request()->user()->id;
        $testimony->save();
        $changes = $testimony->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data pada ' .$testimony->name);
        }else{
	        session()->flash('success-message', $testimony->name . ' berhasil dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function switchPublish($id)
    {
        $testimony = TestimonyModel::find($id);
        $testimonyPublish = 0;
        if ($testimony->publish == 1) {
            $testimony->publish = 2;
        }elseif ($testimony->publish == 2) {
            $testimony->publish = 1;
        }
        $testimony->modified_id = request()->user()->id;

        $testimony->save();
        $changes = $testimony->getChanges();
        if (empty($changes)) {
            session()->flash('error-message', 'tidak ada perubahan data pada ' .$testimony->name);
        }else{
            session()->flash('success-message', $testimony->name . ' berhasil diubah'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function detail($id){
        $detail = TestimonyModel::find($id);

        $this->id_testimony = $id;
        $this->publish = $detail->publish;
        $this->url_photo = $detail->url_photo;
        $this->name = $detail->name;
        $this->position = $detail->position;
        $this->location = $detail->location;
        $this->content_testimony = $detail->content_testimony;
        $this->created_id = $detail->created_id;
        $this->modified_id = request()->user()->id;
        $this->photo = $detail->getPhoto();
        $this->publish_label = $detail->getPublishLabelAttribute();
        if ($detail->created_id) {
            $this->createBy = $detail->userCreated->name;
        }
        if ($detail->modified_id) {
            $this->modifiedBy = $detail->userModified->name;
        }
        if ($detail->created_date) {
            $this->created_date = date('d-m-Y h:i:s', strtotime($detail->created_date));
        }
        if ($detail->modified_date) {
            $this->modified_date = date('d-m-Y h:i:s', strtotime($detail->modified_date));
        }
        $this->isDetail = true;

        //$this->openModal();
    }

    public function closeModalDetail()
    {
        $this->isDetail = false;
    }
}
