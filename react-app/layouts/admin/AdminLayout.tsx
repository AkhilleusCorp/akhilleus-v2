import React from 'react';
import AdminSidebar from "./AdminSidebar.tsx";
import AdminFooter from "./AdminFooter.tsx";
import AdminHeader from "./AdminHeader.tsx";
import {Box} from "@mui/material";

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