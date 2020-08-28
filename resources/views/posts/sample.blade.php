@extends('layouts')

@section('title', 'テスト')

@section('content')
<form id="form">
    <div class="form-group">
        <label>名前</label>
        <input type="text" name="name">
        <strong class="text-danger" id="feedback_name"></strong>
    </div>
    <div class="form-group">
        <label>カテゴリー</label>
        <input type="text" name="category">
        <strong class="text-danger" id="feedback_category"></strong>
    </div>
    <div class="form-group">
        <label>画像</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label>選択</label>
        <input type="radio" name="hoge" value="1">
        <input type="radio" name="hoge" value="2">
        <strong class="text-danger" id="feedback_hoge"></strong>
    </div>
    <button>post</button>
</form>
@endsection

@section('javascript')
<script>
const form = document.querySelector('form');
const feedback_name = document.getElementById('feedback_name');
const feedback_category = document.getElementById('feedback_category');
const feedback_hoge = document.getElementById('feedback_hoge');
const feedback_check = document.getElementById('feedback_check');

console.log(form.options)

for (let i=0; i<form.options; i++) {
    if (form.options[i].checked) {
        console.log(form.options[i].value);
    }
}


form.addEventListener('submit', e => {
    const name = form.name.value;
    const category = form.category.value;
    const hoge = form.hoge.value;

    if (name == "") {
        feedback_name.textContent = "名前は必須です。";
    } else if (name.length < 2) {
        feedback_name.textContent = "名前が短すぎます。";
    } else {
        feedback_name.textContent = "";
    }

    if (category == "") {
        feedback_category.textContent = "カテゴリーは必須です。";
    } else if (category.length < 2) {
        feedback_category.textContent = "カテゴリーが短すぎます。";
    } else {
        feedback_category.textContent = "";
    }

    e.preventDefault();
});
</script>
@endsection