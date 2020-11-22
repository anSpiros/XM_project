import {
  ADD_RESULTS,
  addResults,
  CLEAR_RESULTS,
  clearResults,
} from "../../../state/actions/results";

describe("actions", () => {
  test("should create action to add results", () => {
    const results = {
      dataset: {
        id: "test",
      },
    };
    const expectedAction = {
      type: ADD_RESULTS,
      results,
    };

    expect(addResults(results)).toEqual(expectedAction);
  });

  test("should create action to clear results", () => {
    const expectedAction = {
      type: CLEAR_RESULTS,
    };

    expect(clearResults()).toEqual(expectedAction);
  });
});
