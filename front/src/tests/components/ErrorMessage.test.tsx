import React from "react";
import { render, screen } from "@testing-library/react";
import ErrorMessage from "../../components/ErrorMessage";

describe("Error message component", () => {
  test("should render correctly", () => {
    const { asFragment } = render(<ErrorMessage message={"test"} />);

    expect(asFragment()).toMatchSnapshot();
  });

  test("should render empty", () => {
    const { asFragment } = render(<ErrorMessage message={""} />);

    expect(asFragment()).toMatchSnapshot();
  });

  test("text should appear on screen", () => {
    render(<ErrorMessage message={"test error message"} />);
    expect(screen.getByText(/test error message/i)).toBeInTheDocument();
  });
});
