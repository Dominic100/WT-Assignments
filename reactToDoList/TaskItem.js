// TaskItem.js
import React from 'react';
import { ListGroup, Button } from 'react-bootstrap';
import ColorDropdown from './ColorDropdown';
import PropTypes from 'prop-types';
import { Draggable } from 'react-beautiful-dnd';

const TaskItem = ({ item, index, deleteItem, editItem, completeItem, priorityItem, rearrangeMode }) => {

    const getPriorityFontWeight = (priorityColor) => {
        switch (priorityColor) {
            case "#ffaaaa":
                return "bold";
            case "#fff8c6":
                return "normal";
            case "#c6f8ff":
                return "lighter";
            default:
                return "lighter";
        }
    };

    const getPriorityFontSize = (priorityColor) => {
        switch (priorityColor) {
            case "#ffaaaa":
                return "22px";
            case "#fff8c6":
                return "20px";
            case "#c6f8ff":
                return "18px"
            default:
                return "18px";
        }
    };

    const getPriorityFontColor = (priorityColor) => {
        switch (priorityColor) {
            case "#ffaaaa":
                return "#9441bc";
            default:
                return "black";
        }
    };

    const isTaskOverdue = (dueDate) => {
        if (!dueDate) return false; // If no due date, not overdue
        const today = new Date();
        return today > dueDate;
    };

    return (
        <Draggable draggableId={item.id} index={index} isDragDisabled={rearrangeMode}>
            {(provided) => (
                <div
                    ref={provided.innerRef}
                    {...provided.draggableProps}
                    {...provided.dragHandleProps}
                >
                    <div style={{ width: "900px", marginLeft: "-175px", minHeight: "100px", display: "flex", alignItems: "center" }}>
                        <ListGroup.Item
                            action
                            style={{
                                backgroundColor: isTaskOverdue(item.dueDate) ? "lightgray" : (item.priorityColor ? item.priorityColor : "#c6f8ff"),
                                fontWeight: getPriorityFontWeight(item.priorityColor),
                                fontSize: getPriorityFontSize(item.priorityColor),
                                fontFamily: "Audiowide, sans-serif",
                                color: getPriorityFontColor(item.priorityColor),
                                minHeight: "100px",
                                wordWrap: "break-word", // Add word-wrap property
                                border: ".2px solid gray", // Remove the border
                                borderRadius: "10px"
                            }}
                        >
                            <div>
                                <div>{item.value}</div>
                                {item.description && <div style={{ fontSize: "14px", color: "black", fontWeight: "lighter" }}>{item.description}</div>}
                                <div style={{ fontSize: "14px", fontStyle: "italic", color: "black", fontWeight: "lighter" }}>
                                    Due: {item.dueDate ? item.dueDate.toLocaleDateString() : "Not Set"}
                                </div>
                            </div>
                        </ListGroup.Item>
                        {!rearrangeMode && (
                            <div>
                                <Button
                                    style={{
                                        fontFamily: "Audiowide, sans-serif",
                                        marginLeft: "10px",
                                    }}
                                    variant="light"
                                    onClick={() => deleteItem(item.id)}
                                >
                                    Delete
                                </Button>
                                <Button
                                    variant="light"
                                    style={{
                                        fontFamily: "Audiowide, sans-serif",
                                        marginLeft: "5px",
                                    }}
                                    onClick={() => editItem(index)}
                                >
                                    Edit
                                </Button>
                                <Button
                                    variant="light"
                                    style={{
                                        fontFamily: "Audiowide, sans-serif",
                                        marginLeft: "5px",
                                    }}
                                    onClick={() => completeItem(index)}
                                >
                                    Completed
                                </Button>
                                <ColorDropdown onSelectColor={(color) => priorityItem(index, color)} />
                            </div>
                        )}
                    </div>
                </div>
            )}
        </Draggable>
    );
};

TaskItem.propTypes = {
    item: PropTypes.object.isRequired,
    index: PropTypes.number.isRequired,
    deleteItem: PropTypes.func.isRequired,
    editItem: PropTypes.func.isRequired,
    completeItem: PropTypes.func.isRequired,
    priorityItem: PropTypes.func.isRequired,
};

export default TaskItem;