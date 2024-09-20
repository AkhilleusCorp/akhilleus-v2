import React from 'react';

const AdminHeader: React.FC = () => {
    return (
        <header id={"main-logged-header"}>
            <div className={"float-left"}>
                Some search bar or other ?
            </div>
            <div className={"float-right"}>
                <ul className={"inline"}>
                    <li>Notifications</li>
                    <li>Profile</li>
                    <li>
                        <a href={"/logout"}>Logout</a>
                    </li>
                </ul>
            </div>
        </header>
    );
}

export default AdminHeader;