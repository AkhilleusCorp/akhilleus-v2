import React, {ReactNode} from "react";
import Card from "../card/Card.tsx";

type SearchFormProps = {
    searchFunction: (filters: any) => void;
    cancelFunction: () => void;
    filters: any;
    children: ReactNode;
};

const SearchForm: React.FC<SearchFormProps> = ({ searchFunction, cancelFunction, filters, children }) => {
    const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        searchFunction(filters);
    };

    const handleCancel = () => {
        cancelFunction();
    }

    return (
        <Card>
            <form onSubmit={handleSubmit}>
                <div className={"columns"}>
                    {children}
                </div>
                <div className={"form-search-actions"}>
                    <button type={"button"} className={"btn-cancel"} onClick={handleCancel}>Cancel</button>
                    <button type={"submit"} className={"btn-validate"}>Search</button>
                </div>
            </form>
        </Card>
    );
};

export default SearchForm;