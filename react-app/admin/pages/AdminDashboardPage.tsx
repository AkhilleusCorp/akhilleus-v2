import React from 'react';
import AdminLayout from "app/admin/layouts/AdminLayout.tsx";

const AdminDashboardPage: React.FC = () => {
    
    return (
        <AdminLayout>
            <h1 className="text-3xl font-bold underline">
                <div>Admin dashboard</div>
            </h1>
        </AdminLayout>
    );
}

export default AdminDashboardPage;