<?php

namespace App\Http\Livewire;

use App\Models\VideoContent as VCModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class VideoContentManage extends Component
{
	use WithFileUploads;
    use WithPagination;
	public $id_video_content, $publish, $name, $url_video, $short_description, $description, $created_id, $modified_id, $publish_label, $created, $modified, $created_date, $modified_date, $createBy, $modifiedBy;
	public $isModal = 0;
    public $isDetail = 0;

    public function render()
    {
        return view('livewire.videoContentManage.manage', ['content' => VCModel::orderBy('created_date', 'DESC')->paginate(2)]);
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
        $this->url_video = '';
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
            'url_video' => 'required|url',
            'description' => 'required|string',
            //'photo' => 'image|max:1024', // 1MB Max
            // 'email' => 'required|email|unique:members,email,' . $this->member_id,
            // 'phone_number' => 'required|numeric',
            // 'status' => 'required'
        ]);

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        VCModel::updateOrCreate(['id_video_content' => $this->id_video_content], [
            'publish' => $this->publish,
            'name' => $this->name,
            'url_video' => $this->url_video,
            'description' => $this->description,
            'created_id' => $this->created_id,
            'modified_id' => $this->modified_id,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('success-message', $this->id_video_content ? $this->name . ' Diperbaharui': $this->name . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

     public function edit($id)
    {

        $vcontent = VCModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_video_content = $id;
        $this->publish = $vcontent->publish;
        $this->name = $vcontent->name;
        $this->url_video = $vcontent->url_video;
        $this->description = $vcontent->description;
        $this->created_id = $vcontent->created_id;
        $this->modified_id = request()->user()->id;

        $this->openModal(); //LALU BUKA MODAL
    }

    public function delete($id)
    {
        $vcontent = VCModel::find($id);
         //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //LALU HAPUS DATA
        $vcontent->publish = 2;
        $vcontent->modified_id = request()->user()->id;
        $vcontent->save();
        $changes = $vcontent->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data pada ' .$vcontent->name);
        }else{
	        session()->flash('success-message', $vcontent->name . ' berhasil dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function switchPublish($id)
    {
        $vcontent = VCModel::find($id);
        $vcontentPublish = 0;
        if ($vcontent->publish == 1) {
            $vcontent->publish = 2;
        }elseif ($vcontent->publish == 2) {
            $vcontent->publish = 1;
        }
        $vcontent->modified_id = request()->user()->id;

        $vcontent->save();
        $changes = $vcontent->getChanges();
        if (empty($changes)) {
            session()->flash('error-message', 'tidak ada perubahan data pada ' .$vcontent->name);
        }else{
            session()->flash('success-message', $vcontent->name . ' berhasil diubah'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function detail($id){
        $vcontent = VCModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_video_content = $id;
        $this->publish = $vcontent->getPublishLabelAttribute();
        $this->name = $vcontent->name;
        $this->url_video = $vcontent->url_video;
        $this->description = $vcontent->description;
        $this->created_id = $vcontent->created_id;
        $this->modified_id = request()->user()->id;

        
        if ($vcontent->created_id) {
            $this->createBy = $vcontent->userCreated->name;
        }
        if ($vcontent->modified_id) {
            $this->modifiedBy = $vcontent->userModified->name;
        }
        if ($vcontent->created_date) {
            $this->created_date = date('d-m-Y h:i:s', strtotime($vcontent->created_date));
        }
        if ($vcontent->modified_date) {
            $this->modified_date = date('d-m-Y h:i:s', strtotime($vcontent->modified_date));
        }
        $this->isDetail = true;

        //$this->openModal();
    }

    public function closeModalDetail()
    {
        $this->isDetail = false;
    }
}
