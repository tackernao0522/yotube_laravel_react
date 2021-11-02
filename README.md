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

## コンポーネントとロジックの分割

+ resources/ts/types とディレクトリを作成<br>

+ resources/ts/pages/tasks/index.tsxの編集<br>

```
import React from "react"
import TaskInput from "./components/TaskInput"
import TaskList from "./components/TaskList"

const TaskPage: React.VFC = () => {
  return (
    <>
      <TaskInput />
      <TaskList />
    </>
  )
}

export default TaskPage
```

+ resources/ts/types/Task.tsを作成する

+ resources/ts/types/Task.tsに型定義を記述

```
export type Task = {
  id: number
  title: string
  is_done: boolean
  created_at: Date
  updated_at: Date
}
```

+ resources/ts/queries とディレクトリを作成してその中にTaskQuery.tsを作成<br>

+ TaskQuery.tsに記述<br>

```
import * as api from "../api/TaskAPI"
import { useQuery } from "react-query"

const useTasks = () => {
  return useQuery('tasks', () => api.getTasks())
}

export {
  useTasks
}
```

+ resources/ts/api ディレクトリを作成し、その中にTaskAPI.tsを作成する<br>

```
import axios from "axios";
import { Task } from "../types/Task"

const getTasks = async () => {
  const { data } = await axios.get<Task[]>('api/tasks')
  return data
}

export {
  getTasks
}
```

+ resources/ts/tasks/components ディレクトリを作成し、その中にTaskInput.tsx, TaskItem.tsx, TaskList.tsxを作成する<br>

+ TaskInput.tsxに記述<br>

```
import React from "react"

const TaskInput: React.VFC = () => {
  return (
    <form className="input-form">
      <div className="inner">
        <input type="text" className="input" placeholder="TODOを入力してください。" defaultValue="" />
        <button className="btn is-primary">追加</button>
      </div>
    </form>
  )
}

export default TaskInput
```

+ TaskItem.tsxに記述<br>

```
import React from "react";
import { Task } from "../../../types/Task";

type Props = {
  task: Task;
}

const TaskItem: React.VFC<Props> = ({ task }) => {
  return (
    <li>
      <label className="checkbox-label">
        <input type="checkbox" className="checkbox-input" />
      </label>
      <div>
        <span>
          {task.title}
        </span>
      </div>
      <button className="btn is-delete">削除</button>
    </li>
  )
}

export default TaskItem;
```

+ TaskList.tsxに記述<br>

```
import React from "react";
import { useTasks } from "../../../queries/TaskQuery"
import TaskItem from "./TaskItem"

const TaskList: React.VFC = () => {
  const { data:tasks, status } = useTasks()

  if (status === 'loading') {
    return <div className="loader" />
  } else if (status === 'error') {
    return <div className="align-center">データの読み込みに失敗しました。</div>
  } else if (!tasks || tasks.length <= 0) {
    return <div className="align-center">登録されたTODOはありません。</div>
  }

  return (
    <>
      <div className="inner">
        <ul className="task-list">
          { tasks.map(task =>(
            <TaskItem key={task.id} task={task} />
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

export default TaskList;
```

## Todoのチェック機能の実装

+ TaskControllerにupdateDoneメソッドを最下部に実装する<br>

```
public function updateDone(Request $request, Task $task)
{
  $task->is_done = $request->is_done;

  return $task()->json($task)
    ? response()->json($task)
    : response()->json([], 500);
}
```

+ api.phpにルートの追加<br>

```
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('tasks', 'TaskController');
Route::patch('tasks/update-done/{task}', 'TaskController@updateDone'); // 追加

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
```
ここまででLaravelでアップデート用のAPIの実装は完了<br>

## Reactでアップデート処理の実装

+ resources/ts/api/TaskAPI.tsの編集<br>

```
import axios from "axios";
import { Task } from "../types/Task"

const getTasks = async () => {
  const { data } = await axios.get<Task[]>('api/tasks')
  return data
}

// ここから追記
const updateDoneTask = async ({ id, is_done }: Task) => {
  const { data } = await axios.patch<Task[]>(
    `/api/tasks/update-done/${id}`,
    { is_done: !is_done }
  )
  return data
}
// ここまで

export {
  getTasks,
  updateDoneTask // 追記
}
```

+ resources/ts/queries/TaskQuery.tsの編集

```
import * as api from "../api/TaskAPI"
import { useQuery, useMutation, useQueryClient } from "react-query" // 編集

const useTasks = () => {
  return useQuery('tasks', () => api.getTasks())
}

// ここから追記
const useUpdateDoneTask = () => {
  const queryClient = useQueryClient()

  return useMutation(api.updateDoneTask, {
    onSuccess: () => {
      queryClient.invalidateQueries('tasks')
    }
  })
}
// ここまで

export {
  useTasks,
  useUpdateDoneTask // 追記
}

```

## チェックが入れられるようにする

+ resources/ts/pages/tasks/TaskItem.tsxの編集<br>

```
import React from "react";
import { Task } from "../../../types/Task";
import { useUpdateDoneTask } from "../../../queries/TaskQuery" // 追記

type Props = {
  task: Task;
}

const TaskItem: React.VFC<Props> = ({ task }) => {
  const updateDoneTask = useUpdateDoneTask() // 追記

  return (
    <li className={task.is_done ? 'done' : ''}> // 編集
      <label className="checkbox-label">
        <input
          type="checkbox"
          className="checkbox-input"
          onClick={() => updateDoneTask.mutate(task)} // 追記
        />
      </label>
      <div>
        <span>
          {task.title}
        </span>
      </div>
      <button className="btn is-delete">削除</button>
    </li>
  )
}

export default TaskItem;
```

## ReactToastifyのインストール

+ `$ npm i -D react-toastify` <br>

+ https://www.youtube.com/redirect?event=video_description&redir_token=QUFFLUhqa2kzNTZIakRhUG8wWm1oc2pNZTVORXFrUlNWQXxBQ3Jtc0tub0hudlhua0g5UGJWNGx5UjZrWF91V1QwSEFZZjJFZU5IMjBVZ0JLVWNtMWl6WUNpWjFCMkVPVUtFMFZNQ2R0S25uVVVPV2k0bmQ3U1RvVWw4UmJnMWZJN2poWEZCS2pnUzJuem1uaE03OEp6TFRTaw&q=https%3A%2F%2Fgithub.com%2Ffkhadra%2Freact-toastify (参考) <br>

+ resources/ts/App.tsxを編集

```
import React from "react"
import Router from "./router"
import {QueryClient, QueryClientProvider} from "react-query"
import { ToastContainer } from 'react-toastify'; // 追記
import 'react-toastify/dist/ReactToastify.css'; // 追記


const App: React.VFC = () => {
  // 追記
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

  return (
    // 追記 //
    <QueryClientProvider client={queryClient}>
      <Router />
      <ToastContainer hideProgressBar={true} /> // 追記
    </QueryClientProvider>
  )
}

export default App
```

+ resources/ts/queries/TaskQuery.tsの編集<br>

```
import * as api from "../api/TaskAPI"
import { useQuery, useMutation, useQueryClient } from "react-query"
import { toast } from "react-toastify" // 追記

const useTasks = () => {
  return useQuery('tasks', () => api.getTasks())
}

const useUpdateDoneTask = () => {
  const queryClient = useQueryClient()

  return useMutation(api.updateDoneTask, {
    onSuccess: () => {
      queryClient.invalidateQueries('tasks')
    },
    onError: () => { // 追記
      toast.error('更新に失敗しました。')
    }
  })
}

export {
  useTasks,
  useUpdateDoneTask
}
```

## Todoの登録機能の実装

+ resources/ts/api/TaskAPI.tsの編集<br>

```
import axios from "axios";
import { Task } from "../types/Task"

const getTasks = async () => {
  const { data } = await axios.get<Task[]>('api/tasks')
  return data
}

const updateDoneTask = async ({ id, is_done }: Task) => {
  const { data } = await axios.patch<Task>( // <= 修正
    `/api/tasks/update-done/${id}`,
    { is_done: !is_done }
  )
  return data
}

// ここから追記
const createTask = async (title: string) => {
  const { data } = await axios.post<Task>(
    `/api/tasks`, { title: title }
  )
  return data
}
// ここまで

export {
  getTasks,
  updateDoneTask,
  createTask // 追記
}
```

+ resources/ts/queries/TaskQuery.tsの編集<br>

```
import * as api from "../api/TaskAPI"
import { useQuery, useMutation, useQueryClient } from "react-query"
import { toast } from "react-toastify"
import { AxiosError } from "axios" // 追記

const useTasks = () => {
  return useQuery('tasks', () => api.getTasks())
}

const useUpdateDoneTask = () => {
  const queryClient = useQueryClient()

  return useMutation(api.updateDoneTask, {
    onSuccess: () => {
      queryClient.invalidateQueries('tasks')
    },
    onError: () => {
      toast.error('更新に失敗しました。')
    }
  })
}

// ここから追記
const useCreateTask = () => {
  const queryClient = useQueryClient()

  return useMutation(api.createTask, {
    onSuccess: () => {
      queryClient.invalidateQueries('tasks')
      toast.success('登録に成功しました。')
    },
    onError: (error: AxiosError) => {
      // console.log(error.response?.data)
      if (error.response?.data.errors) {
        Object.values(error.response?.data.errors).map(
          (messages: any) => {
            messages.map((message: string) => {
              toast.error(message)
            })
          }
        )
      } else {
        toast.error('登録に失敗しました。')
      }
    }
  })
}
// ここまで

export {
  useTasks,
  useUpdateDoneTask,
  useCreateTask // 追記
}
```

+ resources/ts/pages/tasks/TaskInput.tsxの編集<br>

```
import React, { useState } from "react" // 編集
import { useCreateTask } from "../../../queries/TaskQuery" // 追記

const TaskInput: React.VFC = () => {
  const [title, setTitle] = useState('') // 追記
  const createTask = useCreateTask() // 追記

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => { // 追記
    e.preventDefault() // 追記
    createTask.mutate(title) // 追記
    setTitle('') // 追記
  } // 追記

  return (
    <form className="input-form" onSubmit={handleSubmit}>
      <div className="inner">
        <input
          type="text"
          className="input"
          placeholder="TODOを入力してください。"
          value={title} // 編集
          onChange={(e) => setTitle(e.target.value)} // 追記
        />
        <button className="btn is-primary">追加</button>
      </div>
    </form>
  )
}

export default TaskInput
```

## Todoの編集・削除機能の実装

+ resources/ts/api/TaskAPI.tsの編集<br>

```
import axios from "axios";
import { Task } from "../types/Task"

const getTasks = async () => {
  const { data } = await axios.get<Task[]>('api/tasks')
  return data
}

const updateDoneTask = async ({ id, is_done }: Task) => {
  const { data } = await axios.patch<Task>(
    `/api/tasks/update-done/${id}`,
    { is_done: !is_done }
  )
  return data
}

const createTask = async (title: string) => {
  const { data } = await axios.post<Task>(
    `/api/tasks`, { title: title }
  )
  return data
}

// ここから追記
const updateTask = async ({ id, task }: { id: number, task: Task }) => {
  // patchのままでも良い
  const { data } = await axios.put<Task>(
    `/api/tasks/${id}`, task
  )
  return data
}

const deleteTask = async (id: number) => {
  // patchのままでも良い
  const { data } = await axios.delete<Task>(
    `/api/tasks/${id}`
  )
  return data
}
// ここまで

export {
  getTasks,
  updateDoneTask,
  createTask,
  updateTask, // 追記
  deleteTask // 追記
}
```

+ resources/ts/queries/TaskQuery.tsの編集<br>

```
import * as api from "../api/TaskAPI"
import { useQuery, useMutation, useQueryClient } from "react-query"
import { toast } from "react-toastify"
import { AxiosError } from "axios"

const useTasks = () => {
  return useQuery('tasks', () => api.getTasks())
}

const useUpdateDoneTask = () => {
  const queryClient = useQueryClient()

  return useMutation(api.updateDoneTask, {
    onSuccess: () => {
      queryClient.invalidateQueries('tasks')
    },
    onError: () => {
      toast.error('更新に失敗しました。')
    }
  })
}

const useCreateTask = () => {
  const queryClient = useQueryClient()

  return useMutation(api.createTask, {
    onSuccess: () => {
      queryClient.invalidateQueries('tasks')
      toast.success('登録に成功しました。')
    },
    onError: (error: AxiosError) => {
      // console.log(error.response?.data)
      if (error.response?.data.errors) {
        Object.values(error.response?.data.errors).map(
          (messages: any) => {
            messages.map((message: string) => {
              toast.error(message)
            })
          }
        )
      } else {
        toast.error('登録に失敗しました。')
      }
    }
  })
}

// ここから追記
const useUpdateTask = () => {
  const queryClient = useQueryClient()

  return useMutation(api.updateTask, {
    onSuccess: () => {
      queryClient.invalidateQueries('tasks')
      toast.success('更新に成功しました。')
    },
    onError: (error: AxiosError) => {
      // console.log(error.response?.data)
      if (error.response?.data.errors) {
        Object.values(error.response?.data.errors).map(
          (messages: any) => {
            messages.map((message: string) => {
              toast.error(message)
            })
          }
        )
      } else {
        toast.error('更新に失敗しました。')
      }
    }
  })
}

const useDeleteTask = () => {
  const queryClient = useQueryClient()

  return useMutation(api.deleteTask, {
    onSuccess: () => {
      queryClient.invalidateQueries('tasks')
      toast.success('削除に成功しました。')
    },
    onError: () => {
        toast.error('削除に失敗しました。')
    }
  })
}
// ここまで

export {
  useTasks,
  useUpdateDoneTask,
  useCreateTask,
  useUpdateTask, // 追記
  useDeleteTask // 追記
}
```

+ resources/ts/pages/tasks/componensts/TaskItem.tsxの編集<br>

```
import React, { useState } from "react";
import { Task } from "../../../types/Task";
import { useUpdateDoneTask, useUpdateTask, useDeleteTask } from "../../../queries/TaskQuery"
import { toast } from "react-toastify"

type Props = {
  task: Task;
}

const TaskItem: React.VFC<Props> = ({ task }) => {
  const updateDoneTask = useUpdateDoneTask()
  const updateTask = useUpdateTask()
  const deleteTask = useDeleteTask()

  const [editTitle, setEditTitle] = useState<string|undefined>(undefined)

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setEditTitle(e.target.value)
  }

  const handleUpdate = (e: React.FormEvent<HTMLFormElement> | React.MouseEvent<HTMLButtonElement>) => {
    e.preventDefault()

    if (!editTitle) {
      toast.error('タイトルを入力してください。')
      return
    }

    const newTask = {...task}
    newTask.title = editTitle

    updateTask.mutate({
      id: task.id,
      task: newTask
    })

    setEditTitle(undefined)
  }

  const handleToggleEdit = () => {
    setEditTitle(task.title)
  }

  const handleOnKey = (e: React.KeyboardEvent<HTMLInputElement>) => {
    if (['Escape', 'Tab'].includes(e.key)) {
      setEditTitle(undefined)
    }
  }

  // input用のコンポーネントを作成
  const itemInput = () => {
    return (
      <>
        <form onSubmit={handleUpdate}>
          <input
            type="text"
            className="input"
            defaultValue={editTitle}
            onChange={handleInputChange}
            onKeyDown={handleOnKey}
          />
        </form>
        <button className="btn" onClick={handleUpdate}>更新</button>
      </>
    )
  }

  const itemText = () => {
    return (
      <>
        <div onClick={handleToggleEdit}>
          <span>{task.title}</span>
        </div>
        <button
          className="btn is-delete"
          onClick={() => deleteTask.mutate(task.id)}
        >
          削除
        </button>
      </>
    )
  }

  return (
    <li className={task.is_done ? 'done' : ''}>
      <label className="checkbox-label">
        <input
          type="checkbox"
          className="checkbox-input"
          onClick={() => updateDoneTask.mutate(task)}
        />
      </label>
      { editTitle === undefined ? itemText() : itemInput() }
    </li>
  )
}

export default TaskItem;
```

## Laravel Sanctumでユーザー認証機能の作成

+ ライブラリのインストール `$ composer require laravel/sanctum`<br>

+ `$ php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`を実行<br>

+ `app/Http/Kernel.php`の編集<br>

```
protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class, // 追記
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
```

+ `config/sanctum.php`の編集<br>

```
'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', sprintf(
        '%s%s',
        'localhost,localhost:8000,127.0.0.1,127.0.0.1:8000,::1', // localhost:8000に変更
        env('APP_URL') ? ','.parse_url(env('APP_URL'), PHP_URL_HOST) : ''
    ))),
```

+ `personal_access_tokens`マイグレーションファイルを削除<br>

+ `php artisan make:seeder UsersTableSeeder` UsersTableSeeder.phpを作成<br>

+ `UsersTableSeeder.php`の編集<br>

```
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'yamada',
                'email' => 'yamada@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'tanaka',
                'email' => 'tanaka@example.com',
                'email_verified_at' => now(),
                'password' => \Hash::make('123456789'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
```

+ `DatabaseSeeder.php`の編集<br>

```
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TasksTableSeeder::class);
        $this->call(UsersTableSeeder::class); // 追記
    }
}
```

+ `api.php`の編集<br>

```
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('tasks', 'TaskController');
    Route::patch('tasks/update-done/{task}', 'TaskController@updateDone');
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});
```

+ この状態で `./vendor/bin/phpunit tests/Feature/TaskTest.php`を実行すると失敗する TaskApiに認証が必要になったのが原因である<br>

+ `tests/Feature/TaskTest.php`の編集 テストが成功する<br>

```
<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User; // 追記

class TaskTest extends TestCase
{
    use RefreshDatabase;

    // ここから追記
    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user); // ログインした状態
    }
    // ここまで

    /**
     * @test
     */
    public function 一覧を取得できる()
    {
        $tasks = Task::factory()->count(10)->create();
        // dd($tasks->toArray());

        $response = $this->getJson('api/tasks');
        // dd($response->json());

        $response->assertOk()
            ->assertJsonCount($tasks->count());
    }

    /**
     * @test
     */
    public function 登録することができる()
    {
        $data = [
            'title' => 'テスト投稿'
        ];

        $response = $this->postJson('api/tasks', $data);

        // dd($response->json());

        $response->assertCreated()
            ->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function タイルが空の場合は登録できない()
    {
        $data = [
            'title' => ''
        ];

        $response = $this->postJson('api/tasks', $data);
        // dd($response->json());

        $response->assertStatus(422)
            ->assertJsonValidationErrors(
                [
                    'title' => 'タイトルは、必ず指定してください。',
                ]
            );
    }

    /**
     * @test
     */
    public function タイルが255文字を超えた場合は登録できない()
    {
        $data = [
            'title' => str_repeat('あ', 256)
        ];

        $response = $this->postJson('api/tasks', $data);
        // dd($response->json());

        $response->assertStatus(422)
            ->assertJsonValidationErrors(
                [
                    'title' => 'タイトルは、255文字以下にしてください。',
                ]
            );
    }

    /**
     * @test
     */
    public function 更新することができる()
    {
        $task = Task::factory()->create();

        $task->title = '書き換え';

        // dd($task);

        $response = $this->patchJson("api/tasks/{$task->id}", $task->toArray());
        // dd($response->json());

        $response->assertOk()
            ->assertJsonFragment($task->toArray());
    }

    /**
     * @test
     */
    public function 削除することができる()
    {
        $tasks = Task::factory()->count(10)->create();

        $response = $this->deleteJson("api/tasks/1");
        $response->assertOk();

        $response = $this->getJson("api/tasks");
        $response->assertJsonCount($tasks->count() - 1);
    }
}
```

+ LoginControllerの作成 `$ php artisan make:controller LoginController`<br>

+ `LoginController`の編集<br>

```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(Auth::user());
        }

        return response()->json([], 401);
    }

    /**
     * @param Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(true);
    }
}
```

+ `api.php` ルートの編集<br>

```
Route::post('login', 'LoginController@login'); // 追記
Route::post('logout', 'LoginController@logout'); // 追記

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('tasks', 'TaskController');
    Route::patch('tasks/update-done/{task}', 'TaskController@updateDone');
    Route::get('user', function (Request $request) {
        return $request->user();
    });
});
```

+ `router.tsx`の編集<br>

```
import React, { useEffect } from "react"; // 編集
import { BrowserRouter, Switch, Route, Link } from "react-router-dom";
import TaskPage from "./pages/tasks";
import LoginPage from "./pages/login";
import HelpPage from "./pages/help";
import axios from "axios" // 追記

const Router = () => {

  // ここから追記
  useEffect(() => {
    axios.post('/api/login', {
      email: 'admin@example.com',
      password: '123456789'
    }).then(response => {
      console.log(response) // ログインしたユーザー情報が確認できる
    })
  }, [])
  // ここまで

  return (
    <BrowserRouter>
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
    </BrowserRouter>
  );
};

export default Router;
```

+ ログインできることを確認できたら`router.tsx`の編集<br>

```
import React, { useEffect } from "react";
import { BrowserRouter, Switch, Route, Link } from "react-router-dom";
import TaskPage from "./pages/tasks";
import LoginPage from "./pages/login";
import HelpPage from "./pages/help";
import axios from "axios" // 削除

const Router = () => {

  // ここから編集
  useEffect(() => {

  }, [])
  // ここまで

  return (
    <BrowserRouter>
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
    </BrowserRouter>
  );
};

export default Router;
```