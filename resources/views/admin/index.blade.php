@extends('admin.layouts.app')

@section('content')
<div class="row">
    @include('admin.sidebar')
    <div class="col">
        <form method="post" action="{{ route('admin.sort') }}">
            @csrf
            <button class="tr-4">送信</button>
            <div class="card mt-4 mr-4">
                <table class="table">
                    <thead class="black white-text">
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">タイトル</th>
                            <th scope="col">本文</th>
                            <th scope="col">画像</th>
                            <th scope="col">日付</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach($posts as $post) 
                        <!-- [0 => 1, 1 => 2, 2 => 3 ・・・・] -->
                            <tr id="{{ $post->id }}">
                            <input type="hidden" name="new_ids[]"><!-- ここを動的に -->
                                <th scope>{{ $post->id }}</th>
                                <td>
                                    {{ $post->title }}
                                </td>
                                <td>
                                    {{ $post->body }}
                                </td>
                                <td>
                                    <img src="data:image/png;base64, {{ $post->file_name }}" style="width:50px; height:30px;">
                                </td>
                                <td>
                                    {{ $post->created_at->format('m/d') }}
                                </td>
                                <td>
                                    <a href="{{ route('posts.show', ['post' => $post]) }}">詳細</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
@endsection

@section('javascript')
<script>
// table幅
function fixPlaceHolderWidth(event, ui){
    ui.children().each(function(){
        $(this).width($(this).width());
    });
    return ui;
};

$('#tbody').sortable({
    update: function(event, ui) {
        var update = $(this).sortable("toArray");
        console.log(update);
        var new_ids = $('#tbody input');
        for (let i = 0; i < update.length; i++) {
            new_ids[i].value = update[i];
        }
    },
    helper: fixPlaceHolderWidth
});
</script>
@endsection