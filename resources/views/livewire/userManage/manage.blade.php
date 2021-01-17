@section('tittle','User Manage')
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data User
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="">
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

            @if($isDetail)
                @include('livewire.userManage.detail')
            @elseif($isModal)
            	@include('livewire.userManage.edit-role')
            @endif

			<!-- This example requires Tailwind CSS v2.0+ -->
			<div class="flex flex-col">
			  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
			    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
			      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
			        <table class="min-w-full divide-y divide-gray-200">
			          <thead class="bg-gray-50">
			            <tr>
			              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                Name
			              </th>
			              <!-- <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                Title
			              </th> -->
			              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                Status
			              </th>
			              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
			                Role
			              </th>
			              <th scope="col" class="px-6 py-3 text-left text-xs text-center font-medium text-gray-500 uppercase tracking-wider">
			                Action
			              </th>
			            </tr>
			          </thead>
			          <tbody class="bg-white divide-y divide-gray-200">

			          	@forelse($user as $index => $row)
			            <tr>
			              <td class="px-6 py-4 whitespace-nowrap">
			                <div class="flex items-center">
			                  <div class="flex-shrink-0 h-10 w-10">
			                  	<button wire:click="detail({{ $row->id }})">
			                    	<img class="h-10 w-10 rounded-full" src="{{ $row->profile_photo_url }}" alt="">
			                    </button>
			                  </div>
			                  <div class="ml-4">
			                    <div class="text-sm font-medium text-gray-900">
			                      {{ $row->name }}
			                    </div>
			                    <div class="text-sm text-gray-500">
			                      {{ $row->email }}
			                    </div>
			                  </div>
			                </div>
			              </td>
			              <!-- <td class="px-6 py-4 whitespace-nowrap">
			                <div class="text-sm text-gray-900">Regional Paradigm Technician</div>
			                <div class="text-sm text-gray-500">Optimization</div>
			              </td> -->
			              <td class="px-6 py-4 whitespace-nowrap">
			              	<button wire:click="switchPublish({{ $row->id }})">
				                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
				                  {!! $row->publish_label !!}
				                </span>
				            </button>
			              </td>
			              <td class=" text-sm text-gray-500">
			                {!! $row->role_label !!}
			              </td>
			              
			              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button wire:click="edit({{ $row->id }})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit Role</button>
                                <button wire:click="detail({{ $row->id }})" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Detail</button>
                                <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                            </td>
			            </tr>
			            @empty
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium" colspan="5">Tidak ada data</td>
                        </tr>
                    @endforelse
			          </tbody>
			        </table>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>