import React, { useState } from "react";
import Form from "./Form";
import { useState } from "react";


var isRegistered = false;

const currentHour = new Date().getHours();

const currentMinute = new Date().getMinutes();

const time = currentHour + ":" + currentMinute;

function App() {
    return (
        <div className="container">
            <h1>Hi There</h1>
            <Form isRegistered={isRegistered} />
        </div>
    );
}

export default App;
