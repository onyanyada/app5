<x-app-layout>

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                タスク編集 - {{ $folder->name }}
            </h2>
        </x-slot>

        <div class="container mx-auto px-4">
            <form action="{{ route('task_update', ['folder' => $folder, 'task' => $task]) }}" method="POST">
                @csrf
                <label for="title">タスク名</label>
                <input type="text" name="title" value="{{ $task->title }}" required>
                
                <label for="due_date">期限</label>
                <input type="date" name="due_date" value="{{ $task->due_date }}" required>
                
                <label for="status">ステータス</label>
                <select name="status">
                    <option value="1" @if($task->status == 1) selected @endif>未完了</option>
                    <option value="2" @if($task->status == 2) selected @endif>完了</option>
                </select>

                <x-button class="bg-blue-500 rounded-lg">更新</x-button>
            </form>
        </div>

</x-app-layout>
