import React from 'react';
import AdminLayout from "../layouts/admin/AdminLayout.tsx";

const DashboardPage: React.FC = () => {

    return (
        <AdminLayout>
            <h1 className="text-3xl font-bold underline">
                Home Page
            </h1>
        </AdminLayout>
    );
}

export default DashboardPage;