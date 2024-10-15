  <!-- 本: 削除ボタン -->
<div class="flex justify-between p-4 items-center border-2">
  <div>{{ $slot }}</div>
  
    <div>
    <form action="{{ url('foldersedit/'.$id) }}" method="POST">
         @csrf
         
        <button type="submit"  class="btn text-blue">
            更新
        </button>
        
     </form>
  </div>
  
  <div>
    <form action="{{ url('folder/'.$id) }}" method="POST">
         @csrf
         @method('DELETE')
        
        <button type="submit"  class="btn ">
            削除
        </button>
        
     </form>
  </div>

</div>