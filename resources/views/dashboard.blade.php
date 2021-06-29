<x-app-layout>
    <x-table2-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <div class="p-5 pt-0 max max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <h1 class="text-3xl font-black">
                        Welcome To your Password Storage
                    </h1>
                    <p class="font-light">_Where you can memorise all your accounts throught Internet</p>
                </div>
            </div>
        </div>

        <div class="grid grid-flow-row grid-cols-2 grid-rows-2 gap-4 ">
            <a href="{{ route('social.add') }}" class="cursor-pointer text-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Add Platform
            </a>
            <a href="{{ route('social.all') }}" class="cursor-pointer text-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Show/Edit Platform
            </a>
            <a href="{{ route('account.add') }}" class="cursor-pointer text-center bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                Add Account
            </a>
            <a href="{{ route('account.show') }}" class="cursor-pointer text-center bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded">
                Show/Edit Account
            </a>
              
        </div>

    </x-table2-card>


</x-app-layout>

    


