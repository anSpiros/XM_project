export const ADD_RESULTS: string = "ADD_RESULTS";

export const addResults = (results: any) => ({
  type: ADD_RESULTS,
  results,
});

export const CLEAR_RESULTS: string = "CLEAR_RESULTS";
export const clearResults = () => ({
  type: CLEAR_RESULTS,
});
