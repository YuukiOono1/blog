<span id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <p>カテゴリー</p>
    <!--Category-->
    <!--この書き方でできたのはなぜ？-->
    @foreach($post as $posts)
        @foreach($posts->category as $category)
            <a href="{{ route('categories.show', ['category' => $category]) }}">{{ $category->name }}</a>
        @endforeach
    @endforeach
</span>