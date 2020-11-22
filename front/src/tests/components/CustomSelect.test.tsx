import React from "react";
import { cleanup, render } from "@testing-library/react";
import CustomSelect from "../../components/CustomSelect";
import { symbols } from "../../data/symbols";

describe("Custom select component", () => {
  afterEach(cleanup);
  test("should render correctly", () => {
    const { asFragment } = render(
      <CustomSelect symbols={symbols} formRef={React.createRef()} />
    );

    expect(asFragment()).toMatchSnapshot();
  });
});
