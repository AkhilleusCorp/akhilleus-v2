import React from 'react';
import {Link} from "react-router-dom";

const AdminSidebar: React.FC = () => {
    return (
        <aside>
                <h3>Menu</h3>
                <ul>
                    <li><Link to='/public'>Home</Link></li>
                    <li><Link to='/users'>Users</Link></li>
                </ul>
        </aside>
    );
}

export default AdminSidebar;