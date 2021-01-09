<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\About as AboutModel;
use Livewire\WithFileUploads;

class About extends Component
{
    public $publish, $path_url, $title, $short_content, $description, $id_about;
    //public $about;
    public $isModal = 0;

    use WithFileUploads;

    public $photo;


  	//FUNGSI INI UNTUK ME-LOAD VIEW YANG AKAN MENJADI TAMPILAN HALAMAN MEMBER
    public function render()
    {
        //$this->about = AboutModel::where('publish', 1)->orderBy('created_date', 'DESC')->paginate(2);
        //MEMBUAT QUERY UNTUK MENGAMBIL DATA
        return view('livewire.aboutManage.about', ['about' => AboutModel::orderBy('created_date', 'DESC')->paginate(2)]); //LOAD VIEW MEMBERS.BLADE.PHP YG ADA DI DALAM FOLDER /RESOURSCES/VIEWS/LIVEWIRE
    }

    //FUNGSI INI AKAN DIPANGGIL KETIKA TOMBOL TAMBAH ANGGOTA DITEKAN
    public function create()
    {
        //KEMUDIAN DI DALAMNYA KITA MENJALANKAN FUNGSI UNTUK MENGOSONGKAN FIELD
        $this->resetFields();
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
        
        if ($this->photo !== null && $this->photo !== '') {

        	$this->validate([
            	'photo' => 'image|max:1024', // 1MB Max
        	]);

	        $imageName = time().'.'.$this->photo->extension();  
	     	//$this->photo->move(public_path('images-upload'), $imageName);
	        $this->photo->storeAs('images-upload-about', $imageName, 'public_uploads');

	        $this->path_url = $imageName;

		}
  
        /* Store $imageName name in DATABASE from HERE */

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        AboutModel::updateOrCreate(['id_about' => $this->id_about], [
            'path_url' => $this->path_url,
            'title' => $this->title,
            'short_content' => $this->short_content,
            'description' => $this->description,
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

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $about = AboutModel::find($id);
         //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //LALU HAPUS DATA
        $about->publish = 2;
        $about->save();
        $changes = $about->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data pada ' .$about->title);
        }else{
	        session()->flash('success-message', $about->title . ' berhasil dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }
}

?>