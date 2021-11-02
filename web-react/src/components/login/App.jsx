import React, { useState } from "react";
import Form from "./Form";
import Input from "./Input";
import Button from "./Button";



const currentHour = new Date().getHours();

const currentMinute = new Date().getMinutes();

const time = currentHour + ":" + currentMinute;


const [name, setName] = useState('');
const [surname, setSurname] = useState('');

var isRegistered = false;

function clickHanler(event) {
    setName(event.target.value);
    event.preventDefault()
}

function App() {
    return (
        <div className="container">
            <h1>{time}</h1>
            <h1>Hi { }</h1>
            <form className="form" onSubmit={clickHanler}>
                <Input type="text" placeholder="Username" value={name} />
                <Input type="password" placeholder="Password" value={surname} />
                {isRegistered && <Input type="password" placeholder="Confirm Password" />}
                <Button title={isRegistered ? "Register" : "Login"} />
            </form>
        </div>
    );
}

export default App;
