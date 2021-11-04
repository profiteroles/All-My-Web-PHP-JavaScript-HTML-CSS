import React, { useState } from "react";

function App() {
    const [isMouseOver, setMouseOver] = useState(false);
    const [name, setName] = useState("");
    const [headTitle, setHeadTitle] = useState('');

    function mouseHoverHandler() {
        setMouseOver(true);
    }
    function mouseOutHandler() {
        setMouseOver(false);
    }

    function inputHandler(event) {
        setName(event.target.value);
    }

    function clickHanler(event) {
        setHeadTitle(name);
        event.preventDefault();
    }

    return (
        <div className="container">
            <h1>Hello {headTitle}</h1>
            <form onSubmit={clickHanler}>
                <input
                    type="text"
                    placeholder="What's your name?"
                    onChange={inputHandler}
                    value={name}
                />
                <button
                    type="submit"
                    style={{ "backgroundColor": isMouseOver ? "black" : "white" }}
                    onMouseOver={mouseHoverHandler}
                    onMouseOut={mouseOutHandler}
                >Submit</button>
            </form>
        </div>
    );
}

export default App;