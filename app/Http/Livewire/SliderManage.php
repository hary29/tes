<?php

namespace App\Http\Livewire;

use App\Models\Slider as SliderModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SliderManage extends Component
{
	use WithFileUploads;
    use WithPagination;
    public $publish, $path_url, $title, $description, $id_slider, $created_id, $modified_id, $publish_label, $created, $modified, $created_date, $modified_date, $createBy, $modifiedBy;
    //public $slider;
    public $isModal = 0;
    public $isDetail = 0;


    public $photo; 

    public function render()
    {
        return view('livewire.sliderHome.manage', ['slider' => SliderModel::orderBy('created_date', 'DESC')->paginate(2)]);
    }

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
        $this->description = '';
        $this->photo = '';
    }

    public function store()
    {
    	
        //MEMBUAT VALIDASI
        $this->validate([
            //'path_url' => 'required|string',
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        /* Store $imageName name in DATABASE from HERE */
        if ($this->photo !== null && $this->photo !== '') {

        	$this->validate([
            	'photo' => 'image|max:1024', // 1MB Max
        	]);

	        $imageName = time().'.'.$this->photo->extension();  
	     	//$this->photo->move(public_path('images-upload'), $imageName);
	        $this->photo->storeAs('slider', $imageName, 'public_content');

	        $this->path_url = $imageName;

		}

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        SliderModel::updateOrCreate(['id_slider' => $this->id_slider], [
            'path_url' => $this->path_url,
            'publish' => $this->publish,
            'title' => $this->title,
            'description' => $this->description,
            'created_id' => $this->created_id,
            'modified_id' => $this->modified_id,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('success-message', $this->id_slider ? $this->title . ' Diperbaharui': $this->title . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    public function edit($id)
    {

        $slider = SliderModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_slider = $id;
        $this->publish = $slider->publish;
        $this->path_url = $slider->path_url;
        $this->title = $slider->title;
        $this->short_content = $slider->short_content;
        $this->description = $slider->description;
        $this->created_id = $slider->created_id;
        $this->modified_id = request()->user()->id;

        $this->openModal(); //LALU BUKA MODAL
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $slider = SliderModel::find($id);
         //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //LALU HAPUS DATA
        $slider->publish = 2;
        $slider->modified_id = request()->user()->id;
        $slider->save();
        $changes = $slider->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data pada ' .$slider->title);
        }else{
	        session()->flash('success-message', $slider->title . ' berhasil dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function switchPublish($id)
    {
        $slider = SliderModel::find($id);
        $sliderPublish = 0;
        if ($slider->publish == 1) {
            $slider->publish = 2;
        }elseif ($slider->publish == 2) {
            $slider->publish = 1;
        }
        $slider->modified_id = request()->user()->id;

        $slider->save();
        $changes = $slider->getChanges();
        if (empty($changes)) {
            session()->flash('error-message', 'tidak ada perubahan data pada ' .$slider->title);
        }else{
            session()->flash('success-message', $slider->title . ' berhasil diubah'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function detail($id){
        $detail = SliderModel::find($id);

        $this->id_about = $id;
        $this->publish = $detail->publish;
        $this->path_url = $detail->path_url;
        $this->title = $detail->title;
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
