<x-app-layout>    
    <x-table-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
            <!-- Details about user-->
            <div class="rounded overflow-hidden shadow-lg">
                <!-- <img class="w-full" src="/mountain.jpg" alt="Mountain"> -->
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $user->name }}</div>
                    <p class="text-gray-700 text-base">
                        <span>email: </span>
                        <span>{{ $user->email }}</span>
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <p class="text-gray-700 text-base">Platforms that I use:</p>
                    <span class="inline-block bg-red-200 px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ count($socials) }}</span>
                    @foreach ($socials as $social)
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $social->name }}</span>
                    @endforeach
                </div>
            </div>
            <!--Card 2-->
            <div class="rounded overflow-hidden shadow-lg">
            <img class="w-full" src="/river.jpg" alt="River">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">River</div>
                <p class="text-gray-700 text-base">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#summer</span>
            </div>
            </div>

        </div>
    </x-table-card>

</x-app-layout> 