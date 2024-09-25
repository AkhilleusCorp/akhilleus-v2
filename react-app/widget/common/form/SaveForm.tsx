import React, {ReactNode} from "react";
import {useNavigate} from "react-router-dom";

type SaveFormProps = {
    submitFunction: () => void;
    children: ReactNode;
};

const SaveForm: React.FC<SaveFormProps> = ({ submitFunction, children }) => {
    const navigate = useNavigate();

    const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        submitFunction()
    };

    return (
        <form onSubmit={handleSubmit}>
            {children}
            <div>
                <button type={"button"} className={"btn-cancel"} onClick={() => navigate(-1)}>Cancel</button>
                <button type={"submit"} className={"btn-validate"}>Save</button>
            </div>
        </form>
    );
};

export default SaveForm;