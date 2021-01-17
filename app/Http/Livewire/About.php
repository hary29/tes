<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\About as AboutModel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class About extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $publish, $path_url, $title, $short_content, $description, $id_about, $created_id, $modified_id, $publish_label, $created, $modified, $created_date, $modified_date, $createBy, $modifiedBy;
    //public $about;
    public $isModal = 0;
    public $isDetail = 0;


    public $photo;


  	//FUNGSI INI UNTUK ME-LOAD VIEW YANG AKAN MENJADI TAMPILAN HALAMAN MEMBER
    public function render()
    {
    	//dd(request()->user()->currentTeam->id);
        //$this->about = AboutModel::where('publish', 1)->orderBy('created_date', 'DESC')->paginate(2);
        //MEMBUAT QUERY UNTUK MENGAMBIL DATA
        return view('livewire.aboutManage.about', ['about' => AboutModel::orderBy('created_date', 'DESC')->paginate(2)]); //LOAD VIEW MEMBERS.BLADE.PHP YG ADA DI DALAM FOLDER /RESOURSCES/VIEWS/LIVEWIRE
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
        $this->path_url = '';
        $this->title = '';
        $this->short_content = '';
        $this->description = '';
        $this->photo = '';
    }

    //METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA
    public function store()
    {
    	
        //MEMBUAT VALIDASI
        $this->validate([
            //'path_url' => 'required|string',
            'title' => 'required|string',
            'short_content' => 'required|string',
            'description' => 'required|string',
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
	        $this->photo->storeAs('images-upload-about', $imageName, 'public_uploads');

	        $this->path_url = $imageName;

		}

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        AboutModel::updateOrCreate(['id_about' => $this->id_about], [
            'path_url' => $this->path_url,
            'publish' => $this->publish,
            'title' => $this->title,
            'short_content' => $this->short_content,
            'description' => $this->description,
            'created_id' => $this->created_id,
            'modified_id' => $this->modified_id,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('success-message', $this->id_about ? $this->title . ' Diperbaharui': $this->title . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    //FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID MEMBER
    public function edit($id)
    {

        $about = AboutModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_about = $id;
        $this->publish = $about->publish;
        $this->path_url = $about->path_url;
        $this->title = $about->title;
        $this->short_content = $about->short_content;
        $this->description = $about->description;
        $this->created_id = $about->created_id;
        $this->modified_id = request()->user()->id;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $about = AboutModel::find($id);
         //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //LALU HAPUS DATA
        $about->publish = 2;
        $about->modified_id = request()->user()->id;
        $about->save();
        $changes = $about->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data pada ' .$about->title);
        }else{
	        session()->flash('success-message', $about->title . ' berhasil dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function switchPublish($id)
    {
        $about = AboutModel::find($id);
        $aboutPublish = 0;
        if ($about->publish == 1) {
            $about->publish = 2;
        }elseif ($about->publish == 2) {
            $about->publish = 1;
        }
        $about->modified_id = request()->user()->id;

        $about->save();
        $changes = $about->getChanges();
        if (empty($changes)) {
            session()->flash('error-message', 'tidak ada perubahan data pada ' .$about->title);
        }else{
            session()->flash('success-message', $about->title . ' berhasil diubah'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function detail($id){
        $detail = AboutModel::find($id);

        $this->id_about = $id;
        $this->publish = $detail->publish;
        $this->path_url = $detail->path_url;
        $this->title = $detail->title;
        $this->short_content = $detail->short_content;
        $this->description = $detail->description;
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

?>