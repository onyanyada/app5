<x-app-layout>
    <div class="p-6 bg-white border-b border-gray-500 font-bold">
        フォルダ作成
    </div>
    <div class="text-gray-700 text-left px-4 py-4 m-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-500 font-bold">
                フォルダ作成
            </div>
        </div>
        <form action="{{ url('folders') }}" method="POST" class="w-full max-w-lg">
            @csrf
            <div class="flex flex-col px-2 py-2">
                <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        Folder Name
                    </label>
                    <input name="name" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                </div>
            </div>
            <div class="flex flex-col">
                <div class="text-gray-700 text-center px-4 py-2 m-2">
                    <x-button class="bg-blue-500 rounded-lg">送信</x-button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
