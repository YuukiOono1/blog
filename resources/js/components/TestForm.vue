<template>
    <form
    id="app"
    @submit="checkForm" 
    action="/check"	
    method="post"
    novalidate="true" 
    >

        <p v-if="errors"> 
            <ul>
                <li v-for="error in errors" :key="error" style="color:red;">
                    {{ error }}
                </li>
            </ul>
        </p>

        <p>
            <label for="name">名前</label>
            <input
            id="name"
            v-model="name"
            type="text"
            name="name"
            >
        </p>

        <p>
            <label for="email">メール</label> 
            <input
            id="email"
            v-model="email"
            type="email"
            name="email"
            >
        </p>

        <p>
            <label for="age">年齢</label>
            <input
            id="age"
            v-model="age"
            type="number"
            name="age"
            min="0"
            >
        </p>

        <p>
            <label for="movie">お気に入りの映画</label>
            <select
            id="movie"
            v-model="movie"
            name="movie"
            >
            <option>Star Wars</option>
            <option>Vanilla Sky</option>
            <option>Atomic Blonde</option>
            </select>
        </p>

        <p>{{ message }}</p>
        <template>
            <!--dragoverはドロップしている間イベント発生-->
            <!--dragenterはドロップエリアに入ってる間-->
            <!--dragleaveはドロップエリアから離れたら-->
            <!--changeは画像選択、dropはドロップしたら-->
        </template>
        <div class="drop_area" :class="{'dragging': isDragging}">
            <input type="file"
            @dragenter="dragEnter"
            @dragleave="dragLeave"
            @change="selectFile"
            >
            <img v-if="imgSrc != ''" :src="imgSrc" class="preview-img">
            <template><!--親要素のdrop_areaに対してpostionをabsolute--></template>
        </div>
        <div>
            <!-- preventでフォームの送信はしない, trueとfalseで表示、非表示 -->
            <button @click.prevent="deleteFile" v-if="showDelete">削除</button>
        </div>
        <div class="mt-4">
            <button type="submit">送信</button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            errors: [], // エラーを配列で
            name: "",
            age: "",
			email: "",
            movie: "",
            isDragging: false, // 初期値ではfalseに設定
            message: "ここにアップロードしてください。",
            imgSrc: "",
            showDelete: false,
        }
    },

    watch: {
        imgSrc : function() {   // 監視
            if(this.imgSrc == "") {
                this.showDelete = false;
            } else {
                this.showDelete = true;
            }
        }
    },

    methods: {
        dragEnter() {
            this.isDragging = true; // ドラッグエリアに入ったらtrue
        },
        dragLeave() {
            this.isDragging = false; // ドラッグエリアから外れたらfalse
        },
        selectFile() {
            var file = event.target.files[0]; // ファイルの情報
            var reader = new FileReader(); // ファイルを読み込むためのインスタンス

            reader.readAsDataURL(file); // URLとして読み込む

            reader.onload = function () { // 読み込みが成功した場合
                this.imgSrc = reader.result; // resultプロパティがURLを持っている
                console.log(this.imgSrc);
            }.bind(this); // 関数
        },
        deleteFile() {
            this.imgSrc = "";
        },

        checkForm: function (e) { // イベントを受け取る
            this.errors = [];

            if (this.name == "") {
                this.errors.push('名前は必須です。');
			} else if(this.name.length >= 15) {
                this.errors.push('15文字以下で入力してください');
            }

            if (!this.email) {
                this.errors.push('メールアドレスは必須です');
            } else if (!this.validEmail(this.email)) {
                this.errors.push('正しく入力してください。');
            }

            if (!this.age) {
                this.errors.push('年齢は必須です。');
            }

            if (!this.errors.length) {
                return true;
            }

            e.preventDefault(); // エラーがあれば送信をキャンセルする
        },
        validEmail: function (email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        checkString: function (name) {
            var re = /^[A-Za-z0-9]*$/
            return re.test(name);
        }
    },
}
</script>

<style scope>
.drop_area {
    position: relative; /*基準*/
    color: gray;
    font-weight: bold;
    font-size: 1.2em;
    justify-content: center;
    align-items: center;
    width: 500px;
    height: 300px;
    border: 5px solid gray;
    border-radius: 15px;
}

.preview-img {
    position: absolute; /*親要素のdrop_areaのrelativeを基準にしてabsoluteを使う*/
    border-radius: 10px;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
}

.drop_area input {
    width: 100%; /*親要素分引き伸ばす*/
    height: 100%; /*親要素分引き伸ばす*/
    cursor: pointer;
    opacity: 0; /*消す*/
}

.dragging {
    opacity: 0.8; /*ドラッグしたら外枠を半透明にする*/
}
</style>