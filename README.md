## laravel-ide-helperのインストール

+ $ composer require --dev barryvdh/laravel-ide-helper <br>

## Factoryの作成

+ $ php artisan make:factory TaskFactory <br>

## IDE Helperファイルの作成

+ $ php artisan ide-helper:generate<br>
+ $ php artisan ide-helper:models "App\Models\Task"<br>

## テストの実行

+ $ ./vendor/bin/phpunit tests/Feature/ExampleTest.php<br>

## Validation Requestファイルの作成

+ $ php artisan make:request TaskRequest<br>

## React.jsとTypeScriptのインストール

1. webpack.mix.jsを編集する<br>

```
webpack.mix.js

mix.ts('resources/ts/index.tsx', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
```

2. $ npm install <br>
3. $ npm run prod (実行してみる)<br>
4. package.jsonの中の"devDependencies"の"lodash"は削除する<br>

### Reactのインストール

+ $ npm i -D react react-dom @types/react @types/react-dom <br>
+ $ npm install の実行 <br>

### TypeScriptの設定

1. $ npm install -g typescript <br>
2. $ tsc --init --jsx react <br>
3. resources/ts/index.tsx を作成する <br>
4. `resources/css`を`resources/sass`に変更<br>
5. `resources/sass/app.css`を`resources/sass/app.scss`に変更<br>
6. $ npm run prod <br>

+ welcome.blade.phpをindex.blade.phpの変更して中身を編集<br>
+ web.phpのルート編集<br>

```
Route::get('/', function () {
    return view('index');
});
```
+ webpack.mix.jsに追加記述<br>

```
if (mix.inProduction()) {
    mix.version();
}
```
+ index.blade.phpの編集<br>

```
<link rel="stylesheet" href="{{ mix('css/app.css') }}"> <!-- 変更 -->

<script src="{{ mix('/js/index.js') }}"></script> // 変更
```
+ 再度 $ mpm run prod <br>
