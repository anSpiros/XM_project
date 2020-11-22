import React from "react";
import { render, screen, cleanup } from "@testing-library/react";
import App from "../../App";
import { Router } from "react-router-dom";
import { Provider } from "react-redux";
import { createStore } from "redux";
import allReducers from "../../state/reducers";
import { createMemoryHistory } from "history";
import { FORM_ROUTE, ROOT_ROUTE } from "../../routes/routes";
import FormPage from "../../pages/FormPage";
import HomePage from "../../pages/HomePage";
import ResultsPage from "../../pages/ResultsPage";

const store = createStore(allReducers);

describe("App component", () => {
  afterEach(cleanup);

  test("renders learn react link", () => {
    const history = createMemoryHistory();
    render(
      <Provider store={store}>
        <Router history={history}>
          <App />
        </Router>
      </Provider>
    );
    const linkElement = screen.getByText(/Welcome/i);
    expect(linkElement).toBeInTheDocument();
  });

  test("landing Form page", () => {
    const history = createMemoryHistory();
    history.push(FORM_ROUTE);
    render(
      <Provider store={store}>
        <Router history={history}>
          <FormPage />
        </Router>
      </Provider>
    );

    expect(screen.getByText(/Email/i)).toBeInTheDocument();
  });

  test("Landing Home page", () => {
    const history = createMemoryHistory();
    history.push(ROOT_ROUTE);
    render(<HomePage />);
    expect(screen.getByText(/Welcome/i)).toBeInTheDocument();
  });

  test("Landing Results page", () => {
    const history = createMemoryHistory();
    history.push(ROOT_ROUTE);
    render(
      <Provider store={store}>
        <Router history={history}>
          <ResultsPage />
        </Router>
      </Provider>
    );
    expect(
      screen.getByText(/You must go to form and add your preferences first./i)
    ).toBeInTheDocument();
  });

  test("should render correctly", () => {
    const history = createMemoryHistory();
    const { asFragment } = render(
      <Provider store={store}>
        <Router history={history}>
          <App />
        </Router>
      </Provider>
    );

    expect(asFragment()).toMatchSnapshot();
  });
});
