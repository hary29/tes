<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User as UserModel;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserManage extends Component
{
	use WithFileUploads;
    use WithPagination;

    public $uid, $name, $email, $password, $publish, $publish_label, $role_label, $is_admin, $created_at, $updated_at, $modified_id, $photo;

    public $isDetail = 0;
    public $isModal = 0;

    public function render()
    {
        return view('livewire.userManage.manage', ['user' => UserModel::orderBy('created_at', 'DESC')->paginate(2)]);
    }

    public function detail($id){
        $detail = UserModel::find($id);

        $this->uid = $id;
        $this->photo = $detail->photo();
        $this->name = $detail->name;
        $this->email = $detail->email;
        $this->publish_label = $detail->getPublishLabelAttribute();
        $this->role_label = $detail->getRoleLabelAttribute();
        if ($detail->created_at) {
            $this->created_at = date('d-m-Y h:i:s', strtotime($detail->created_at));
        }
        if ($detail->updated_at) {
            $this->updated_at = date('d-m-Y h:i:s', strtotime($detail->updated_at));
        }
        $this->isDetail = true;
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
        $this->uid = '';
        $this->photo = '';
        $this->name = '';
        $this->email = '';
        $this->publish = '';
        $this->publish_label = '';
        $this->role_label = '';
        $this->is_admin = '';
        $this->created_at = '';
        $this->updated_at = '';
        $this->modified_id = '';
    }

    public function store()
    {
    	$this->validate([
            //'path_url' => 'required|string',
            'email' => 'required|email',
            'name' => 'required|string',
            //'photo' => 'image|max:1024', // 1MB Max
            // 'email' => 'required|email|unique:members,email,' . $this->member_id,
            // 'phone_number' => 'required|numeric',
            // 'status' => 'required'
        ]);

    	$data = UserModel::find($this->uid);
    	$data->is_admin = $this->is_admin;
    	$data->publish = $this->publish;
    	$data->modified_id = request()->user()->id;
    	$data->save();

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        $changes = $data->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data role pada ' .$data->name);
        }else{
	        session()->flash('success-message', 'Role ' .$data->name . ' berhasil diubah'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

    //FUNGSI INI UNTUK MENGHAPUS DATA
    public function delete($id)
    {
        $user = UserModel::find($id);
         //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //LALU HAPUS DATA
        $user->publish = 2;
        $user->modified_id = request()->user()->id;
        $user->save();
        $changes = $user->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data pada ' .$user->name);
        }else{
	        session()->flash('success-message', $user->name . ' berhasil dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function switchPublish($id)
    {
        $user = UserModel::find($id);
        $userPublish = 0;
        if ($user->publish == 1) {
            $user->publish = 2;
        }elseif ($user->publish == 2) {
            $user->publish = 1;
        }
        $user->modified_id = request()->user()->id;

        $user->save();
        $changes = $user->getChanges();
        if (empty($changes)) {
            session()->flash('error-message', 'tidak ada perubahan data pada ' .$user->name);
        }else{
            session()->flash('success-message', $user->name . ' berhasil diubah'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function closeModalDetail()
    {
        $this->isDetail = false;
    }

    public function edit($id)
    {

        $detail = UserModel::find($id);

        $this->uid = $id;
        $this->photo = $detail->photo();
        $this->name = $detail->name;
        $this->email = $detail->email;
        $this->publish = $detail->publish;
        $this->publish_label = $detail->getPublishLabelAttribute();
        $this->role_label = $detail->getRoleLabelAttribute();
        $this->is_admin = $detail->is_admin;
        if ($detail->created_at) {
            $this->created_at = date('d-m-Y h:i:s', strtotime($detail->created_at));
        }
        if ($detail->updated_at) {
            $this->updated_at = date('d-m-Y h:i:s', strtotime($detail->updated_at));
        }

        $this->openModal(); //LALU BUKA MODAL
    }


}
