import React from "react";
import Dropdown from "react-bootstrap/Dropdown";

const ColorDropdown = ({ onSelectColor }) => {
    const colors = ["#ffaaaa", "#fff8c6", "#c6f8ff"]; // List of colors (light red, light yellow, light blue)
    const priorities = ["High", "Medium", "Low"]; // List of priorities

    return (
        <div style={{ display: "inline-block" }}>
            <Dropdown style={{ width: "150px" }}>
                <Dropdown.Toggle variant="primary" id="dropdown-basic" style={{ backgroundColor: "white", color: "black", borderColor: "transparent", fontFamily: "Audiowide, sans-serif", marginLeft: "10px" }}>
                    Select Priority
                </Dropdown.Toggle>

                <Dropdown.Menu>
                    {colors.map((color, index) => (
                        <Dropdown.Item key={index} onClick={() => onSelectColor(color)}>
                            {priorities[index]}
                        </Dropdown.Item>
                    ))}
                </Dropdown.Menu>
            </Dropdown>
        </div>
    );
};

export default ColorDropdown;
