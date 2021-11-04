import React, { useState } from "react";
import AddCircleIcon from '@material-ui/icons/AddCircle';
import Fab from '@material-ui/core/Fab';
import Zoom from '@material-ui/core/Zoom';
import { ZoomIn } from "@material-ui/icons";

function CreateArea(props) {

    const [isExpanded, setIsExpanded] = useState(false);
    const [notes, setNotes] = useState({
        title: '',
        content: ''
    });

    function handleChange(events) {
        const { name, value } = events.target;

        setNotes(prevValue => {
            return {
                ...prevValue,
                [name]: value
            };
        });
    }

    function submitNote(event) {
        props.onSubmission(notes);
        setNotes({
            title: "",
            content: ""
        });
        setIsExpanded(false);
        event.preventDefault();
    }

    function expand() {
        setIsExpanded(true);
    }

    return (
        <div>
            <form className="create-note">
                {!isExpanded ? null :
                    <input onChange={handleChange} name="title" placeholder="Title" value={notes.title} />
                }
                <textarea
                    onClick={expand}
                    onChange={handleChange}
                    name="content"
                    placeholder="Take a note..."
                    rows={isExpanded ? '3' : '1'}
                    value={notes.content} />
                <Zoom in={isExpanded}>
                    <Fab onClick={submitNote}>
                        <AddCircleIcon />
                    </Fab>
                </Zoom>
            </form>
        </div>

    );
}

export default CreateArea;