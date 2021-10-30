import React from "react";
import Tile from "./Tile";
import emPedia from "./emoji";

function emojiTile(emoji) {
    return <Tile
        key={emoji.id}
        emoji={emoji.emoji}
        name={emoji.name}
        desc={emoji.meaning}
    />
}


function App() {
    return (
        <div>
            <h1>
                <span>emojipedia</span>
            </h1>

            <dl className="dictionary">
                {emPedia.map(emojiTile)}
            </dl>
        </div>
    );
}

export default App;
