import React from 'react';
import AdminSidebar from "./AdminSidebar.tsx";
import AdminFooter from "./AdminFooter.tsx";

interface Props {
    children: React.ReactNode
}

const AdminLayout: React.FC<Props> = (props) => {
    return (
        <>
            <AdminSidebar />
            <main>
                {props.children}
            </main>
            <AdminFooter />
        </>
    );
}

export default AdminLayout;