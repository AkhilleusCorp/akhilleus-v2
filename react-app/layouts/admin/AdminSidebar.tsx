import React from 'react';
import {Link} from "react-router-dom";
import websiteRoutes from "../../config/routes/website-routes.tsx";

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
                    <li><Link to={websiteRoutes.dashboard}>Dashboard</Link></li>
                    <li><Link to={websiteRoutes.user.list}>Users</Link></li>
                    <li><Link to={websiteRoutes.workout.list}>Workouts</Link></li>
                </ul>
            </nav>
        </aside>
    );
}

export default AdminSidebar;