import React, {ReactNode} from "react";
import {Button, Card, CardActions, CardContent} from "@mui/material";

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
                <CardContent>
                    <div className={"columns"}>
                        {children}
                    </div>
                </CardContent>

                <CardActions>
                    <Button type={"button"} variant="outlined" onClick={handleCancel}>Cancel</Button>
                    <Button type={"submit"} variant="contained">Search</Button>
                </CardActions>
            </form>
        </Card>
    );
};

export default SearchForm;