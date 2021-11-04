import { useState } from "react";

function InputArea(props) {

    const [listValue, setListValue] = useState('');


    function handleChange(event) {
        const newValue = event.target.value;
        setListValue(newValue);

    }



    return (
        <div className="form">

            <input
                onChange={handleChange}
                name="newItem"
                value={listValue}
                type="text" />
            <button onClick={() => {
                props.onAdd(listValue, setListValue);
                setListValue('');
            }}>
                <span>Add</span>
            </button>

        </div>
    );
}

export default InputArea;