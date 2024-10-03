import React, {useState} from 'react';
import {Link} from "react-router-dom";
import websiteRoutes from "../../setup/router/websiteRoutes.tsx";
import {Box, Collapse, Divider, List, ListItem, ListItemButton, ListItemText} from "@mui/material";
import {ExpandLess, ExpandMore} from "@mui/icons-material";

const AdminSidebar: React.FC = () => {
    const [open, setOpen] = useState(false);

    const handleClick = () => {
        setOpen(!open);
    };

    return (
        <aside id={"main-logged-menu"}>
            <List>
                <ListItemButton component="a" href="/">
                    <ListItemText >
                        Akhilleus
                    </ListItemText>
                </ListItemButton>

                <Divider />

                <ListItem component={Link} to={websiteRoutes.dashboard}>
                    <ListItemText >
                        Dashboard
                    </ListItemText>
                </ListItem>
                <ListItem component={Link} to={websiteRoutes.user.list}>
                    <ListItemText >
                        Users
                    </ListItemText>
                </ListItem>
                <Box>
                    <ListItemButton onClick={handleClick}>
                        <ListItemText >
                            Training
                        </ListItemText>
                        {open ? <ExpandLess /> : <ExpandMore />}
                    </ListItemButton>
                    <Collapse in={open} timeout="auto" unmountOnExit>
                        <List component="div" disablePadding>
                            <ListItem sx={{ pl: 4 }} component={Link} to={websiteRoutes.workout.list}>
                                <ListItemText>
                                    Workouts
                                </ListItemText>
                            </ListItem>
                        </List>
                    </Collapse>
                </Box>
            </List>
        </aside>
    );
}

export default AdminSidebar;