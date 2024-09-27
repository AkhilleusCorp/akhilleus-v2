import React, {ReactNode} from "react";
import {useNavigate} from "react-router-dom";
import Card from "../card/Card.tsx";
import CardFooter from "../card/CardFooter.tsx";

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
        <Card>
            <form onSubmit={handleSubmit}>
                {children}
                <CardFooter shouldBeDisplayed={true}>
                    <button type={"button"} className={"btn-cancel"} onClick={() => navigate(-1)}>Cancel</button>
                    <button type={"submit"} className={"btn-validate"}>Save</button>
                </CardFooter>
            </form>
        </Card>
    );
};

export default SaveForm;