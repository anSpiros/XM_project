import React from "react";
import Form from "../components/Form";
import { addResults } from "../state/actions/results";
import { RESULTS_ROUTE } from "../routes/routes";
import { useHistory } from "react-router-dom";
import { useDispatch } from "react-redux";

function FormPage() {
  let history = useHistory();
  const dispatch = useDispatch();
  const onSubmit = (data: any) => {
    dispatch(addResults(data));
    history.push(RESULTS_ROUTE);
  };
  return (
    <div className="row">
      <div className="col-12">
        <Form onSubmit={onSubmit} />
      </div>
    </div>
  );
}

export default FormPage;
