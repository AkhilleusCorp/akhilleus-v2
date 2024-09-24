import React from 'react';
import {Link} from "react-router-dom";
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
                    <li><Link to={routes.dashboard}>Dashboard</Link></li>
                    <li><Link to={routes.user.list}>Users</Link></li>
                    <li><Link to={routes.workout.list}>Workout</Link></li>
                </ul>
            </nav>
        </aside>
    );
}

export default AdminSidebar;