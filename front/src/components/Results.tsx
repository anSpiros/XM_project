import React from "react";
import PropTypes from "prop-types";
import { Bar } from "react-chartjs-2";
import { DisplayData } from "../interfaces/results.interface";
import DisplayDataTable from "./DisplayDataTable";

Results.propTypes = {
  chartData: PropTypes.object.isRequired,
  chartOptions: PropTypes.object.isRequired,
  displayDataForTable: PropTypes.object.isRequired,
};

interface ResultsProps {
  chartData: any;
  chartOptions: any;
  companyDescription: string;
  displayDataForTable: DisplayData;
}

function Results({
  chartData,
  chartOptions,
  companyDescription,
  displayDataForTable,
}: ResultsProps) {
  return (
    <>
      <div className="row results">
        <div className="col-12 results-company">
          <h3 className="results-company__name">{companyDescription}</h3>
        </div>
        <div className="col-12">
          <div className="chart-wrapper">
            <Bar data={chartData} options={chartOptions} />
          </div>
        </div>
        <div className="col-12 results-table">
          <DisplayDataTable
            bodyData={displayDataForTable.body}
            headerData={displayDataForTable.header}
          />
        </div>
      </div>
    </>
  );
}

export default Results;
