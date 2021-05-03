<?php

namespace App\Http\Livewire;

use App\Models\Article as ArticleModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ArticleManage extends Component
{
	use WithFileUploads;
    use WithPagination;
	public $id_article, $publish, $photo, $path_photo, $title, $short_description, $description, $created_id, $modified_id, $publish_label, $created, $modified, $created_date, $modified_date, $createBy, $modifiedBy, $oldPublishdate, $publish_date;
    public $searchTitle, $searchContent, $searchDescription;
	public $isModal = 0;
    public $isDetail = 0;
    public $pagination;

    public function render()
    {
        $this->pagination = 2; 
        $article = ArticleModel::orderBy('created_date', 'DESC');

        if ($this->searchTitle !== null) {
            $searchTermTitle = '%'.$this->searchTitle.'%';
            $article = $article->where('title','like', $searchTermTitle );
        }

        if ($this->searchContent !== null) {
            $searchTermContent = '%'.$this->searchContent.'%';
            $article = $article->where('short_description','like', $searchTermContent );
        }

        if ($this->searchDescription !== null) {
            $searchTermDes = '%'.$this->searchDescription.'%';
            $article = $article->where('description','like', $searchTermDes );
        }

        $article = $article->paginate($this->pagination);

        return view('livewire.articleManage.article', ['article' =>$article]);
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
        $this->path_photo = '';
        $this->title = '';
        $this->short_description = '';
        $this->description = '';
        $this->publish_date = '';
        $this->oldPublishdate = '';
        $this->photo = '';
    }

    public function closeModal()
    {
        $this->isModal = false;
        $this->resetValidation();
    }

    //METHOD STORE AKAN MENG-HANDLE FUNGSI UNTUK MENYIMPAN / UPDATE DATA
    public function store()
    {
    	
        //MEMBUAT VALIDASI
        $this->validate([
            //'path_photo' => 'required|string',
            'title' => 'required|string',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'publish_date' => 'date',
            //'photo' => 'image|max:1024', // 1MB Max
            // 'email' => 'required|email|unique:members,email,' . $this->member_id,
            // 'phone_number' => 'required|numeric',
            // 'status' => 'required'
        ]);

        /* Store $imageName name in DATABASE from HERE */
        if(!$this->id_article){
            if ($this->photo !== null && $this->photo !== '') {

                $this->validate([
                    'photo' => 'image|max:1024', // 1MB Max
                ]);

                $imageName = time().'.'.$this->photo->extension();  
                //$this->photo->move(public_path('images-upload'), $imageName);
                $this->photo->storeAs('images-upload-article', $imageName, 'public_uploads');

                $this->path_photo = $imageName;

            }
        }

        if ($this->oldPublishdate != $this->publish_date) {
            $this->publish_date = $this->publish_date;
        }elseif ($this->publish_date == '') {
           $this->publish_date = date("Y/m/d");
        }
        else{
            $this->publish_date = $this->oldPublishdate;
        }

        //QUERY UNTUK MENYIMPAN / MEMPERBAHARUI DATA MENGGUNAKAN UPDATEORCREATE
        //DIMANA ID MENJADI UNIQUE ID, JIKA IDNYA TERSEDIA, MAKA UPDATE DATANYA
        //JIKA TIDAK, MAKA TAMBAHKAN DATA BARU
        ArticleModel::updateOrCreate(['id_article' => $this->id_article], [
            'path_photo' => $this->path_photo,
            'publish' => $this->publish,
            'publish_date' => $this->publish_date,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'created_id' => $this->created_id,
            'modified_id' => $this->modified_id,
        ]);

        //BUAT FLASH SESSION UNTUK MENAMPILKAN ALERT NOTIFIKASI
        session()->flash('success-message', $this->id_article ? $this->title . ' Diperbaharui': $this->title . ' Ditambahkan');
        $this->closeModal(); //TUTUP MODAL
        $this->resetFields(); //DAN BERSIHKAN FIELD
    }

     public function edit($id)
    {

        $article = ArticleModel::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->id_article = $id;
        $this->publish = $article->publish;
        $this->publish_date = $article->publish_date;
        $this->oldPublishdate = $article->publish_date;
        $this->path_photo = $article->path_photo;
        $this->title = $article->title;
        $this->short_description = $article->short_description;
        $this->description = $article->description;
        $this->created_id = $article->created_id;
        $this->photo = $article->getPhoto();
        $this->modified_id = request()->user()->id;

        $this->openModal(); //LALU BUKA MODAL
    }

    public function delete($id)
    {
        $article = ArticleModel::find($id);
         //BUAT QUERY UNTUK MENGAMBIL DATA BERDASARKAN ID
        //LALU HAPUS DATA
        $article->publish = 2;
        $article->modified_id = request()->user()->id;
        $article->save();
        $changes = $article->getChanges();
        if (empty($changes)) {
        	session()->flash('error-message', 'tidak ada perubahan data pada ' .$article->title);
        }else{
	        session()->flash('success-message', $article->title . ' berhasil dihapus'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function switchPublish($id)
    {
        $article = ArticleModel::find($id);
        $articlePublish = 0;
        if ($article->publish == 1) {
            $article->publish = 2;
        }elseif ($article->publish == 2) {
            $article->publish = 1;
        }
        $article->modified_id = request()->user()->id;

        $article->save();
        $changes = $article->getChanges();
        if (empty($changes)) {
            session()->flash('error-message', 'tidak ada perubahan data pada ' .$article->title);
        }else{
            session()->flash('success-message', $article->title . ' berhasil diubah'); //DAN BUAT FLASH MESSAGE UNTUK NOTIFIKASI
        }

    }

    public function detail($id){
        $detail = ArticleModel::find($id);

        $this->id_article = $id;
        $this->publish = $detail->publish;
        $this->publish_date = $detail->publish_date;
        $this->path_photo = $detail->path_photo;
        $this->title = $detail->title;
        $this->short_description = $detail->short_description;
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
