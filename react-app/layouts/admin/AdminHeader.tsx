import React from 'react';
import routes from "../../infrastructure/router/routes-mapping.tsx";

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
                        <a href={routes.logout}>Logout</a>
                    </li>
                </ul>
            </div>
        </header>
    );
}

export default AdminHeader;