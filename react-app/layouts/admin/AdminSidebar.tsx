import React from 'react';
import {Link} from "react-router-dom";

const AdminSidebar: React.FC = () => {
    return (
        <aside id={"main-menu"}>
            <header>
                <h1>Akhilleus</h1>
            </header>
            <nav>
                <ul>
                    <li><Link to='/public'>Home</Link></li>
                    <li><Link to='/users'>Users</Link></li>
                </ul>
            </nav>
        </aside>
    );
}

export default AdminSidebar;