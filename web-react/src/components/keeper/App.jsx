import Header from "./Header";
import Footer from "./Footer";
import Note from "./Note";
import CreateArea from "./CreateArea";
import { useState } from "react";


function App() {

    const [listNotes, setListNotes] = useState([]);


    function addNote(note) {
        setListNotes([...listNotes, note]);
    }
    function removeNote(id) {
        setListNotes(prevNotes => {
            return prevNotes.filter((note, i) => {
                return i !== id;
            });
        });
    }

    return (
        <div>
            <Header />
            <CreateArea
                onSubmission={addNote}
            />
            {listNotes.map((note, i) => (
                <Note
                    id={i}
                    key={i}
                    onRemove={removeNote}
                    title={note.title}
                    content={note.content} />
            ))}
            <Footer />
        </div>
    );
}

export default App;