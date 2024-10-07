import React, {ReactNode} from "react";
import {Button, Card, CardActions, CardContent, FormControl, Grid2 as Grid} from "@mui/material";

type SearchFormProps = {
    searchFunction: (filters: any) => void;
    filters: any;
    children: ReactNode;
};

const SearchForm: React.FC<SearchFormProps> = ({ searchFunction, filters, children }) => {
    const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
        event.preventDefault();
        searchFunction(filters);
    };

    return (
        <Card>
            <form onSubmit={handleSubmit}>
                <CardContent>
                    <FormControl fullWidth>
                        <Grid container spacing={2}>
                            {children}
                        </Grid>
                    </FormControl>
                </CardContent>

                <CardActions style={{justifyContent: 'center'}}>
                    <Button type={"submit"} variant="contained">Search</Button>
                </CardActions>
            </form>
        </Card>
    );
};

export default SearchForm;