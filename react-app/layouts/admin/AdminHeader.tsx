import React from 'react';
import {
    AppBar,
    Badge, Box,
    Container, Divider, IconButton, Menu, MenuItem,
    Toolbar, Typography
} from "@mui/material";
import websiteRoutes from "../../config/routes/websiteRoutes.tsx";
import MailIcon from '@mui/icons-material/Mail';
import NotificationsIcon from '@mui/icons-material/Notifications';
import AccountCircle from '@mui/icons-material/AccountCircle';
import SearchInput from "../../widget/common/input/SearchInput.tsx";

const AdminHeader: React.FC = () => {
    const [anchorElUser, setAnchorElUser] = React.useState<null | HTMLElement>(null);

    const handleOpenUserMenu = (event: React.MouseEvent<HTMLElement>) => {
        setAnchorElUser(event.currentTarget);
    };

    const handleCloseUserMenu = () => {
        setAnchorElUser(null);
    };

    const renderMenu = (
        <Menu
            anchorEl={anchorElUser}
            anchorOrigin={{
                vertical: 'bottom',
                horizontal: 'right',
            }}
            keepMounted
            transformOrigin={{
                vertical: 'top',
                horizontal: 'right',
            }}
            open={Boolean(anchorElUser)}
            onClose={handleCloseUserMenu}
        >
            <MenuItem>
                <Typography>Profile</Typography>
            </MenuItem>
            <MenuItem>
                <Typography>Settings</Typography>
            </MenuItem>

            <Divider />

            <MenuItem>
                <Typography>
                    <a href={websiteRoutes.logout}>Logout</a>
                </Typography>
            </MenuItem>
        </Menu>
    );

    return (
        <Box>
            <AppBar position="sticky">
                <Container maxWidth={false}>
                    <Toolbar>
                        <SearchInput />
                        <Box sx={{ flexGrow: 1 }} />
                        <Box sx={{ display: { xs: 'none', md: 'flex' } }}>
                            <IconButton size="large" aria-label="show 4 new mails" color="inherit">
                                <Badge badgeContent={4} color="error">
                                    <MailIcon />
                                </Badge>
                            </IconButton>
                            <IconButton
                                size="large"
                                aria-label="show 17 new notifications"
                                color="inherit"
                            >
                                <Badge badgeContent={17} color="error">
                                    <NotificationsIcon />
                                </Badge>
                            </IconButton>
                            <IconButton
                                size="large"
                                edge="end"
                                aria-label="account of current user"
                                aria-haspopup="true"
                                onClick={handleOpenUserMenu}
                                color="inherit"
                            >
                                <AccountCircle />
                            </IconButton>
                        </Box>
                    </Toolbar>
                </Container>
            </AppBar>
            {renderMenu}
        </Box>
    );
}

export default AdminHeader;