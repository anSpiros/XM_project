import React from "react";
import { render } from "@testing-library/react";
import Results from "../../components/Results";

const chartData = {
  labels: ["test", "test2"],
  datasets: [
    {
      label: "open",
      data: [1, 2],
      backgroundColor: "test",
      borderWidth: 4,
    },
    {
      label: "close",
      data: [3, 4],
      backgroundColor: "test",
      borderWidth: 4,
    },
  ],
};

const displayDataForTable = {
  body: [
    {
      date: "test",
      open: 1,
      high: 2,
      low: 1,
      close: 2,
      volume: 3,
    },
  ],
  header: [
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
  ],
};

const chartOptions = {
  responsive: true,
  scales: {
    yAxes: [
      {
        ticks: {
          beginAtZero: true,
          stacked: true,
        },
        gridLines: {
          display: false,
        },
      },
    ],
    xAxes: [
      {
        ticks: {
          stacked: true,
        },
        gridLines: {
          display: false,
        },
      },
    ],
  },
};

jest.mock("react-chartjs-2", () => ({
  Bar: () => null,
}));

describe("Results component", () => {
  test("should render correctly", () => {
    const { asFragment } = render(
      <Results
        chartData={chartData}
        chartOptions={chartOptions}
        companyDescription={"test"}
        displayDataForTable={displayDataForTable}
      />
    );

    expect(asFragment()).toMatchSnapshot();
  });
});
