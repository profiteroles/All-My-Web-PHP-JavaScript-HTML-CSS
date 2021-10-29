import react from "react";
import Avatar from "./Avatar";
import Card from "./Card";
import contacts from "./contacts";

function cardWidget(contact) {
    return <Card
        key={contact.id}
        name={contact.name}
        phone={contact.phone}
        email={contact.email}
        img={contact.imgURL} />;

}

function App() {
    return (<div>
        <h1 className="heading">My Contacts</h1>
        <Avatar img={contacts[1].imgURL} />
        {contacts.map(cardWidget)}
    </div>);
}

export default App;
