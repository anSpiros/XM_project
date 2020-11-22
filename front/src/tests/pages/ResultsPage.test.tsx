import React from "react";
import { render } from "@testing-library/react";
import ResultsPage from "../../pages/ResultsPage";
import { Router } from "react-router-dom";
import { Provider } from "react-redux";
import { createMemoryHistory } from "history";
import { createStore } from "redux";
import allReducers from "../../state/reducers";

const store = createStore(allReducers);

describe("Results page component", () => {
  test("should render correctly", () => {
    const history = createMemoryHistory();
    const { asFragment } = render(
      <Provider store={store}>
        <Router history={history}>
          <ResultsPage />
        </Router>
      </Provider>
    );

    expect(asFragment()).toMatchSnapshot();
  });

  test("results are not empty", () => {});
});
