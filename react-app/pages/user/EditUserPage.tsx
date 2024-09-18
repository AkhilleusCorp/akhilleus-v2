import React from 'react';
import AdminLayout from "../../layouts/admin/AdminLayout.tsx";
import {useParams} from "react-router-dom";

const EditUserPage: React.FC = () => {
    const { userId } = useParams<{ userId: string }>();
    return (
        <AdminLayout>
            <h1>Edit User #{userId}</h1>
            <div>
                Edit
            </div>
        </AdminLayout>
    );
}

export default EditUserPage;