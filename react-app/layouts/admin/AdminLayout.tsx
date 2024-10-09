import React from 'react';
import AdminSidebar from "./AdminSidebar.tsx";
import AdminFooter from "./AdminFooter.tsx";
import AdminHeader from "./AdminHeader.tsx";
import {Box} from "@mui/material";
import {Provider} from "react-redux";
import {store} from "../../services/redux";

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