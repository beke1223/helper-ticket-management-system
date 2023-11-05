{{--<x-app-layout>--}}

{{--</x-app-layout>--}}
<!-- <h1>This is comment</h1> -->
<x-app-layout>
    <div class="w-96 m-auto  flex justify-content items-center h-screen">
       
   
           <form method="POST" action="{{ route('ticket.store') }}" class="bg-gray-200 p-12 rounded-xl" enctype="multipart/form-data">
            @csrf
             <h1 class="text-lg font-bold uppercase ml-12">Post Your Ticket Here</h1>
            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input id="title" class="block mt-1 w-full" required  placeholder="Enter Ticket Title here ..." type="text" name="title"    autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />
                <x-textarea id="description" name="description" value=''/>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mt-4 ">
                <x-input-label for="attachment" :value="__('Attachment (if any)')" />
                <x-file-input id="attachment" name="attachment" />
                <x-input-error :messages="$errors->get('attachement')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-primary-button class="ml-3">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>