import React from 'react';
import websiteRoutes from "../../config/routes/website-routes.tsx";

const AdminHeader: React.FC = () => {
    return (
        <header id={"main-logged-header"}>
            <div className={"float-left"}>
                <input type={"test"} placeholder={"Search a user"}/>
            </div>
            <div className={"float-right"}>
                <ul className={"inline"}>
                    <li><a>Notifications</a></li>
                    <li><a>Profile</a></li>
                    <li>
                        <a href={websiteRoutes.logout}>Logout</a>
                    </li>
                </ul>
            </div>
        </header>
    );
}

export default AdminHeader;