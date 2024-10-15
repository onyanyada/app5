<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $folder->name }}のタスク一覧
        </h2>
    </x-slot>

    <!-- タスク一覧表示 -->
    <div class="container mx-auto px-4">
        <h3 class="font-semibold text-lg">タスクを追加</h3>
        <form action="{{ route('task_store', $folder) }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="タスクの名前" required>
            <input type="date" name="due_date" required>
            <x-button class="bg-blue-500 rounded-lg">追加</x-button>
        </form>

        <h3 class="font-semibold text-lg mt-6">タスク一覧</h3>
        @if ($tasks->count() > 0)
            <ul>
                @foreach ($tasks as $task)
                    <li>
                        {{ $task->title }} ({{ $task->due_date }})
                        <a href="{{ route('task_edit', ['folder' => $folder, 'task' => $task]) }}">編集</a>
                        <form action="{{ route('task_destroy', ['folder' => $folder, 'task' => $task]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button class="bg-red-500 rounded-lg">削除</x-button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @else
            <p>タスクがありません</p>
        @endif
    </div>
</x-app-layout>
