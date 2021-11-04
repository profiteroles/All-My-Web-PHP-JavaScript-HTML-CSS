import React, { useState } from "react";
import ListItem from "./ListItem";
import InputArea from "./InputArea";

function App() {

    const [items, setItems] = useState([]);

    function addItem(itemValue) {
        setItems([...items, itemValue]);
    }

    function removeItem(id) {
        setItems(prevItem => {
            return prevItem.filter((item, index) => {
                return index !== id;
            });
        });
    }

    return (
        <div className="container">
            <div className="heading">
                <h1>To-Do List</h1>
            </div>
            <InputArea
                onAdd={addItem}
            />
            <div>
                <ul>
                    {items.map((item, index) => <ListItem
                        id={index}
                        key={index}
                        remove={removeItem}
                        value={item} />)}
                </ul>
            </div>
        </div>
    );
}

export default App;
