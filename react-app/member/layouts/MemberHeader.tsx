import React from 'react';
import {
    AppBar,
    Badge, Box, Button,
    Container, Divider, IconButton, Menu, MenuItem,
    Toolbar, Typography
} from "@mui/material";
import MailIcon from '@mui/icons-material/Mail';
import NotificationsIcon from '@mui/icons-material/Notifications';
import AccountCircle from '@mui/icons-material/AccountCircle';
import AdbIcon from '@mui/icons-material/Adb';
import memberRoutes from "app/member/services/router/memberRoutes.tsx";
import {useNavigate} from "react-router-dom";

type navigationItem = {
    label: string,
    route: string,
}

const MemberHeader: React.FC = () => {
    const [anchorElUser, setAnchorElUser] = React.useState<null | HTMLElement>(null);
    const navigate = useNavigate();

    const handleOpenUserMenu = (event: React.MouseEvent<HTMLElement>) => {
        setAnchorElUser(event.currentTarget);
    };

    const handleCloseUserMenu = () => {
        setAnchorElUser(null);
    };
    const navigateToPage = (event: React.MouseEvent<HTMLSpanElement>, route: string) => {
        event.preventDefault();
        navigate(route);
    }

    const navigationConfig: navigationItem[] = [
        {'label': 'dashboard', 'route': memberRoutes.dashboard},
    ]

    const renderMemberMenu = (
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
                    <a href={memberRoutes.logout}>Logout</a>
                </Typography>
            </MenuItem>
        </Menu>
    );

    return (
        <Box>
            <AppBar position="sticky">
                <Container maxWidth={false}>
                    <Toolbar disableGutters>
                        <AdbIcon sx={{ display: { xs: 'none', md: 'flex', color: 'white' }, mr: 1 }} />
                        <Typography
                            variant="h6"
                            noWrap
                            component="a"
                            href="#"
                            onClick={(event) => navigateToPage(event, memberRoutes.dashboard)}
                            sx={{
                                mr: 2,
                                display: { xs: 'none', md: 'flex' },
                                fontFamily: 'monospace',
                                fontWeight: 700,
                                letterSpacing: '.3rem',
                                color: 'white',
                                textDecoration: 'none',
                            }}
                        >
                            Ahilleus
                        </Typography>
                        <Box sx={{ flexGrow: 1, display: { xs: 'none', md: 'flex' } }}>
                            { navigationConfig.map((navigation) => (
                                <Button key={'key-'+navigation.label} sx={{ my: 2, color: 'white', display: 'block' }}
                                        onClick={(event) => navigateToPage(event, navigation.route)}>
                                    {navigation.label}
                                </Button>
                            ))}
                        </Box>
                        <Box sx={{ flexGrow: 0 }}>
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
            {renderMemberMenu}
        </Box>
    );
}

export default MemberHeader;