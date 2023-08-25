import React, { useState } from "react";
import { Link } from "@inertiajs/inertia-react";

export default ({ fields }) => {
    const [state, setState] = useState({});

    const handleChange = (event) => {
        const { name, value } = event.target;
        setState((prevState) => ({ ...prevState, [name]: value }));
    };

    const handleSubmit = (event) => {
        event.preventDefault();

        // code to submit the form
    };    

    return (
        <form onSubmit={handleSubmit}>
            {fields.map((field, index) => {
                return (
                    <div key={index} className="form-floating">
                        <input
                            type={field.type}
                            id={field.id}
                            name={field.name}
                            className="form-control"
                            onChange={handleChange}
                        />
                        <label 
                            htmlFor={field.id}>{field.label}
                        </label>
                    </div>
                );
            })}

            <div className="">
                <button className="btn btn-success btn-block" type="submit">Login</button>
            </div>

        </form>
    )
}