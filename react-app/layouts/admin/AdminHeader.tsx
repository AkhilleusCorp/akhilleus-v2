import React from 'react';
import {AppBar, Container, Toolbar} from "@mui/material";

const AdminHeader: React.FC = () => {
    return (
        <AppBar position="sticky">
            <Container maxWidth="xl">
                <Toolbar disableGutters>

                </Toolbar>
            </Container>


        </AppBar>
    );
}

export default AdminHeader;