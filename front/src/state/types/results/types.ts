interface ResultsDatasetData {
  data: Array<any>;
  name: string;
}

interface ResultsInterface {
  dataset: ResultsDatasetData;
}

export interface ResultState {
  results: ResultsInterface;
}
