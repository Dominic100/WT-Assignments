import React from "react";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import "./CustomDatePicker.css";

const CustomDatePicker = ({ selected, onChange }) => {
    const currentYear = new Date().getFullYear();

    return (
        <div className="custom-datepicker">
            <DatePicker
                selected={selected}
                onChange={onChange}
                placeholderText="Select Due Date"
                dateFormat="dd/MM/yyyy"
                yearDropdownItemNumber={50}
                scrollableYearDropdown
                dropdownMode="scroll"
                showYearDropdown
                showMonthDropdown
                minDate={new Date(currentYear, 0, 1)}
                maxDate={new Date().setFullYear(currentYear + 50)}
            />
        </div>
    );
};

export default CustomDatePicker;