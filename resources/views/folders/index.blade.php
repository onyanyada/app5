<x-app-layout>
            
    <!-- バリデーションエラーの表示に使用-->
    <x-errors id="errors" class="bg-blue-500 rounded-lg">{{$errors}}</x-errors>
    <!-- バリデーションエラーの表示に使用-->
    
    <!--全エリア[START]-->
    <div class="flex bg-gray-100">
        

            <!--左エリア[START]-->
            <div class="bg-blue-100 m-10">
                <div class="p-6 bg-white border-b border-gray-500 font-bold">
                    フォルダ一覧
                </div>
                <x-button class="bg-blue-500 rounded-lg m-2">
                    <a href="{{ route('folder_create') }}">
                        フォルダを作成する
                    </a>
                </x-button>
                <div class="flex-1 text-gray-700 text-left px-4 py-2 m-2">
                @if (count($folders) > 0)
                    @foreach ($folders as $folder)
                        <x-collection id="{{ $folder->id }}">
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
            <div class="bg-gray-100  m-10">
            
                <div class="p-6 bg-white border-b border-gray-500 font-bold">
                    @if(isset($selectedFolder))
                        {{ $selectedFolder->name }}のタスク一覧
                    @else
                        タスク
                    @endif
                </div>
            
                <div>
                    @if(isset($selectedFolder))
                        <x-button class="bg-blue-500 rounded-lg">
                            <a href="{{ route('task_create',['folder' => $selectedFolder]) }}">
                                タスクを作成する
                            </a>
                        </x-button>
                        @if ($tasks->count() > 0)
                            <ul>
                                @foreach ($tasks as $task)
                                    <li>
                                        {{ $task->title }} ({{ $task->due_date }})
                                        <a href="{{ route('task_edit', ['folder' => $selectedFolder, 'task' => $task]) }}">編集</a>
                                        <form action="{{ route('task_destroy', ['folder' => $selectedFolder, 'task' => $task]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            削除
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
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
