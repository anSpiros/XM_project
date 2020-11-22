import React from "react";
import { render, screen } from "@testing-library/react";
import HomePage from "../../pages/HomePage";

describe("Home page component", () => {
  test("should render correctly", () => {
    const { asFragment } = render(<HomePage />);

    expect(asFragment()).toMatchSnapshot();
  });

  test("should contain the word Welcome", () => {
    render(<HomePage />);

    expect(screen.getByText(/Welcome/i)).toBeInTheDocument();
  });
});
