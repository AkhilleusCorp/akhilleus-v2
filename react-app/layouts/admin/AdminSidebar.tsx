import React from 'react';
import {Link} from "react-router-dom";
import HomeIcon from '@mui/icons-material/Home';
import PeopleAltIcon from '@mui/icons-material/PeopleAlt';
import routes from "../../infrastructure/router/routes-mapping.tsx";

const AdminSidebar: React.FC = () => {
    return (
        <aside id={"main-logged-menu"}>
            <header>
                <h1>
                    <a href={'/'} title={"Website homepage"}>
                        Akhilleus
                    </a>
                </h1>
            </header>
            <nav>
                <ul>
                    <li><Link to={routes.dashboard}><HomeIcon />Dashboard</Link></li>
                    <li><Link to={routes.userList}><PeopleAltIcon />Users</Link></li>
                </ul>
            </nav>
        </aside>
    );
}

export default AdminSidebar;