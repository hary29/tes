@section('tittle','Social Media Manage')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Social Media
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

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Social Media</button>
            @if($isDetail)
                @include('livewire.socialMediaManage.detail')
            @elseif($isModal)
                @include('livewire.socialMediaManage.create')
            @endif
            
            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Publish</th>
                        <th class="px-4 py-2">name</th>
                        <th class="px-4 py-2">Url</th>
                        <th class="px-4 py-2">Name Id</th>
                        <th class="px-4 py-2">Icon Class</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($content as $index => $row)
                        <tr>
                            <td class="border px-4 py-2">{{ $index+1 }}</td>
                            <td class="border px-4 py-2"><button wire:click="switchPublish({{ $row->id_social_media }})">{!! $row->publish_label !!}</button></td>
                            <td class="border px-4 py-2">{{ $row->name }}</td>
                            <td class="border px-4 py-2">{{ $row->url }}</td>
                            <td class="border px-4 py-2">{{ $row->name_id }}</td>
                            <td class="border px-4 py-2">{{ $row->icon_class }}</td>
                            <td class="border px-4 py-2 content-center">
                                <button wire:click="edit({{ $row->id_social_media }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-1 rounded">Edit</button>
                                <button wire:click="detail({{ $row->id_social_media }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mb-1 rounded">Detail</button>
                                <button wire:click="delete({{ $row->id_social_media }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mb-1 rounded">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="7">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $content->links() }}
        </div>
    </div>
</div>
