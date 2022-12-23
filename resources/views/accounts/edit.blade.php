<x-app-layout>
    @if (session('alert'))
      <div id="hide-alert" class="bg-green-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">{{ session('alert') }}</strong>
          <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
          </span>
      </div>
      @endif
  
      @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
          <strong class="font-bold">{{ session('error') }}</strong>
          <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
          </span>
      </div>
      @endif
      
      <x-auth-card>
          <x-slot name="logo">
              <a href="/">
                  <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
              </a>
          </x-slot>
  
          <!-- Validation Errors -->
          <x-auth-validation-errors class="mb-4" :errors="$errors" />
  
          <form method="POST" action="{{ route('account.update') }}">
              @csrf
              <input type="hidden" name="id"  value="{{ $account->id }}">
              <!-- Platform -->
              <div class="mt-4">
                  <x-label for="myInput" :value="__('Platform')" />
                    
                  <input type="text"  placeholder="Search.." id="myInput" autocomplete="off" value="{{ $account->social()->first()->name }}" disabled class="bg-gray-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
              </div>
  
              <!-- Email Address -->
              <div class="mt-4">
                  <x-label for="email" :value="__('Email / User name')" />
  
                  <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" value="{{ $account->name }}" required />
              </div>
  
              <!-- Password -->
              <div class="mt-4">
                  <x-label for="password" :value="__('Current Password')" />
  
                  <x-input id="password" class="block mt-1 w-full"
                                  type="text"
                                  name="password"
                                  value="{{ $account->password }}"
                                  required autocomplete="new-password" />
              </div>

              <!-- Details -->
              <div class="mt-4">
                <x-label for="detail" :value="__('Details')" />
  
                <x-input id="detail" class="block mt-1 w-full" type="text" value="{{ $account->details }}" name="details" required />
              </div>

              <!-- Old Passwords -->
              <div class="mt-4">
                <x-label for="details" :value="__('Old Passwords')" />
                <textarea id="details" disabled class="bg-gray-100 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">{{ $account->old_passwords }}</textarea>
              </div>
  
              <div class="flex items-center justify-end mt-4">
                  <x-button class="ml-4">
                      {{ __('Update') }}
                  </x-button>
              </div>
          </form>

      </x-auth-card>
  </x-app-layout>

  <style>
      #hide-alert {
          display: none;
      }

      .show {
          display: block;
          transition: 0.5s;
      }

      .hide {
            display: none;
            transition: 0.5s;
      }

    textarea {
        resize: none;
    }

  </style>
  <script>

    var element = document.getElementById('hide-alert');
    element.classList.add('show');
    setTimeout(function(){
        element.classList.add('hide');
    }, 2000);//wait 2 seconds

  </script>
  
