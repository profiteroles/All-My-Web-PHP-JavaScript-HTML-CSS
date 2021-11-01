import react from "react";
import Header from "./Header";
import Footer from "./Footer";
import Tile from "./Tile";
import notes from "./notes";

function App() {
    return (<div>
        <Header />
        {notes.map(note => (
            <Tile
                key={note.key}
                title={note.title}
                content={note.content}
            />
        ))}

        <Footer />
    </div>);
}

export default App;
