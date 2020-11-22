import React from "react";
import { render } from "@testing-library/react";
import DisplayDataTable from "../../components/DisplayDataTable";
import {
  DisplayDataInterface,
  headerData,
} from "../../interfaces/display-data.interface";

describe("DisplayData component", () => {
  test("should render correctly without data", () => {
    const { asFragment } = render(
      <DisplayDataTable headerData={[]} bodyData={[]} />
    );

    expect(asFragment()).toMatchSnapshot();
  });

  test("should render correctly with data", () => {
    const header: headerData[] = [
      {
        column: "Date",
      },
      {
        column: "Open",
      },
      {
        column: "High",
      },
      {
        column: "Low",
      },
      {
        column: "Close",
      },
      {
        column: "Volume",
      },
    ];
    const body: DisplayDataInterface[] = [
      {
        date: "test",
        open: 2,
        high: 2,
        low: 2,
        close: 1,
        volume: 1,
      },
    ];
    const { asFragment } = render(
      <DisplayDataTable headerData={header} bodyData={body} />
    );

    expect(asFragment()).toMatchSnapshot();
  });
});
