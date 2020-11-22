import React, { useEffect, useState } from "react";
import { DisplayDataInterface } from "../interfaces/display-data.interface";
import _ from "lodash";
import "../scss/Results.scss";
import { Link } from "react-router-dom";
import { FORM_ROUTE } from "../routes/routes";
import { useSelector } from "react-redux";
import { ResultState } from "../state/types/results/types";
import { DisplayData } from "../interfaces/results.interface";
import Results from "../components/Results";

function ResultsPage() {
  const results = useSelector((state: ResultState) => state.results);
  const [chartData, setChartData] = useState({});
  const [companyDescription, setCompanyDescription] = useState("");
  const [displayData, setDisplayData] = useState<DisplayData>({
    body: [],
    header: [],
  });
  const chart = () => {
    setChartData({
      labels: displayData.body.map((data) => {
        return data.date;
      }),
      datasets: [
        {
          label: "open",
          data: displayData.body.map((data) => {
            return data.open;
          }),
          backgroundColor: "rgba(75, 192, 192, 0.6)",
          borderWidth: 4,
        },
        {
          label: "close",
          data: displayData.body.map((data) => {
            return data.close;
          }),
          backgroundColor: "rgba(75, 192, 192, 0.6)",
          borderWidth: 4,
        },
      ],
    });
  };
  const prepareDataToDisplay = (data: any) => {
    const body = data.map((data: any) => {
      const newData: DisplayDataInterface = {
        date: data[0],
        open: data[1],
        high: data[2],
        low: data[3],
        close: data[4],
        volume: data[5],
      };
      return newData;
    });
    setDisplayData({
      body: body,
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
    });
  };

  const shouldRenderTable = () => {
    return !_.isEmpty(displayData.header) && !_.isEmpty(displayData.body);
  };

  useEffect(() => {
    if (!_.isEmpty(results)) {
      setCompanyDescription(results.dataset.name);
      prepareDataToDisplay(results.dataset.data);
    }
  }, [results]);

  useEffect(() => {
    chart();
  }, [displayData]);

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
  return (
    <>
      {!_.isEmpty(results) ? (
        <>
          {results.dataset.data.length > 0 ? (
            <>
              {shouldRenderTable() ? (
                <Results
                  chartData={chartData}
                  chartOptions={chartOptions}
                  companyDescription={companyDescription}
                  displayDataForTable={displayData}
                />
              ) : (
                <div className="results-loading">
                  <h2>Loading...</h2>
                </div>
              )}
            </>
          ) : (
            <div className="results-no-data">
              <h2>
                No data to show. Go back to form to change your preferences.
              </h2>
              <Link to={FORM_ROUTE}>Go to form</Link>
            </div>
          )}
        </>
      ) : (
        <div className="results no-data">
          <h2>You must go to form and add your preferences first.</h2>
          <Link to={FORM_ROUTE}>Go to form</Link>
        </div>
      )}
    </>
  );
}

export default ResultsPage;
