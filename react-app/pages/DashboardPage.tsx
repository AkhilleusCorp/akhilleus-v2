import React from 'react';
import AdminLayout from "app/layouts/admin/AdminLayout.tsx";

const DashboardPage: React.FC = () => {
    
    return (
        <AdminLayout>
            <h1 className="text-3xl font-bold underline">
                <div>Dashboard</div>
            </h1>
        </AdminLayout>
    );
}

export default DashboardPage;