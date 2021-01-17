<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PageInfo as PageInfoModel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PageInfoManage extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $publish, $Path_photo, $title, $category_page, $description, $id_page_info, $created_id, $modified_id, $publish_label, $created, $modified, $created_date, $modified_date, $createBy, $modifiedBy;
    //public $about;
    public $isModal = 0;
    public $isDetail = 0;


    public $photo;


  	//FUNGSI INI UNTUK ME-LOAD VIEW YANG AKAN MENJADI TAMPILAN HALAMAN MEMBER
    public function render()
    {
    	//dd(request()->user()->currentTeam->id);
        //$this->about = PageInfoModel::where('publish', 1)->orderBy('created_date', 'DESC')->paginate(2);
        //MEMBUAT QUERY UNTUK MENGAMBIL DATA
        return view('livewire.pageInfoManage.manage', ['info' => PageInfoModel::orderBy('created_date', 'DESC')->paginate(2)]); //LOAD VIEW MEMBERS.BLADE.PHP YG ADA DI DALAM FOLDER /RESOURSCES/VIEWS/LIVEWIRE
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
        $this->Path_photo = '';
        $this->title = '';
        $this->category_page = '';
        $this->description = '';
        $this->photo = '';
    }

    //METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA
    public function store()
    {
    	
        //MEMBUAT VALIDASI
        $this->validate([
            //'Path_photo' => 'required|string',
            'title' => 'required|string',
            'category_page' => 'required|string',
            'description' => 'required|string',
          
        ]);

        /* Store $imageName name in DATABASE from HERE */
        if ($this->photo !== null && $this->photo !== '') {

        	$this->validate([
            	'photo' => 'image|max:1024', // 1MB Max
        	]);

	        $imageName = time().'.'.$this->photo->extension();  
	     	//$this->photo->move(public_path('images-upload'), $imageName);
	        $this->photo->storeAs('page-info', $imageName, 'public_content');

	        $this->Path_photo = $imageName;

		}

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        PageInfoModel::updateOrCreate(['id_page_info' => $this->id_page_info], [
            'Path_photo' => $this->Path_photo,
            'publish' => $this->publish,
            'title' => $this->title,
            'category_page' => $this->category_page,
            'description' => $this->description,
            'created_id' => $this->created_id,
            'modified_id' => $this->modified_id,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('success-message', $this->id_page_info ? $this->title . ' Diperbaharui': $this->title . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    //FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID MEMBER
    public function edit($id)
    {

        $info = PageInfoModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_page_info = $id;
        $this->publish = $info->publish;
        $this->Path_photo = $info->Path_photo;
        $this->title = $info->title;
        $this->category_page = $info->category_page;
        $this->description = $info->description;
        $this->created_id = $info->created_id;
        $this->modified_id = request()->user()->id;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $info = PageInfoModel::find($id);
         //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //LALU HAPUS DATA
        $info->publish = 2;
        $info->modified_id = request()->user()->id;
        $info->save();
        $changes = $info->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data pada ' .$info->title);
        }else{
	        session()->flash('success-message', $info->title . ' berhasil dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function switchPublish($id)
    {
        $info = PageInfoModel::find($id);
        $infoPublish = 0;
        if ($info->publish == 1) {
            $info->publish = 2;
        }elseif ($info->publish == 2) {
            $info->publish = 1;
        }
        $info->modified_id = request()->user()->id;

        $info->save();
        $changes = $info->getChanges();
        if (empty($changes)) {
            session()->flash('error-message', 'tidak ada perubahan data pada ' .$info->title);
        }else{
            session()->flash('success-message', $info->title . ' berhasil diubah'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function detail($id){
        $detail = PageInfoModel::find($id);

        $this->id_page_info = $id;
        $this->publish = $detail->publish;
        $this->Path_photo = $detail->Path_photo;
        $this->title = $detail->title;
        $this->category_page = $detail->category_page;
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
