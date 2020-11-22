import { ADD_RESULTS, CLEAR_RESULTS } from "../actions/results";

const resultsReducer = (state = {}, action: any) => {
  switch (action.type) {
    case ADD_RESULTS:
      return action.results;
    case CLEAR_RESULTS:
      return {};
    default:
      return state;
  }
};

export default resultsReducer;
