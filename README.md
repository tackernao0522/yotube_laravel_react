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

## ReactRouterでページを分ける

+ resources/ts/App.tsx を作成<br>

```
import React from 'react'
import ReactDOM from 'react-dom'

const App = () => {
  return (
    <h1>Laravel SPA</h1>
  )
}

export default App
```

+ resources/ts/index.tsx を編集<br>

```
import React from 'react'
import ReactDOM from 'react-dom'
import App from './App'

ReactDOM.render(
  <App />,
  document.getElementById('app')
)
```

+ React Routerのインストール<br>
`$ npm i -D react-router-dom @types/react-router-dom`<br>

+ rerources/ts/router.tsx を作成<br>

+ https://reactrouter.com/web/guides/quick-start (参考)<br>

+ resources/ts/router.tsx に記述<br>

```
import React from "react";
import { BrowserRouter, Switch, Route, Link } from "react-router-dom";

const Router = () => {
  return (
    <BrowserRouter>
      <div>
        <nav>
          <ul>
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>
              <Link to="/about">About</Link>
            </li>
            <li>
              <Link to="/users">Users</Link>
            </li>
          </ul>
        </nav>
        <Switch>
          <Route path="/about">
            <About />
          </Route>
          <Route path="/users">
            <Users />
          </Route>
          <Route path="/">
            <Home />
          </Route>
        </Switch>
      </div>
    </BrowserRouter>
  );
};

function Home() {
  return <h2>Home</h2>;
}

function About() {
  return <h2>About</h2>;
}

function Users() {
  return <h2>Users</h2>;
}

export default Router;
```

+ resources/ts/App.tsxを編集<br>

```
import React from 'react'
import Router from './router'

const App: React.VFC = () => {
  return (
    <Router />
  )
}

export default App
```

+ web.phpを編集<br>

```
Route::get('{all}', function () {
    return view('index');
})->where(['all' => '.*']);
```

## 各コンポーネントの作成

1. resources/ts/pagesディレクトリを作成する<br>
2. pagesディレクトリの中にさらにhelp、login、tasksディレクトリを作成する<br>
3. resources/ts/tasks/index.tsxを作成して記述<br>

```
import React from "react"

const TaskPage: React.VFC = () => {
  return (
    <h1>Task page</h1>
  )
}

export default TaskPage
```

4. router.tsxにimportを追加 及び Route変数を編集<br>

```
import React from "react";
import { BrowserRouter, Switch, Route, Link } from "react-router-dom";
import TaskPage from "./pages/tasks" // 追加

const Router = () => {
  return (
    <BrowserRouter>
      <div>
        <nav>
          <ul>
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>
              <Link to="/about">About</Link>
            </li>
            <li>
              <Link to="/users">Users</Link>
            </li>
          </ul>
        </nav>
        <Switch>
          <Route path="/about">
            <About />
          </Route>
          <Route path="/users">
            <Users />
          </Route>
          <Route path="/">
            <TaskPage /> // 編集
          </Route>
        </Switch>
      </div>
    </BrowserRouter>
  );
};

function Home() {
  return <h2>Home</h2>;
}

function About() {
  return <h2>About</h2>;
}

function Users() {
  return <h2>Users</h2>;
}

export default Router;
```

5. resources/ts/login/index.tsxを作成及び記述<br>

```
import React from "react"

const LoginPage: React.VFC = () => {
  return (
    <h1>Login page</h1>
  )
}

export default LoginPage
```

6. router.tsxを編集<br>

```
import React from "react";
import { BrowserRouter, Switch, Route, Link } from "react-router-dom";
import TaskPage from "./pages/tasks"
import LoginPage from "./pages/login" // 追加

const Router = () => {
  return (
    <BrowserRouter>
      <div>
        <nav>
          <ul>
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>
              <Link to="/help">ヘルプ</Link>
            </li>
            <li>
              <Link to="/login">ログイン</Link>
            </li>
          </ul>
        </nav>
        <Switch>
          <Route path="/help">
            <About />
          </Route>
          <Route path="/login">
            <LoginPage /> // 編集
          </Route>
          <Route path="/">
            <TaskPage />
          </Route>
        </Switch>
      </div>
    </BrowserRouter>
  );
};

function Home() {
  return <h2>Home</h2>;
}

function About() {
  return <h2>About</h2>;
}

function Users() {
  return <h2>Users</h2>;
}

export default Router;
```

7. resources/ts/help/index.tsxを作成及び記述<br>

```
import React from "react"

const HelpPage: React.VFC = () => {
  return (
    <h1>Help page</h1>
  )
}

export default HelpPage
```

8. router.tsxを編集<br>

```
import React from "react";
import { BrowserRouter, Switch, Route, Link } from "react-router-dom";
import TaskPage from "./pages/tasks"
import LoginPage from "./pages/login"
import HelpPage from "./pages/help" // 追加

const Router = () => {
  return (
    <BrowserRouter>
      <div>
        <nav>
          <ul>
            <li>
              <Link to="/">Home</Link>
            </li>
            <li>
              <Link to="/help">ヘルプ</Link> // 編集
            </li>
            <li>
              <Link to="/login">ログイン</Link>
            </li>
          </ul>
        </nav>
        <Switch>
          <Route path="/help">
            <HelpPage /> // 編集
          </Route>
          <Route path="/login">
            <LoginPage />
          </Route>
          <Route path="/">
            <TaskPage />
          </Route>
        </Switch>
      </div>
    </BrowserRouter>
  );
};

// ここから
function Home() {
  return <h2>Home</h2>;
}

function About() {
  return <h2>About</h2>;
}

function Users() {
  return <h2>Users</h2>;
}
// ここまで不要なので削除

export default Router;
```

## テンプレート(HTML/CSS)

+ app.scssに記述 <br>

+ router.tsxにヘッダーを追加<br>

```
    <BrowserRouter>
    // <div>は削除
        // ここから
        <header className="global-head">
          <ul>
            <li>
              <Link to ="/">ホーム</Link>
            </li>
            <li>
              <Link to="/help">ヘルプ</Link>
            </li>
            <li>
              <Link to="/login">ログイン</Link>
            </li>
            <li>
              <span>ログアウト</span>
            </li>
          </ul>
        </header>
        // ここまで追加記述

        // <nav>タグ内は削除する

        <Switch>
          <Route path="/help">
            <HelpPage />
          </Route>
          <Route path="/login">
            <LoginPage />
          </Route>
          <Route path="/">
            <TaskPage />
          </Route>
        </Switch>
      </div>　// 削除
    </BrowserRouter>
```

+ resources/ts/tasks/index.tsxの編集<br>

```
import React, { useEffect, useState } from "react" // 編集
import axios from "axios" // 追記

// 型の定義 追記
type Task = {
  id: number
  title: string
  is_done: boolean
  created_at: Date
  updated_at: Date
}

const TaskPage: React.VFC = () => {

  // 追記
  const [tasks, setTasks] = useState<Task[]>([])

  const getTasks = async () => {
    const { data } = await axios.get<Task[]>('api/tasks') // { data }というように分割代入に書き換える。(dataの部分だけ取得できるようになる) <task[]>(型を指定)
    // console.log(data);
    setTasks(data)
  } // 追記

  // 追記
  useEffect(() => {
    getTasks()
  })

  return (
    <>
      <form className="input-form">
        <div className="inner">
          <input type="text" className="input" placeholder="TODOを入力してください。" defaultValue="" /> // valueのところをdefaultValueに書き換え
          <button className="btn is-primary">追加</button>
        </div>
      </form>
      <div className="inner">
        <ul className="task-list">
        // ここから
          { tasks.map(task =>(
            <li key={task.id}>
              <label className="checkbox-label">
                  <input type="checkbox" className="checkbox-input" />
              </label>
              <div><span>{task.title}</span></div>
              <button className="btn is-delete">削除</button>
            </li>
          )) }
        <li>
        // ここまで追記
            <label className="checkbox-label">
                <input type="checkbox" className="checkbox-input" />
            </label>
            <div><span>新しいTODO</span></div>
            <button className="btn is-delete">削除</button>
          </li>
          <li>
              <label className="checkbox-label">
                <input type="checkbox" className="checkbox-input" />
              </label>
              <form><input type="text" className="input" defaultValue="編集中のTODO" /></form> // valueのところをdefaultValueに書き換え
              <button className="btn">更新</button>
          </li>
          <li className="done">
            <label className="checkbox-label">
                <input type="checkbox" className="checkbox-input" />
            </label>
            <div><span>実行したTODO</span></div>
            <button className="btn is-delete">削除</button>
          </li>
          <li>
            <label className="checkbox-label">
                <input type="checkbox" className="checkbox-input" />
            </label>
            <div><span>ゴミ捨て</span></div>
            <button className="btn is-delete">削除</button>
          </li>
          <li>
            <label className="checkbox-label">
                <input type="checkbox" className="checkbox-input" />
            </label>
            <div><span>掃除</span></div>
            <button className="btn is-delete">削除</button>
          </li>
        </ul>
      </div>
    </>
  )
}

export default TaskPage
```

### ReactQueryのインストール

+ `$ npm i -D react-query` <br>

### resources/ts/App.tsxの編集

```
import React from "react"
import Router from "./router"
import {QueryClient, QueryClientProvider} from "react-query" // 追記

const App: React.VFC = () => {
  // ここから追記
  const queryClient = new QueryClient({
    defaultOptions: {
      queries: {
        retry: false
      },
      mutations: {
        retry: false
      }
    }
  })
  // ここまで

  return (
    <QueryClientProvider client={queryClient}> // 追記
      <Router />
    </QueryClientProvider> // 追記
  )
}

export default App
```

+ resources/ts/tasks/index.tsxの編集<br>

```
import React from "react" // 編集
import axios from "axios" // 追記
import {useQuery} from "react-query" // 追記

// 型の定義
type Task = {
  id: number
  title: string
  is_done: boolean
  created_at: Date
  updated_at: Date
}

const TaskPage: React.VFC = () => {

  /* 削除する
  const [tasks, setTasks] = useState<Task[]>([])

  const getTasks = async () => {
    const { data } = await axios.get<Task[]>('api/tasks')
    // console.log(data);
    setTasks(data)
  }

  useEffect(() => {
    getTasks()
  })
  */

  // ここから追記
  const { data:tasks, status } = useQuery('tasks', async () => {
    const { data } = await axios.get<Task[]>('api/tasks')
    return data
  })
  // ここまで

  // ここから追記
  if (status === 'loading') {
    return <div className="loader" />
  } else if (status === 'error') {
    return <div className="align-center">データの読み込みに失敗しました。</div>
  } else if (!tasks || tasks.length <= 0) {
    return <div className="align-center">登録されたTODOはありません。</div>
  }
  // ここまで

  return (
    <>
      <form className="input-form">
        <div className="inner">
          <input type="text" className="input" placeholder="TODOを入力してください。" defaultValue="" />
          <button className="btn is-primary">追加</button>
        </div>
      </form>
      <div className="inner">
        <ul className="task-list">
          { tasks.map(task =>(
            <li key={task.id}>
              <label className="checkbox-label">
                  <input type="checkbox" className="checkbox-input" />
              </label>
              <div><span>{task.title}</span></div>
              <button className="btn is-delete">削除</button>
            </li>
          )) }
            <li>
            <label className="checkbox-label">
                <input type="checkbox" className="checkbox-input" />
            </label>
            <div><span>新しいTODO</span></div>
            <button className="btn is-delete">削除</button>
          </li>
          <li>
              <label className="checkbox-label">
                <input type="checkbox" className="checkbox-input" />
              </label>
              <form><input type="text" className="input" defaultValue="編集中のTODO" /></form>
              <button className="btn">更新</button>
          </li>
          <li className="done">
            <label className="checkbox-label">
                <input type="checkbox" className="checkbox-input" />
            </label>
            <div><span>実行したTODO</span></div>
            <button className="btn is-delete">削除</button>
          </li>
          <li>
            <label className="checkbox-label">
                <input type="checkbox" className="checkbox-input" />
            </label>
            <div><span>ゴミ捨て</span></div>
            <button className="btn is-delete">削除</button>
          </li>
          <li>
            <label className="checkbox-label">
                <input type="checkbox" className="checkbox-input" />
            </label>
            <div><span>掃除</span></div>
            <button className="btn is-delete">削除</button>
          </li>
        </ul>
      </div>
    </>
  )
}

export default TaskPage
```
