import React from "react"
import Router from "./router"
import {QueryClient, QueryClientProvider} from "react-query" // 追記

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
    </QueryClientProvider>
  )
}

export default App
