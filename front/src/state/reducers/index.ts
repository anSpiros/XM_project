import resultsReducer from "./results";
import { combineReducers } from "redux";

const allReducers = combineReducers({
  results: resultsReducer,
});

export default allReducers;
