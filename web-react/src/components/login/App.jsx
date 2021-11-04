import React, { useState } from "react";
import Button from "./Button";
import Input from "./Input";

const currentHour = new Date().getHours();

const currentMinute = new Date().getMinutes();

const time = currentHour + ":" + currentMinute;

var isRegistered = false;


function App() {

    const [contact, setContact] = useState({
        fName: '',
        lName: '',
        email: ''
    });

    function handleChange(event) {
        const { name, value } = event.target;

        setContact(prevValue => {
            return {
                ...prevValue,
                [name]: value
            };
        });
    }

    return (
        <div className="container">
            <h1>Hello {contact.fName} {contact.lName}</h1>
            <p>{contact.email}</p>
            <form>
                <Input
                    change={handleChange}
                    name="fName"
                    type="text"
                    placeholder="First Name"
                    value={contact.fName} />
                <Input
                    change={handleChange}
                    name="lName"
                    type="text"
                    placeholder="Last Name"
                    value={contact.lName} />
                <Input
                    change={handleChange}
                    name="email"
                    type="email"
                    placeholder="youremail@example.com"
                    value={contact.email} />

                <Button title={isRegistered ? "Login" : "Register"} />
            </form>
        </div>
    );
}

export default App;
