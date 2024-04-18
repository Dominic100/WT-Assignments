import React, { Component } from "react";
import "bootstrap/dist/css/bootstrap.css";
import { Container, Row, Col, InputGroup, FormControl, Button, ListGroup } from "react-bootstrap";
import { DragDropContext, Droppable, Draggable } from 'react-beautiful-dnd';
import CustomDatePicker from "./CustomDatePicker";
import TaskItem from "./TaskItem";

let link = document.createElement('link');
link.rel = 'stylesheet';
link.href = 'https://fonts.googleapis.com/css2?family=Audiowide&family=Bruno+Ace+SC&family=Bungee+Hairline&family=Flavors&family=Sixtyfour&display=swap';
document.head.appendChild(link);

class App extends Component {
    constructor(props) {
        super(props);

        this.state = {
            userInput: "",
            descriptionInput: "",
            list: [],
            completedList: [],
            priorityColor: {},
            dueDate: null
        };
    }

    updateInput(value) {
        this.setState({
            userInput: value,
        });
    }

    updateDescription(value) {
        this.setState({
            descriptionInput: value,
        });
    }

    addItem() {
        if (this.state.userInput !== "") {
            const userInput = {
                id: Math.random().toString(36).substring(7),
                value: this.state.userInput,
                description: this.state.descriptionInput,
                priorityColor: null,
                dueDate: this.state.dueDate
            };

            const list = [...this.state.list];
            list.push(userInput);

            this.setState({
                list,
                userInput: "",
                descriptionInput: "",
                dueDate: null
            });
        }
    }

    deleteItem(key) {
        const list = [...this.state.list];
        const updateList = list.filter((item) => item.id !== key);
        this.setState({
            list: updateList,
        });
    }

    editItem = (index) => {
        const todos = [...this.state.list];
        const editedTodo = prompt('Edit the todo:');
        if (editedTodo !== null && editedTodo.trim() !== '') {
            let updatedTodos = [...todos]
            updatedTodos[index].value = editedTodo
            this.setState({
                list: updatedTodos,
            });
        }
    }

    completeItem = (index) => {
        const completedItem = { ...this.state.list[index], completedAt: new Date() };
        const list = [...this.state.list];
        list.splice(index, 1);
        const completedList = [...this.state.completedList, completedItem];
        this.setState({
            list,
            completedList,
        });
    }

    priorityItem = (index, selectedColor) => {
        const currentList = [...this.state.list];
        const updatedList = currentList.map((item, i) => {
            if (i === index) {
                return { ...item, priorityColor: selectedColor };
            }
            return item;
        });

        this.setState({
            list: updatedList,
        });
    }

    getPriorityFontWeight = (priorityColor) => {
        switch (priorityColor) {
            case "high":
                return "bold";
            case "medium":
                return "normal";
            case "low":
                return "lighter";
            default:
                return "normal";
        }
    }

    onDragEnd = (result) => {
        if (!result.destination) {
            return;
        }

        const items = [...this.state.list];
        const [reorderedItem] = items.splice(result.source.index, 1);
        items.splice(result.destination.index, 0, reorderedItem);

        this.setState({ list: items });
    };

    render() {
        return (
            <Container>
                <Row
                    style={{
                        display: "flex",
                        justifyContent: "center",
                        alignItems: "center",
                        fontSize: "3rem",
                        fontWeight: "bolder",
                        fontFamily: "Audiowide, sans-serif",
                        color: "#ffcf00",
                    }}
                >
                    TODO LIST
                </Row>
                <hr />
                <Row>
                    <Col md={{ span: 5, offset: 4 }}>
                        <InputGroup className="mb-3" style={{marginLeft: "-55px"}}>
                            <FormControl
                                className="mx-auto"
                                placeholder="add item . . . "
                                size="lg"
                                value={this.state.userInput}
                                onChange={(item) => this.updateInput(item.target.value)}
                                aria-label="add something"
                                aria-describedby="basic-addon2"
                                style={{ width: "200px", marginLeft: "-15%", marginBottom: "10px", marginRight: "20px" }}
                            />
                        </InputGroup>
                        <InputGroup className="mb-3" style={{marginLeft: "-55px"}}>
                            <FormControl
                                placeholder="add description . . . "
                                value={this.state.descriptionInput}
                                onChange={(item) => this.updateDescription(item.target.value)}
                                aria-label="add description"
                                aria-describedby="basic-addon2"
                                style={{ width: "200px", marginBottom: "10px",  }}
                            />
                        </InputGroup>
                        <InputGroup style={{marginBottom: "20px", marginLeft: "60px"}}>
                            <CustomDatePicker
                                selected={this.state.dueDate}
                                onChange={date => this.setState({ dueDate: date })}
                            />
                            <Button
                                variant="dark"
                                style={{ fontFamily: "Audiowide, sans-serif", marginLeft: "20px", marginTop: "-5px", borderRadius: "10px" }}
                                onClick={() => this.addItem()}
                            >
                                ADD
                            </Button>
                        </InputGroup>
                    </Col>
                </Row>

                <Row>
                    <Col md={{ span: 5, offset: 4 }}>
                        <DragDropContext onDragEnd={this.onDragEnd}>
                            <Droppable droppableId="droppable">
                                {(provided) => (
                                    <div {...provided.droppableProps} ref={provided.innerRef}>
                                        {this.state.list.map((item, index) => (
                                            <Draggable key={item.id} draggableId={item.id} index={index}>
                                                {(provided) => (
                                                    <div
                                                        ref={provided.innerRef}
                                                        {...provided.draggableProps}
                                                        {...provided.dragHandleProps}
                                                    >
                                                        <TaskItem
                                                            item={item}
                                                            index={index}
                                                            deleteItem={this.deleteItem.bind(this)}
                                                            editItem={this.editItem.bind(this)}
                                                            completeItem={this.completeItem.bind(this)}
                                                            priorityItem={this.priorityItem.bind(this)}
                                                        />
                                                    </div>
                                                )}
                                            </Draggable>
                                        ))}
                                        {provided.placeholder}
                                    </div>
                                )}
                            </Droppable>
                        </DragDropContext>
                    </Col>
                </Row>
                <Row>
                    <Col md={{ span: 5, offset: 4 }}>
                        <h3 className="mt-4" style={{
                            textAlign: "center",
                            marginLeft: "-20%",
                            fontSize: "3rem",
                            fontWeight: "bolder",
                            fontFamily: "Audiowide, sans-serif",
                            color: "#ff8800",
                        }}>Completed Tasks</h3>
                        <ListGroup style={{marginLeft: "-30px"}}>
                            {this.state.completedList.map((item, index) => (
                                <ListGroup.Item key={index} variant="success" style={{ marginLeft: "-80px", fontWeight: this.getPriorityFontWeight(item.priority) }}>
                                    <div>{item.value}</div>
                                    <div>Completed at: {item.completedAt.toLocaleString()}</div>
                                </ListGroup.Item>
                            ))}
                        </ListGroup>
                    </Col>
                </Row>
            </Container>
        );
    }
}

export default App;