import React, { useState } from "react";
import DayPickerInput from "react-day-picker/DayPickerInput";
import { useForm } from "react-hook-form";
import { FormDataInterface } from "../interfaces/formData.interface";
import "../scss/Form.scss";
import "react-day-picker/lib/style.css";
import ErrorMessage from "./ErrorMessage";
import axios from "axios";
import { ErrorsFormRequestInterface } from "../interfaces/errors-form-request.interface";
import moment from "moment";
import CustomSelect from "./CustomSelect";
import { symbols } from "../data/symbols";
import _ from "lodash";
function Form({ onSubmit }: any) {
  const {
    register,
    errors,
    handleSubmit,
    setValue,
    setError,
    watch,
  } = useForm();
  const [requestError, setRequestError] = useState("");
  const [isLoading, setIsLoading] = useState(false);
  const watchStartDate = watch("startDate", ""); // you can supply default value as second argument

  const onFormSubmit = async (data: FormDataInterface) => {
    setIsLoading(true);
    const url = `http://${process.env.REACT_APP_API_URL}/quotes`;
    try {
      const response = await axios.post(url, data);
      setIsLoading(false);
      onSubmit(response.data.data);
    } catch (error) {
      console.error(error);
      setIsLoading(false);
      if (error.response?.data?.errors) {
        handleErrors(error.response.data.errors);
        return;
      }

      setRequestError("We are sorry, service is unavailable. Try again later.");
    }
  };

  const formatDate = (date: any, format: any, local: any) => {
    return moment(date).format(FORMAT);
  };

  const handleErrors = (errors: ErrorsFormRequestInterface[]) => {
    for (const error of errors) {
      setError(error.field, { message: error.message });
    }
  };

  const FORMAT = "YYYY-MM-DD";
  const today = new Date();

  const renderStartDateInput = React.forwardRef((props: any, ref: any) => (
    <input
      className="form-control"
      id="startDate"
      {...props}
      name="startDate"
      ref={register({
        required: {
          value: true,
          message: "Start date is required",
        },
      })}
    />
  ));
  const renderEndDateInput = React.forwardRef((props: any, ref: any) => (
    <input
      className="form-control"
      id="endDate"
      {...props}
      name="endDate"
      disabled={isEndDateDisabled(watchStartDate)}
      ref={register({
        required: {
          value: true,
          message: "End date is required",
        },
      })}
    />
  ));

  const isEndDateDisabled = (startDate: string) => {
    return _.isEmpty(startDate);
  };
  return (
    <>
      {requestError && <div className="alert alert-danger">{requestError}</div>}
      <form onSubmit={handleSubmit(onFormSubmit)} className="form-wrapper">
        <div className="form-group">
          <div className="row">
            <div className="col-12 col-sm-6">
              <label htmlFor="startDate">Start date</label>
              <DayPickerInput
                onDayChange={(day: Date) => {
                  const formattedDate = moment(day).format(FORMAT);
                  setValue("startDate", formattedDate, {
                    shouldValidate: true,
                    shouldDirty: true,
                  });
                }}
                format={FORMAT}
                formatDate={formatDate}
                dayPickerProps={{
                  todayButton: "Today",
                  disabledDays: { after: today },
                }}
                component={renderStartDateInput}
              />
              {errors.startDate && (
                <ErrorMessage message={errors.startDate.message} />
              )}
            </div>
            <div className="col-12 col-sm-6">
              <label htmlFor="endDate">End date</label>
              <DayPickerInput
                onDayChange={(day: Date) => {
                  const formattedDate = moment(day).format(FORMAT);
                  setValue("endDate", formattedDate, {
                    shouldValidate: true,
                    shouldDirty: true,
                  });
                }}
                format={FORMAT}
                formatDate={formatDate}
                dayPickerProps={{
                  todayButton: "Today",
                  disabledDays: [
                    {
                      before: moment(watchStartDate).toDate(),
                      after: today,
                    },
                  ],
                }}
                component={renderEndDateInput}
              />
              {errors.endDate && (
                <ErrorMessage message={errors.endDate.message} />
              )}
            </div>
          </div>
        </div>
        <div className="form-group">
          <div className="row">
            <div className="col-12 col-sm-6">
              <label htmlFor="symbol">Symbol</label>
              <CustomSelect
                symbols={symbols}
                formRef={register({
                  required: {
                    value: true,
                    message: "Symbol is required",
                  },
                })}
              />
              {errors.symbol && (
                <ErrorMessage message={errors.symbol.message} />
              )}
            </div>
            <div className="col-12 col-sm-6">
              <label htmlFor="email">Email</label>
              <input
                id="email"
                name="email"
                type="email"
                className="form-control"
                ref={register({
                  required: {
                    value: true,
                    message: "Email is required",
                  },
                  pattern: {
                    value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/i,
                    message: "invalid email address",
                  },
                })}
              />
              {errors.email && <ErrorMessage message={errors.email.message} />}
            </div>
          </div>
        </div>
        <div className="form-group">
          <div className="row justify-content-center">
            {!isLoading ? (
              <div className="col-6">
                <button
                  id="submit-btn"
                  data-testid="resolved"
                  type="submit"
                  className="btn btn-primary w-100"
                >
                  Submit
                </button>
              </div>
            ) : (
              <div className="col-6">
                <button
                  data-testid="loading"
                  className="btn btn-primary w-100"
                  disabled
                >
                  Loading
                </button>
              </div>
            )}
          </div>
        </div>
      </form>
    </>
  );
}

export default Form;
