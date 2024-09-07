import React from 'react';
import {Link} from "react-router-dom";

const AdminSidebar: React.FC = () => {
    return (
        <aside>
            <h3>Menu</h3>
            <ul>
                <li><Link to='/'>Home</Link></li>
                <li><Link to='/users'>Users</Link></li>
            </ul>
        </aside>
    );
}

export default AdminSidebar;