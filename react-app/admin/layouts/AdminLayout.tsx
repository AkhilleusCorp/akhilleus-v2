import React from 'react';
import {Box} from "@mui/material";
import AdminSidebar from "app/admin/layouts/AdminSidebar.tsx";
import AdminFooter from "app/admin/layouts/AdminFooter.tsx";
import AdminHeader from "app/admin/layouts/AdminHeader.tsx";

interface AdminLayoutType {
    children: React.ReactNode
}

const AdminLayout: React.FC<AdminLayoutType> = (props) => {
    return (
        <>
            <AdminSidebar />
            <div id={"main-logged-content"}>
                <Box sx={{ flexGrow: 1 }}>
                    <AdminHeader />
                    <main id={"logged-page-body"}>
                        {props.children}
                    </main>
                </Box>
            </div>
            <AdminFooter />
        </>
    );
}

export default AdminLayout;