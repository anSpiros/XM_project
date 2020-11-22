import resultsReducer from "../../../state/reducers/results";
import { ADD_RESULTS, CLEAR_RESULTS } from "../../../state/actions/results";

describe("results reducer", () => {
  test("should return the initial state", () => {
    expect(resultsReducer({}, {})).toEqual({});
  });

  test("should handle ADD_RESULTS", () => {
    const results = {
      dataset: {
        id: "test",
      },
    };
    const action = {
      type: ADD_RESULTS,
      results,
    };
    expect(resultsReducer({}, action)).toEqual(results);
  });

  test("should handle CLEAR_RESULTS", () => {
    const action = {
      type: CLEAR_RESULTS,
    };
    expect(resultsReducer({}, action)).toEqual({});
  });
});
