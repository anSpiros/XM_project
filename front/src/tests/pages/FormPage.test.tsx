import React from "react";
import { render } from "@testing-library/react";
import FormPage from "../../pages/FormPage";
import { createMemoryHistory } from "history";
import { Provider } from "react-redux";
import { Router } from "react-router-dom";
import { createStore } from "redux";
import allReducers from "../../state/reducers";

const store = createStore(allReducers);
describe("Form page component", () => {
  test("should render correctly", () => {
    const history = createMemoryHistory();
    const { asFragment } = render(
      <Provider store={store}>
        <Router history={history}>
          <FormPage />
        </Router>
      </Provider>
    );

    expect(asFragment()).toMatchSnapshot();
  });
});
