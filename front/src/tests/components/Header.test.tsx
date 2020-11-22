import React from "react";
import Header from "../../components/Header";
import userEvent from "@testing-library/user-event";
import { cleanup, render, screen } from "@testing-library/react";
import { createMemoryHistory } from "history";
import { BrowserRouter, Router } from "react-router-dom";
import App from "../../App";
import { Provider } from "react-redux";
import { createStore } from "redux";
import allReducers from "../../state/reducers";
const store = createStore(allReducers);

describe("Header component", () => {
  afterEach(cleanup);
  test("should render correctly", () => {
    const { asFragment } = render(
      <BrowserRouter>
        <Header />
      </BrowserRouter>
    );

    expect(asFragment()).toMatchSnapshot();
  });

  test("full app rendering/navigating", () => {
    const history = createMemoryHistory();
    render(
      <Provider store={store}>
        <Router history={history}>
          <App />
        </Router>
      </Provider>
    );

    expect(screen.getByText(/Welcome/i)).toBeInTheDocument();

    const leftClick = { button: 0 };
    userEvent.click(screen.getByText(/Form/i), leftClick);

    // check that the content changed to the new page
    expect(screen.getByText(/Email/i)).toBeInTheDocument();
  });
});
