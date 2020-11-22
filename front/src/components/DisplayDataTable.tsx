import React from "react";
import { DisplayDataInterface } from "../interfaces/display-data.interface";

interface headerDataInterface {
  column: string;
}

interface DisplayDataTableProps {
  headerData: headerDataInterface[];
  bodyData: DisplayDataInterface[];
}

const shouldRender = (
  headerData: headerDataInterface[],
  bodyData: DisplayDataInterface[]
) => {
  return headerData.length > 0 && bodyData.length > 0;
};

function DisplayDataTable({ headerData, bodyData }: DisplayDataTableProps) {
  return (
    <>
      {shouldRender(headerData, bodyData) ? (
        <div className="table-responsive">
          <table className="table">
            <thead>
              <tr>
                {headerData.map((data, index: number) => (
                  <th key={index}>{data.column}</th>
                ))}
              </tr>
            </thead>
            <tbody>
              {bodyData.map((data, index: number) => {
                return (
                  <tr key={index}>
                    <td>{data.date}</td>
                    <td>{data.open}</td>
                    <td>{data.high}</td>
                    <td>{data.low}</td>
                    <td>{data.close}</td>
                    <td>{data.volume}</td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      ) : null}
    </>
  );
}

export default DisplayDataTable;
