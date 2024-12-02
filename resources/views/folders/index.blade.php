<x-app-layout>
            
    <!-- バリデーションエラーの表示に使用-->
    <x-errors id="errors" class="bg-blue-500 rounded-lg">{{$errors}}</x-errors>
    <!-- バリデーションエラーの表示に使用-->
    
    <!--全エリア[START]-->
    <div class="flex bg-gray-100">

            <!--左エリア[START]-->
            <div class="my-10 bg-white w-1/5">
                <div class="p-6 bg-white border-b border-gray-500 font-bold">
                    フォルダ一覧
                </div>
                <x-button class="bg-blue-500 rounded-lg m-2">
                    <a href="{{ route('folder_create') }}">
                        フォルダを作成する
                    </a>
                </x-button>
                <div class="flex-1 text-gray-700 text-left">
                @if (count($folders) > 0)
                    @foreach ($folders as $folder)
                        <x-collection id="{{ $folder->id }}" class="{{ isset($selectedFolder) && $selectedFolder->id == $folder->id ? 'bg-sky-500 text-white' : '' }}">
                            <a href="{{ route('task_index', $folder->id) }}">
                            {{ $folder->name }}
                            </a>
                        </x-collection>
                    @endforeach
                @endif
                </div>
            </div>
            <!--左エリア[END]--> 
    
    
            <!--右側エリア[START]-->
            <div class="w-4/5 m-10 bg-white">
            
                <div class="p-6 border-b border-gray-500 font-bold">
                    @if(isset($selectedFolder))
                        {{ $selectedFolder->name }}のタスク一覧
                    @else
                        タスク
                    @endif
                </div>
            
                <div class="m-2">
                    @if(isset($selectedFolder))
                        <x-button class="bg-blue-500 rounded-lg m-2">
                            <a href="{{ route('task_create',['folder' => $selectedFolder]) }}">
                                タスクを作成する
                            </a>
                        </x-button>
                        @if ($tasks->count() > 0)
                            <table>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>({{ $task->due_date }})</td>
                                        <td>@if($task->status == 1)未完@endif</td>
                                        <td><a href="{{ route('task_edit', ['folder' => $selectedFolder, 'task' => $task]) }}">編集</a></td>
                                        <td>
                                        <form action="{{ route('task_destroy', ['folder' => $selectedFolder, 'task' => $task]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            削除
                                        </form>
                                        </td>

                                        {{-- <option value="1" @if($task->status == 1) selected @endif>未完了</option> --}}

                                        

                                    </tr>
                                @endforeach
                            </ｔ>
                        @else
                            <p>タスクがありません</p>
                        @endif
                    @else
                        <p>フォルダを選択してください。</p>
                    @endif
                </div>
            </div>
    <!--全エリア[END]-->

    </x-app-layout>
