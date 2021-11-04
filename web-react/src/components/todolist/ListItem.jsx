import { useState } from "react";


function ListItem(props) {
    const [isDone, setIsDone] = useState(false);

    function handleClick() {
        setIsDone(!isDone);
    }

    return (
        <li
            onDoubleClick={() => { props.remove(props.id); }}
            onClick={handleClick}
            style={{ textDecoration: isDone ? "line-through" : "none" }}>
            {props.value}
        </li>
    );
}

export default ListItem;