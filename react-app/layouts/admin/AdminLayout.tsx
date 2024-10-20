import React from 'react';
import {Box} from "@mui/material";
import {Provider} from "react-redux";
import {store} from "app/services/redux";
import AdminSidebar from "app/layouts/admin/AdminSidebar.tsx";
import AdminFooter from "app/layouts/admin/AdminFooter.tsx";
import AdminHeader from "app/layouts/admin/AdminHeader.tsx";

interface AdminLayoutType {
    children: React.ReactNode
}

const AdminLayout: React.FC<AdminLayoutType> = (props) => {
    return (
        <Provider store={store}>
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
        </Provider>
    );
}

export default AdminLayout;