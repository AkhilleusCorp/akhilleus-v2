import React from 'react';
import AdminSidebar from "./AdminSidebar.tsx";
import AdminFooter from "./AdminFooter.tsx";
import AdminHeader from "./AdminHeader.tsx";

interface Props {
    children: React.ReactNode
}

const AdminLayout: React.FC<Props> = (props) => {
    return (
        <>
            <AdminSidebar />
            <div id={"main-content"}>
                <AdminHeader />
                <main id={"page-body"}>
                    {props.children}
                </main>
            </div>
            <AdminFooter />
        </>
    );
}

export default AdminLayout;