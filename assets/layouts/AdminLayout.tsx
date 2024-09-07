import React from 'react';
import AdminSidebar from "./AdminSidebar.tsx";
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
            <footer>Footer</footer>
        </>
    );
}

export default AdminLayout;