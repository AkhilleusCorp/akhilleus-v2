import React, {ReactNode} from "react";
import {useNavigate} from "react-router-dom";
import {Button, Card, CardActions, CardContent, FormControl, Grid2 as Grid} from "@mui/material";

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
                <CardContent>
                    <FormControl fullWidth>
                        <Grid container spacing={2}>
                            {children}
                        </Grid>
                    </FormControl>
                </CardContent>

                <CardActions>
                    <Button type={"button"} variant="outlined" onClick={() => navigate(-1)}>Cancel</Button>
                    <Button type={"submit"} variant="contained">Save</Button>
                </CardActions>
            </form>
        </Card>
    );
};

export default SaveForm;