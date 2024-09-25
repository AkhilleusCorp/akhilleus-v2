import React, {ReactNode} from "react";

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
        <form onSubmit={handleSubmit}>
            {children}
            <div>
                <button type={"button"} className={"btn-cancel"} onClick={handleCancel}>Cancel</button>
                <button type={"submit"} className={"btn-validate"}>Search</button>
            </div>
        </form>
    );
};

export default SearchForm;