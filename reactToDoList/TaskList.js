import React from 'react';
import {DragDropContext, Droppable} from 'react-beautiful-dnd';
import TaskItem from './TaskItem';

const TaskList = ({ tasks, rearrangeMode, deleteItem, editItem, completeItem, priorityItem, onDragEnd }) => {
    return (
        <DragDropContext onDragEnd={onDragEnd}>
            <Droppable droppableId="droppable">
                {(provided) => (
                    <div {...provided.droppableProps} ref={provided.innerRef}>
                        {tasks.map((item, index) => (
                            <TaskItem
                                key={item.id}
                                item={item}
                                index={index}
                                deleteItem={deleteItem}
                                editItem={editItem}
                                completeItem={completeItem}
                                priorityItem={priorityItem}
                                rearrangeMode={rearrangeMode}
                            />
                        ))}
                        {provided.placeholder}
                    </div>
                )}
            </Droppable>
        </DragDropContext>
    );
};

export default TaskList;