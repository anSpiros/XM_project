import React from "react";
import { BrowserRouter as Router, Switch, Route } from "react-router-dom";
import { FORM_ROUTE, RESULTS_ROUTE, ROOT_ROUTE } from "./routes/routes";
import FormPage from "./pages/FormPage";
import ResultsPage from "./pages/ResultsPage";
import Header from "./components/Header";
import HomePage from "./pages/HomePage";

function App() {
  return (
    <Router>
      <div className="App">
        <Header />
        <div className="container mt-5 d-flex justify-content-center">
          <Switch>
            <Route exact path={ROOT_ROUTE}>
              <HomePage />
            </Route>
            <Route path={FORM_ROUTE}>
              <FormPage />
            </Route>
            <Route path={RESULTS_ROUTE}>
              <ResultsPage />
            </Route>
          </Switch>
        </div>
      </div>
    </Router>
  );
}

export default App;
