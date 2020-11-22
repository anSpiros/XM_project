import { DisplayDataInterface, headerData } from "./display-data.interface";

interface chartDatasetData {
  label: string;
  data: number[];
  backgroundColor: string;
  borderWidth: number;
}

export interface chartDataInterface {
  labels: string[];
  datasets: chartDatasetData[];
}

interface chartOptionsTicksData {
  beginAtZero: boolean;
  stacked: boolean;
}

interface chartOptionsGridLinesData {
  display: boolean;
}

interface chartOptionsScaleData {
  ticks: chartOptionsTicksData;
  gridLines: chartOptionsGridLinesData;
}

interface chartOptionsScaleInterface {
  yAxes: chartOptionsScaleData;
  xAxes: chartOptionsScaleData;
}

export interface chartOptionsInterface {
  responsive: string;
  scales: chartOptionsScaleInterface;
}

export interface DisplayData {
  body: DisplayDataInterface[];
  header: headerData[];
}
