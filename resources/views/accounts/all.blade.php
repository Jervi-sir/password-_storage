<x-app-layout>

    @if (session('alert'))
    <div class="bg-green-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
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

    <x-table-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="flex justify-center items-center">
            <div x-data="setup()" class="w-full">
                <ul class="flex justify-center items-center flex-wrap my-4">
                    <template x-for="(tab, index) in tabs" :key="index">
                        <li class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
                            :class="activeTab===index ? 'text-green-500 border-green-500' : ''" @click="getSocial(tab, index)">
                            <a href="#result" x-text="tabs[index]"></a>
                        </li>
                    </template>
                </ul>
                <div class="bg-white text-center mx-auto border overflow-x-scroll">
                    <div class="d-flex">
                        <div class="which-social">
                            <span id="result" x-text='selected_social'></ id="result">
                        </div>
                        <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap mb-10">
                            <thead>
                                <tr class="text-center font-bold">
                                    <td class="border px-6 py-4">Email</td>
                                    <td class="border px-6 py-4">Password</td>
                                    <td class="border px-6 py-4">Old Password</td>
                                    <td class="border px-6 py-4">Details</td>
                                    <td class="border px-6 py-4">Action</td>
                                </tr>
                            </thead>
                            <template x-for="(account, index) in selected_accounts">
                                <tr>
                                    <td class="border px-6 py-4 cursor-pointer" @click="copy(event)" x-text="account.email"></td>
                                    <td class="border px-6 py-4 cursor-pointer" @click="copy(event)" x-text="account.password"></td>
                                    <td class="border px-6 py-4 w-64">
                                        <div class="module fade">
                                            <p x-text="account.old_passwords"></p>
                                        </div>
                                    </td>
                                    <td class="border px-6 py-4"  x-text="account.details"></td>
                                    <td class="border px-6 py-4 w-1">
                                        <div class="inline-flex ">
                                        <form action="{{ route('account.edit') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" :value="account.id">
                                            <button class="bg-gradient-to-r from-green-400 to-purple-400 text-green-800 hover:text-red-800 font-bold py-2 px-4 rounded-l border-b-4 border-pink-700">
                                            Edit
                                            </button>
                                        </form>

                                        <button @click="openDeleteModal(index)" class="openmodal myBtn bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 text-gray-800 hover:text-red-800 font-bold py-2 px-4 rounded-r border-b-4 border-green-700">
                                            Delete
                                        </button>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                            <!-- The Modal -->
                            <div id="myModal" class="modal" x-show="modal.show">
                                <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                        <div @click="closeDeleteModal"  class="overlay fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                        <div class="myModal inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                <div class="sm:flex sm:items-start">
                                                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                        </svg>
                                                    </div>
                                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                        Delete
                                                        <span x-text="modal.email" class="red"></span>
                                                            account
                                                        </h3>
                                                        <div class="mt-2">
                                                        <p class="text-sm text-gray-500">
                                                            Are you sure you want to delete this account details? This action cannot be undone.
                                                        </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <form action="{{ route('account.delete') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" :value='modal.id'>
                                                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Delete
                                                    </button>
                                                </form>
                                                <button @click="closeDeleteModal" type="button" class="close mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </table>
                    </div>
                </div>

            </div>
        </div>


    <script>
        var modals = document.getElementsByClassName('modal');
        // Get the button that opens the modal
        var btns = document.getElementsByClassName("openmodal");
        var spans=document.getElementsByClassName("close");
        var overlays=document.getElementsByClassName("overlay");

    </script>


    </x-table-card>
</x-app-layout>

<style>
    .red {
        color: red;
    }

    .copied-run {
        color:red;
        transform: scale(1.2);
        transition: 0.2s;
    }

    .copied-stop {
        color:black;
        transform: scale(1);
        transition: 0.2s;
    }
    .module {
        height: 25px;
        overflow: hidden;
    }
    .module p {
        margin: 0;
    }
    .fade {
        position: relative;
    }
    .fade:after {
        content: "";
        text-align: right;
        position: absolute;
        bottom: 0;
        right: 0;
        width: 50%;
        height: 1.2em;
        background: linear-gradient(to right, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1) 50%);
    }

    /* The Modal (background) */
    .modal {
        display: block; /* Hidden by defaultf */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    @media only screen and (max-width: 600px){
        .myModal {
            transform: translateY(-100%);
        }

    }

</style>


<script>

    var array = {!! json_encode($platforms, JSON_HEX_TAG) !!};
    var sorted_social = array.sort(function(a, b) {
                            return a === b ? 0 : a < b ? -1 : 1;
                        });

    var accounts = {!! json_encode($accounts, JSON_HEX_TAG) !!};

    function setup() {
        return {
            activeTab: 0,
            showModal: false,
            tabs: sorted_social,
            selected_social: '',
            modal: {
                show: false,
                id: '',
                email: '',
            },
            modalAccountId: '',
            selected_accounts: [],

            init() {
                this.selected_accounts = accounts[sorted_social[0]];
                this.selected_social = sorted_social[0];
            },

            getSocial(platform, index) {
                this.activeTab = index;
                this.selected_social = sorted_social[index];
                this.selected_accounts = accounts[platform];
            },

            copy(event) {
                let obj = event.target;
                navigator.clipboard.writeText(obj.innerText);
                obj.classList.add('copied-run');
                setTimeout(function(){
                    obj.classList.remove('copied-run');
                }, 1000); // wait

            },

            openDeleteModal(index) {
                var account = this.selected_accounts[index];

                this.modal.show = true;
                this.modal.id = account.id;
                this.modal.email = account.email;
            },

            closeDeleteModal() {
                this.modal.show = false;
                this.modal.id = account.id;
                this.modal.email = account.email;
            }
        };
    };


</script>



