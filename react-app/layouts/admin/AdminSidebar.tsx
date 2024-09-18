import React from 'react';
import {Link} from "react-router-dom";
import HomeIcon from '@mui/icons-material/Home';
import PeopleAltIcon from '@mui/icons-material/PeopleAlt';

const AdminSidebar: React.FC = () => {
    return (
        <aside id={"main-menu"}>
            <header>
                <h1>Akhilleus</h1>
            </header>
            <nav>
                <ul>
                    <li><Link to='/'><HomeIcon />Home</Link></li>
                    <li><Link to='/users'><PeopleAltIcon />Users</Link></li>
                </ul>
            </nav>
        </aside>
    );
}

export default AdminSidebar;