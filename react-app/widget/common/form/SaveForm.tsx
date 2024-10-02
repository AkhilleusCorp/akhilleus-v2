import React, {ReactNode} from "react";
import {useNavigate} from "react-router-dom";
import {Box, Button, Card, CardActions, CardContent} from "@mui/material";

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
                    <Box sx={{'& .MuiTextField-root': {m: 1, width: '25ch'}}}>
                        {children}
                    </Box>
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