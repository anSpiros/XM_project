import React from "react";
import { ErrorMessageInterface } from "../interfaces/error-message.interface";

function ErrorMessage({ message }: ErrorMessageInterface) {
  return (
    <>
      {message && (
        <p data-testid="error-message" className="error-message text-danger">
          {message}
        </p>
      )}
    </>
  );
}

export default ErrorMessage;
