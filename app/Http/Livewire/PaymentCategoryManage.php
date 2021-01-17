<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PaymentCategory as PaymentCategoryModel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PaymentCategoryManage extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $publish, $path_photo, $title, $path_logo, $description, $id_payment_category, $created_id, $modified_id, $publish_label, $created, $modified, $created_date, $modified_date, $createBy, $modifiedBy;
    //public $about;
    public $isModal = 0;
    public $isDetail = 0;


    public $photo, $logo;


  	//FUNGSI INI UNTUK ME-LOAD VIEW YANG AKAN MENJADI TAMPILAN HALAMAN MEMBER
    public function render()
    {
    	//dd(request()->user()->currentTeam->id);
        //$this->about = PaymentCategoryModel::where('publish', 1)->orderBy('created_date', 'DESC')->paginate(2);
        //MEMBUAT QUERY UNTUK MENGAMBIL DATA
        return view('livewire.paymentCategoryManage.manage', ['data' => PaymentCategoryModel::orderBy('created_date', 'DESC')->paginate(2)]); //LOAD VIEW MEMBERS.BLADE.PHP YG ADA DI DALAM FOLDER /RESOURSCES/VIEWS/LIVEWIRE
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
        $this->path_photo = '';
        $this->title = '';
        $this->path_logo = '';
        $this->description = '';
        $this->photo = '';
    }

    //METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA
    public function store()
    {
    	
        //MEMBUAT VALIDASI
        $this->validate([
            //'path_photo' => 'required|string',
            'title' => 'required|string',
            'path_logo' => 'required|string',
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

	        $this->path_photo = $imageName;

		}

		if ($this->logo !== null && $this->logo !== '') {

        	$this->validate([
            	'photo' => 'image|max:1024', // 1MB Max
        	]);

	        $imageNameLogo = time().'.'.$this->logo->extension();  
	     	//$this->photo->move(public_path('images-upload'), $imageName);
	        $this->logo->storeAs('images-upload-about', $imageNameLogo, 'public_uploads');

	        $this->path_logo = $imageNameLogo;

		}

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        PaymentCategoryModel::updateOrCreate(['id_payment_category' => $this->id_payment_category], [
            'path_photo' => $this->path_photo,
            'publish' => $this->publish,
            'title' => $this->title,
            'path_logo' => $this->path_logo,
            'description' => $this->description,
            'created_id' => $this->created_id,
            'modified_id' => $this->modified_id,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('success-message', $this->id_payment_category ? $this->title . ' Diperbaharui': $this->title . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    //FUNGSI INI UNTUK MENGAMBIL DATA DARI DATABASE BERDASARKAN ID MEMBER
    public function edit($id)
    {

        $about = PaymentCategoryModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_payment_category = $id;
        $this->publish = $about->publish;
        $this->path_photo = $about->path_photo;
        $this->title = $about->title;
        $this->path_logo = $about->path_logo;
        $this->description = $about->description;
        $this->created_id = $about->created_id;
        $this->modified_id = request()->user()->id;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $about = PaymentCategoryModel::find($id);
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
        $about = PaymentCategoryModel::find($id);
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
        $detail = PaymentCategoryModel::find($id);

        $this->id_payment_category = $id;
        $this->publish = $detail->publish;
        $this->path_photo = $detail->path_photo;
        $this->title = $detail->title;
        $this->path_logo = $detail->getLogoPayment();
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
