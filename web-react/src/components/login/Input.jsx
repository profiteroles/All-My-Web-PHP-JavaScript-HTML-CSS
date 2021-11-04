
function Input(props) {
    return (
        <input
            onChange={props.change}
            name={props.name}
            type={props.type}
            placeholder={props.placeholder}
            value={props.value} />
    );
}

export default Input;

{/* <input type={props.type} placeholder={props.placeholder} /> */ }