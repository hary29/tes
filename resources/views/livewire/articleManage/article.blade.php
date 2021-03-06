@section('tittle','Article Manage')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Article
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl overflow-x-auto sm:rounded-lg px-4 py-4">
            @if (session()->has('success-message'))
                <div class="bg-green-200 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('success-message') }}</p>
                        </div>
                    </div>
                </div>
            @elseif (session()->has('error-message'))
            	<div class="bg-red-200 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('error-message') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Article</button>
            @if($isDetail)
                @include('livewire.articleManage.detail')
            @elseif($isModal)
                @include('livewire.articleManage.create')
            @endif
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Publish</th>
                        <th class="px-4 py-2">Foto</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Short Content</th>
                        <th class="px-4 py-2">Discription</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                    <tr class="">
                        <th class="border px-4 py-2"></th>
                        <th class="border px-4 py-2"></th>
                        <th class="border px-4 py-2"></th>
                        <th class="border px-4 py-2"><input type="search" name="searchTitle" placeholder="Search by title" class="bg-white rounded-full text-sm focus:outline-none border-green-500" wire:model="searchTitle"></th>
                        <th class="border px-4 py-2"><input type="search" name="searchContent" placeholder="Search by content" class="bg-white rounded-full text-sm focus:outline-none border-green-500" wire:model="searchContent"></th>
                        <th class="border px-4 py-2"><input type="search" name="searchDescription" placeholder="Search by description" class="bg-white rounded-full text-sm focus:outline-none border-green-500" wire:model="searchDescription"></th>
                        <th class="border px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $pages = request()->get('page');
                    if ($page){
                        $page = ($page-1)*$pagination;
                    }else{
                        $page =  $pages;
                    }
                    @endphp
                    @forelse($article as $index => $row)

                        <tr>
                            <td class="border px-4 py-2">{{ $page+$index+1 }}</td>
                            <td class="border px-4 py-2"><button wire:click="switchPublish({{ $row->id_article }})">{!! $row->publish_label !!}</button></td>

                            <td class="border px-4 py-2 w-3/12">
                                <img src="{{$row->getPhoto()}}" class="object-contain h-48" alt="">
                            </td>
                            <td class="border px-4 py-2">{{ $row->title }}</td>
                            <td class="border px-4 py-2">{!!  $row->short_content !!}</td>
                            <?php $desc = strlen($row->description) > 50 ? substr($row->description,0,50)." ....." : $row->description; ?>
                            <td class="border px-4 py-2">{!! $desc !!}</td>
                            <td class="border px-4 py-2 content-center">
                                <button wire:click="edit({{ $row->id_article }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-1 rounded">Edit</button>
                                <button wire:click="detail({{ $row->id_article }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mb-1 rounded">Detail</button>
                                <button wire:click="delete({{ $row->id_article }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mb-1 rounded">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="7">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $article->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>