@section('tittle','About Manage')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data About
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

            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah About</button>
            
            @if($isDetail)
                @include('livewire.aboutManage.detail')
            @elseif($isModal)
                @include('livewire.aboutManage.create')
            @endif


            <table class="table-auto w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">No</th>
                        <th class="px-4 py-2">Publish</th>
                        <th class="px-4 py-2">Photo</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Short Content</th>
                        <th class="px-4 py-2">Discription</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($about as $index => $row)
                        <tr>
                            <td class="border px-4 py-2">{{ $index+1 }}</td>
                            <td class="border px-4 py-2"><button wire:click="switchPublish({{ $row->id_about }})">{!! $row->publish_label !!}</button></td>

                            <td class="border px-4 py-2 w-3/12">
                                <img src="{{$row->getPhoto()}}" class="object-contain h-48" alt="">
                            </td>
                            <td class="border px-4 py-2">{{ $row->title }}</td>
                            <td class="border px-4 py-2">{!!  $row->short_content !!}</td>
                            <td class="border px-4 py-2">{!! $row->description !!}</td>
                            <td class="border px-4 py-2 content-center">
                                <button wire:click="edit({{ $row->id_about }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mb-1 rounded">Edit</button>
                                <button wire:click="detail({{ $row->id_about }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 mb-1 rounded">Detail</button>
                                <button wire:click="delete({{ $row->id_about }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mb-1 rounded">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="border px-4 py-2 text-center" colspan="7">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $about->links() }}
        </div>
    </div>
</div>
