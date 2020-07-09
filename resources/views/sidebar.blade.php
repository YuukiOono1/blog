<span id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <p>カテゴリー</p>
    <!--Category-->
    <!--プロバイダーから取得、foreach２回も回すのなぜ？ -->
    @foreach ($categories_name as $category_name)
        @foreach ($category_name as $category)
            <a href="{{ route('categories.show', ['category' => $category]) }}">{{ $category->name }}</a>
        @endforeach
    @endforeach
</span>