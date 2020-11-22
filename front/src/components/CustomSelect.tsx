import React from "react";
import { SymbolsInterface } from "../interfaces/symbols.interface";

interface CustomSelectProps {
  symbols: SymbolsInterface[];
  formRef: any;
}

function CustomSelect({ symbols, formRef }: CustomSelectProps) {
  return (
    <>
      <select
        id="symbol"
        defaultValue=""
        name="symbol"
        ref={formRef}
        className="custom-select"
      >
        <option value="" disabled>
          Select
        </option>
        {symbols.map((data) => {
          return (
            <option key={data.value} value={data.value}>
              {data.label}
            </option>
          );
        })}
      </select>
    </>
  );
}

export default CustomSelect;
