import React from "react";
import { createMemoryHistory } from "history";
import { cleanup, render, fireEvent } from "@testing-library/react";
import { Provider } from "react-redux";
import { Router } from "react-router-dom";
import { createStore } from "redux";
import allReducers from "../../state/reducers";
import { act } from "react-dom/test-utils";
import Form from "../../components/Form";

const store = createStore(allReducers);
const history = createMemoryHistory();
const mockSubmit = jest.fn();

describe("Form component", () => {
  afterEach(cleanup);

  test("should render correctly", () => {
    const { asFragment } = render(
      <Provider store={store}>
        <Router history={history}>
          <Form onSubmit={mockSubmit} />
        </Router>
      </Provider>
    );
    expect(asFragment()).toMatchSnapshot();
  });

  test("should display required error when value is invalid", async () => {
    const { getByTestId, findAllByTestId } = render(
      <Provider store={store}>
        <Router history={history}>
          <Form onSubmit={mockSubmit} />
        </Router>
      </Provider>
    );
    fireEvent.submit(getByTestId("resolved"));

    expect(await findAllByTestId("error-message")).toHaveLength(4);
    expect(mockSubmit).not.toBeCalled();
  });

  test("email field should have label", () => {
    const mockSubmit = jest.fn();
    const { getByLabelText } = render(
      <Provider store={store}>
        <Router history={history}>
          <Form onSubmit={mockSubmit} />
        </Router>
      </Provider>
    );
    const emailInputNode = getByLabelText("Email");
    expect(emailInputNode.getAttribute("name")).toBe("email");
  });

  test("email input should accept text", async () => {
    const mockSubmit = jest.fn();
    const { getByLabelText } = render(
      <Provider store={store}>
        <Router history={history}>
          <Form onSubmit={mockSubmit} />
        </Router>
      </Provider>
    );
    const emailInputNode = getByLabelText("Email");
    // @ts-ignore
    expect(emailInputNode.value).toMatch("");
    await act(async () => {
      fireEvent.input(emailInputNode, { target: { value: "testing" } });
    });
    // @ts-ignore
    expect(emailInputNode.value).toMatch("testing");
  });
});
