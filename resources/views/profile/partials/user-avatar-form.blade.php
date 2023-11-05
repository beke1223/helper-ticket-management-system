<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            User Avatar
        </h2>


        <img width="50" height="50" class="rounded-full" src="{{"/storage/$user->avatar"}}" alt="profile avatar">


        <form action="{{route('profile.avatar.ai')}}" method="get">
            @csrf
           
              <p class="mt-1 text-sm text-gray-600">
          Generate Avatar From Ai
        </p>
        <x-primary-button>Generate Avatar</x-primary-button>
  
        </form>


      
    </header>
    <p class="mt-1 text-sm text-gray-600">
          Or
        </p>
    
    
<form action="{{route('profile.avatar')}}" method="post" enctype='multipart/form-data'> 
    @if (session('message'))
         <div class="text-red-500">
            {{session('message')}}
         </div>
         @endif
@csrf
@method("patch")

        <div>  
            <x-input-label for="Avatar" value="Upload Avatar From Computer" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->Avatar)"  autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
           
        </div>
        

        

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
  
        </div>
    </form>
    
</section>
