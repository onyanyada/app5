<x-app-layout>
    <div class="p-6 bg-white border-b border-gray-500 font-bold">
        タスク作成
    </div>
    <form action="{{ route('task_store', $selectedFolder) }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="タスクの名前" required>
        <input type="date" name="due_date" required>
        <x-button class="bg-blue-500 rounded-lg">追加</x-button>
    </form>
</x-app-layout>